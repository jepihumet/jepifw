<?php

namespace Jepi\Fw\Config;

/**
 * ConfigAbstract.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
abstract class ConfigAbstract {

    protected $config = array();

    abstract public function get($section, $key);

    abstract public function getSection($section);

    abstract public function set($section, $key, $value);

    abstract public function loadConfigFile($path);

    abstract public function loadConfigArray($config);
}
