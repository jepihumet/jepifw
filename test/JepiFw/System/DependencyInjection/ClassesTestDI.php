<?php

namespace Jepi\Fw\DependencyInjection;

/**
 * Class ClassA
 * @package Jepi\Fw\DependencyInjection
 */
class ClassA{
    function __construct(){

    }
}


/**
 * Class ClassB
 * @package Jepi\Fw\DependencyInjection
 */
class ClassB{
    /**
     * @var classA|null
     */
    private $a = null;

    /**
     * @param ClassA $a
     */
    function __construct(ClassA  $a){
        $this->a = $a;
    }

    /**
     * @return ClassA|null
     */
    public function getA(){
        return $this->a;
    }
}