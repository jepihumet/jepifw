<?php

namespace Jepi\Fw\Config;

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
    protected $noValue = false;

    /**
     * 
     * @param type $section
     * @param type $key
     * @return type
     */
    public function get($section, $key) {
        $sectionData = $this->getSection($section);
        return array_key_exists($key, $sectionData) ? $sectionData[$key] : $this->noValue;
    }

    /**
     * 
     * @param type $section
     * @return type
     * @throws Exception
     */
    public function getSection($section) {
        if (array_key_exists($section, $this->config)) {
            return $this->config[$section];
        } else {
            throw new Exception("Config section ($section) not found.");
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
