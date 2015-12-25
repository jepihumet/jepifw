<?php
/**
 * DataCollection.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;


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
     * @var
     */
    private $session;

    /**
     * @var
     */
    private $cookies;

    /**
     * @param $unsetValue
     */
    public function __construct($unsetValue){
        $inputJSON = file_get_contents('php://input');
        $files = json_decode($inputJSON, TRUE);

        $this->get = new Input($_GET, $unsetValue);
        $this->post = new Input($_POST, $unsetValue);
        $this->files = new Input($files, $unsetValue);
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
}