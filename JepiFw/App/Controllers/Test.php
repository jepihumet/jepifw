<?php

namespace App\Controllers;

/**
 * Test.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Test extends \Jepi\Fw\Controller\Controller
{

    public function testMethod($param1, $param2){
        return "Param1 = $param1, Param2 = $param2";
    }
}