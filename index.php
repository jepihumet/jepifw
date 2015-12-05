<?php

/**
 * index.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */


function jlog($key, $value){
    echo "$key => ".json_encode($value)."<br>";
}

$container = require_once __DIR__.'/bootstrap.php';
$frontController = $container->get('Jepi\Fw\FrontController\FrontController');
$frontController->run();
