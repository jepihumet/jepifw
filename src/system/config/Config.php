<?php

/**
 * Config.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Config extends ConfigAbstract
{
    public function __construct(){
        $this->config = array();
    }

    public function get($key)
    {
        return $this->config[$key];
    }

    public function set($key, $value)
    {
        $this->config[$key] = $value;
    }

    public function loadConfigFile($path)
    {
        $configFromFile = parse_ini_file($path);
        $this->config = array_merge($this->config, $configFromFile);
    }

    public function loadConfigArray($config)
    {
        $this->config = array_merge($this->config, $config);
    }


}