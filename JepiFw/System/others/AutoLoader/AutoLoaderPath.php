<?php

/**
 * AutoLoaderPath.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class AutoLoaderPath
{
    private $path = "";

    public function __construct($path)
    {
        $this->path = $path;
        $this->autoLoadPath();
    }

    private function autoLoadPath()
    {
        spl_autoload_register(function ($class) {
            $this->includeClass($class);
        });
    }

    private function includeClass($class)
    {
        $classFile = $this->path . DIRECTORY_SEPARATOR . $class . '.php';
        if (file_exists($classFile)) {
            require_once($classFile);
        }
    }

    public function getPath()
    {
        return $this->path;
    }

}