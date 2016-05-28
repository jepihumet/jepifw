<?php

namespace App\Controllers;

use Jepi\Fw\Model\ModelExample;

/**
 * Home.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Home extends \Jepi\Fw\Controller\Controller
{
    /**
     * @Inject
     * @var ModelExample
     */
    private $model;

    /**
     * @return string
     */
    public function index(){
        return "Hello World";
    }
    public function phpinfo(){
        phpinfo();
    }

    public function welcome(){
        $this->view->addVar('title', 'JepiFW Template');

        return $this->view->get('bootstrap-template.php', array('content' => 'Hello, world!'));
    }
}