<?php

/**
 * DIContainer.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class DIContainer
{
    /**
     * Stores all the instantiated classes.
     *
     * @var $map
     */
    private static $map = null;

    /**
     * Adds a new mapped object to $map var.
     *
     * @param $key
     * @param $obj
     */
    private static function addToMap($key, $obj){
        if (self::$map === null){
            self::$map = (object) array();
        }
        self::$map->$key = $obj;
    }

    /**
     * Creates instance of type $className by passing $arguments to the class's constructor
     *
     * @param $className
     * @param array $arguments
     * @return object
     * @throws Exception
     */
    public static function getInstanceOf($className, array $arguments = array()){

        //Check if class exists
        if (!class_exists($className)){
            throw new Exception("DI Error: missing class '$className'.");
        }

        //Initialize ReflectionClass
        $reflection = new ReflectionClass($className);

        //Create an instance of the class
        if ($arguments === null || count($arguments) == 0){
            $obj = new $className;
        }else{
            if (!is_array($arguments)){
                $arguments = array($arguments);
            }
            $obj = $reflection->newInstanceArgs($arguments);
        }

        //Injecting class
        if ($doc = $reflection->getDocComment()){
            $lines = explode("\n", $doc);
            foreach($lines as $line){
                if (count($parts = explode("@Inject", $line))> 1){
                    $parts = explode(" ", $parts[1]);
                    if (count($parts) > 1){
                        $key = $parts[1];
                        $key = str_replace("\n", "", $key);
                        $key = str_replace("\r", "", $key);
                        if (isset(self::$map->$key)){
                            switch(self::$map->$key->type){
                                case 'value':
                                    $obj->$key = self::$map->$key->value;
                                    break;
                                case 'class':
                                    $obj->$key = self::getInstanceOf(self::$map->$key->value, self::$map->$key->arguments);
                                    break;
                                case 'classSingleton':
                                    if(self::$map->$key->instance === null) {
                                        $obj->$key = self::$map->$key->instance = self::getInstanceOf(self::$map->$key->value, self::$map->$key->arguments);
                                    } else {
                                        $obj->$key = self::$map->$key->instance;
                                    }
                                    break;
                            }
                        }
                    }
                }
            }
        }
        return $obj;
    }

    /**
     * Associate $key with $value. The value could be array, string or object.
     *
     * @param $key
     * @param $value
     */
    public static function mapValue($key, $value){
        self::addToMap($key, (object)array(
            'value' => $value,
            'type' => 'value'
        ));
    }

    /**
     * Same as mapValue but class name should be passed as a value.
     *
     * @param $key
     * @param $value
     * @param array $arguments
     */
    public static function mapClass($key, $value, array $arguments = null){
        self::addToMap($key, (object)array(
            'value' => $value,
            'type' => 'class',
            'arguments' => $arguments
        ));
    }

    /**
     * Same as mapClass, but once the class is created its instance is returned during the next injection.
     *
     * @param $key
     * @param $value
     * @param array $arguments
     */
    public static function mapClassAsSingleton($key, $value, array $arguments = null){
        self::addToMap($key, (object)array(
            'value' => $value,
            'type' => 'classSingleton',
            'instance' => null,
            'arguments' => $arguments
        ));
    }
}