<?php

class AutoLoaderPathTest {
    
    public function testConstructAndGet(){
        $autoLoaderPath = new AutoLoaderPath("/path/to/autoload/from");
        
        $path = $autoLoaderPath->getPath();
        
        $this->assertEquals("/path/to/autoload/from", $path);
    }
}
