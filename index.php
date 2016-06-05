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

/** @var DI\Container $container */
$container = require_once __DIR__.'/bootstrap.php';
/** @var Jepi\Fw\FrontController\FrontController $frontController */
$frontController = $container->get('Jepi\Fw\FrontController\FrontController');
$frontController->run();
