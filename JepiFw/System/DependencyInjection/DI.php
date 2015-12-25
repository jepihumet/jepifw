<?php

namespace Jepi\Fw\DependencyInjection;


/**
 * DI.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class DI {
    static private $container = array();

    public static function addClass($className, $instance){
        self::$container[$className] = $instance;
    }

    public static function get($className, $parameters = array()){
        if (in_array($className, array_keys(self::$container))){
            //class exists
            return self::$container[$className];
        }else{
            //class does not exists
            $reflectionClass = new \ReflectionClass($className);

            $constructorReflection = $reflectionClass->getConstructor();
            $reflectionParameters = $constructorReflection->getParameters();
            $arguments = array();
            foreach($reflectionParameters as $reflectionParameter){
                $paramName = $reflectionParameter->getName();
                $paramClass = $reflectionParameter->getClass()->name;

                $paramInstance = DI::get($paramClass);
                $arguments[$paramName] = $paramInstance;
            }
            $instance = $reflectionClass->newInstanceArgs($arguments);
            self::$container[$className] = $instance;

            return self::$container[$className];
        }
    }
}