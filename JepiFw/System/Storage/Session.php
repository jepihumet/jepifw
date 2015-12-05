<?php
/**
 * Session.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Storage;


use Jepi\Fw\Config\ConfigInterface;
use Jepi\Fw\Exceptions\StorageException;

class Session
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var string
     */
    protected $sessionId;

    /**
     * @var mixed
     */
    private $configStorage;

    /**
     * @var mixed
     */
    private $unsetValue;

    public function __construct(ConfigInterface $config){
        $this->config = $config;
        $this->configStorage = $this->config->getSection('Storage');
        if (array_key_exists('UnsetValue', $this->configStorage)){
            $this->unsetValue = $this->configStorage['UnsetValue'];
        }else{
            $this->unsetValue = $this->config->get('Input', 'UnsetValue');
        }
        $this->sessionId = null;
        $this->startSession();
    }

    private function startSession(){
        session_start();
        $this->sessionId = session_id();
    }

    public function killSession(){
        session_destroy();
    }

    public function get($key){
        if (array_key_exists($key, $_SESSION)){
            return $_SESSION[$key];
        } else {
            return $this->unsetValue;
        }
    }

    public function set($key, $value){
        try{
            $_SESSION[$key] = $value;
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function flash($key){
        if (array_key_exists('flash', $_SESSION) && array_key_exists($key, $_SESSION['flash'])){
            $var = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $var;
        } else {
            return $this->unsetValue;
        }
    }

    public function setFlash($key, $value){
        try{
            if (!array_key_exists('flash', $_SESSION)){
                $_SESSION['flash'] = array();
            }
            $_SESSION['flash'][$key] = $value;
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}