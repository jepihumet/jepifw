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
        echo "Hello World";
    }

    public function myfunc(){
        echo "my func is running";
    }
}