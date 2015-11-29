<?php

namespace Jepi\Fw\DependencyInjection;


/**
 * DI.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class DI
{
    static private $container = array();

    public static function addClass($className, $instance)
    {
        self::$container[$className] = $instance;
    }

    public static function get($className, $parameters = array())
    {
        $instance = self::getFromCurrentInstances($className);
        if ($instance != false) {
            return $instance;
        }
        //If no class instance found then setup the original className and start with the instance creation
        $reflectionClass = new \ReflectionClass($className);
        if ($reflectionClass->isFinal()) {
            $constructorReflection = $reflectionClass->getConstructor();
            jlog("CONSTRUCTOR", $constructorReflection);
            $arguments = array();
            if (!is_null($constructorReflection)) {
                $reflectionParameters = $constructorReflection->getParameters();
                foreach ($reflectionParameters as $reflectionParameter) {
                    $paramName = $reflectionParameter->getName();
                    $paramClass = $reflectionParameter->getClass()->name;

                    $paramInstance = DI::get($paramClass);
                    $arguments[$paramName] = $paramInstance;
                }
            }
        }
        $instance = $reflectionClass->newInstanceArgs($arguments);
        self::$container[$className] = $instance;

        return self::$container[$className];
    }

    private static function getFromCurrentInstances($className){
        jlog('CONTAINER', self::$container);
        //Class parents
        $implements = class_implements($className);
        $parents = class_parents($className);

        jlog('IMPLEMENTS', $implements);
        jlog('PARENTS', $parents);

        $classesToCheck = array_merge(array($className), $implements, $parents);
        $className = null;
        foreach ($classesToCheck as $classToCheck) {
            if (in_array($classToCheck, self::$container)) {
                return self::$container[$className];
            }
        }
        return false;
    }
}