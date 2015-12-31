<?php
/**
 * DataCollection.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;


use Jepi\Fw\Storage\Cookies;
use Jepi\Fw\Storage\Session;

class DataCollection
{
    /**
     * @var InputInterface
     */
    private $get;

    /**
     * @var InputInterface
     */
    private $post;

    /**
     * @var InputInterface
     */
    private $files;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var Cookies
     */
    private $cookies;

    /**
     * @param $unsetValue
     */
    public function setup($unsetValue){
        $inputJSON = file_get_contents('php://input');
        $files = json_decode($inputJSON, TRUE);

        $this->get = new Input();
        $this->get->setup($_GET, $unsetValue);
        $this->post = new Input();
        $this->post->setup($_POST, $unsetValue);
        $this->files = new Input();
        $this->files->setup($files, $unsetValue);
        
    }

    /**
     * @return InputInterface
     */
    public function get(){
        return $this->get;
    }

    /**
     * @return InputInterface
     */
    public function post(){
        return $this->post;
    }

    /**
     * @return InputInterface
     */
    public function files(){
        return $this->files;
    }
    
    /**
     * @return Session
     */
    public function session(){
        return $this->session;
    }
    
    /**
     * @return Cookies
     */
    public function cookies(){
        return $this->cookies;
    }
}