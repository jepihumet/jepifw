<?php

namespace App\Controllers;

/**
 * Home.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Home extends \Jepi\Fw\Controller\Controller
{
    public function index(){
        return "Hello World";
    }

    public function myfunc(){
        return "my func is running";
    }
}