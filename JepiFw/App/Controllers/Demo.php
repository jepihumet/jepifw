<?php

namespace App\Controllers;

/**
 * Demo.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Demo extends \Jepi\Fw\Controller\Controller
{
    public function index(){
        return "hola";
    }
    public function testMethod($param1 = 2, $param2){
        return "Param1 = $param1, Param2 = $param2";
    }
}