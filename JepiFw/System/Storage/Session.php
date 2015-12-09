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

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->unsetValue;
    }

    private function startSession(){
        try {
            session_start();
            $this->sessionId = session_id();
        }catch(Exception $e){
            throw new StorageException($e->getMessage());
        }
    }

    public function killSession(){
        try {
            session_destroy();
        }catch(Exception $e){
            throw new StorageException($e->getMessage());
        }
    }

    public function get($name){
        if (array_key_exists($name, $_SESSION)){
            return $_SESSION[$name];
        } else {
            return $this->unsetValue;
        }
    }

    public function set($name, $value){
        try{
            $_SESSION[$name] = $value;
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function flash($name){
        if (array_key_exists('flash', $_SESSION) && array_key_exists($name, $_SESSION['flash'])){
            $var = $_SESSION['flash'][$name];
            unset($_SESSION['flash'][$name]);
            return $var;
        } else {
            return $this->unsetValue;
        }
    }

    public function setFlash($name, $value){
        try{
            if (!array_key_exists('flash', $_SESSION)){
                $_SESSION['flash'] = array();
            }
            $_SESSION['flash'][$name] = $value;
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}