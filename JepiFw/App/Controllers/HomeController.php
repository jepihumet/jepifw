<?php

namespace MyApp\Controllers;

/**
 * HomeController.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class HomeController extends \Jepi\Fw\Controller\Controller
{
    public function index(){
        echo "Hello World";
    }

    public function myfunc(){
        echo "my func is running";
    }
}