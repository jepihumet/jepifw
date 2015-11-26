<?php

class ClassA{
    function __construct(){

    }
}

class ClassB{
    /**
     * @var classA|null
     */
    private $a = null;

    function __construct(classA $a){
        $this->a = $a;
    }
    public function getA(){
        return $this->a;
    }
}