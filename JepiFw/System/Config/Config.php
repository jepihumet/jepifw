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


    public function __construct() {
        $this->config = array();
    }

    /**
     * 
     * @param string $path
     */
    public function loadFile($path) {
        $configFromFile = parse_ini_file($path, true, INI_SCANNER_TYPED);
        foreach($configFromFile as $key => $values){
            if (!array_key_exists($key, $this->config)) {
                $this->config[$key] = array();
            }
            foreach ($values as $key2 => $value) {
                $this->config[$key][$key2] = $value;
            }
        }
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
