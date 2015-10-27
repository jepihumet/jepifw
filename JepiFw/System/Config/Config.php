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

    public function get($section, $key) {
        $sectionData = $this->getSection($section);
        return key_exists($key, $sectionData) ? $sectionData[$key] : null;
    }

    public function getSection($section) {
        if (key_exists($section, $this->config)) {
            return $this->config[$section];
        } else {
            throw new Exception("Config section ($section) not found.");
        }
    }

    public function set($section, $key, $value) {
        $this->config[$section][$key] = $value;
    }

    public function loadConfigFile($path) {
        $configFromFile = parse_ini_file($path, true);
        $this->config = array_merge($this->config, $configFromFile);
    }

    public function loadConfigArray($config) {
        $this->config = array_merge($this->config, $config);
    }

    public function dumpConfig() {
        var_dump($this->config);
    }

}
