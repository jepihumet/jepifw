<?php

namespace Jepi\Fw\Config;

/**
 * Config.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Config extends ConfigAbstract {

    /**
     * 
     * @param string $noValue
     */
    public function __construct($noValue = false) {
        $this->config = array();
        $this->noValue = $noValue;
    }

    /**
     * 
     * @param string $path
     */
    public function loadFile($path) {
        $configFromFile = parse_ini_file($path, true);
        $this->config = array_merge($this->config, $configFromFile);
    }

    /**
     * 
     * @param array<mixed> $Config
     */
    public function loadArray($config) {
        $this->config = array_merge($this->config, $config);
    }

    /**
     * 
     * @return array<mixed>
     */
    public function getData() {
        return $this->config;
    }

}
