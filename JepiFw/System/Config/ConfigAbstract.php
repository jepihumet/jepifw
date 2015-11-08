<?php

namespace Jepi\Fw\Config;
use Jepi\Fw\Exceptions\ConfigException;

/**
 * ConfigAbstract.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
abstract class ConfigAbstract implements ConfigInterface {

    /**
     *
     * @var array<mixed>
     */
    protected $config = array();
    protected $noValue = null;

    /**
     * @param $section
     * @param $key
     * @return mixed
     * @throws ConfigException
     */
    public function get($section, $key) {
        $sectionData = $this->getSection($section);
        if (array_key_exists($key, $sectionData)){
            return $sectionData[$key];
        } else {
            throw new ConfigException("Config item '{$key}' not found in section '{$section}'");
        }
    }

    /**
     * @param $section
     * @return mixed
     * @throws ConfigException
     */
    public function getSection($section) {
        if (array_key_exists($section, $this->config)) {
            return $this->config[$section];
        } else {
            throw new ConfigException("Config section '{$section}' not found.");
        }
    }

    /**
     * 
     * @param type $section
     * @param type $key
     * @param type $value
     */
    public function set($section, $key, $value) {
        if (!array_key_exists($section, $this->config)) {
            $this->config[$section] = array();
        }
        $this->config[$section][$key] = $value;
    }

    abstract public function loadFile($path);

    abstract public function loadArray($config);
}
