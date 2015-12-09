<?php
/**
 * Session.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Storage;


use Jepi\Fw\Config\ConfigInterface;
use Jepi\Fw\Exceptions\StorageException;
use Jepi\Fw\Security\XssFilter;

class Cookies extends XssFilter
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * All cookies set during the execution.
     *
     * @var array
     */
    private $data;

    /**
     * @var mixed
     */
    private $unsetValue;

    /**
     * @var mixed
     */
    private $configStorage;

    /**
     * @var int
     */
    private $expire;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $domain;
    /**
     * @var string
     */
    private $path;

    /**
     * @var bool
     */
    private $secure;

    /**
     * @var bool
     */
    private $httpOnly;

    /**
     * @param ConfigInterface $config
     * @param XssFilter $xssFilter
     */
    public function __construct(ConfigInterface $config, XssFilter $xssFilter)
    {
        $this->config = $config;
        $this->xssFilter = $xssFilter;
        $this->configStorage = $this->config->getSection('Storage');
        if (array_key_exists('UnsetValue', $this->configStorage)) {
            $this->unsetValue = $this->configStorage['UnsetValue'];
        } else {
            $this->unsetValue = $this->config->get('Input', 'UnsetValue');
        }

        $this->expire = $this->config->get('Cookies', 'DefaultExpiration');
        $this->prefix = $this->config->get('Cookies', 'DefaultPrefix');
        $this->domain = $this->config->get('Cookies', 'DefaultDomain');
        $this->path = $this->config->get('Cookies', 'DefaultPath');
        $this->secure = $this->config->get('Cookies', 'DefaultSecure');
        $this->httpOnly = $this->config->get('Cookies', 'DefaultHttpOnly');

        $this->data = array();
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->unsetValue;
    }

    /**
     * @param $name
     * @param null $value
     * @param null $expire
     * @param null $domain
     * @param null $path
     * @param null $secure
     * @param null $httpOnly
     * @throws StorageException
     */
    public function set($name, $value = null, $expire = null, $domain = null, $path = null, $secure = null, $httpOnly = null)
    {
        try {
            if (is_null($domain)) {
                $domain = $this->domain;
            }
            if (is_null($path)) {
                $path = $this->path;
            }
            if (is_null($secure)) {
                $secure = $this->secure;
            }
            if (is_null($httpOnly)) {
                $httpOnly = $this->httpOnly;
            }
            if (!is_numeric($expire)) {
                $expire = $this->expire;
            }
            $expire = ($expire > 0) ? time() + $expire : 0;

            $this->data[$name] = $value;
            setcookie($this->prefix . $name, $value, $expire, $path, $domain, $secure, $httpOnly);
        } catch (Exception $e) {
            throw new StorageException($e->getMessage());
        }
    }

    /**
     * @param $name
     * @param bool|true $xssPrevent
     * @return bool|float|int|string
     */
    public function get($name, $xssPrevent = true)
    {
        $value = $this->unsetValue;
        if (array_key_exists($name, $_COOKIE)) {
            $value = $_COOKIE[$name];
        }
        if ($xssPrevent) {
            $value = $this->xssPreventFilter($value);
        }
        return $value;
    }

    /**
     * @param $name
     * @throws StorageException
     */
    public function delete($name)
    {
        unset($this->data[$name]);
        $this->set($name, null, -1);
    }

    /**
     * @param $name
     * @throws StorageException
     */
    public function touch($name)
    {
        $value = $this->get($name);
        $this->set($name, $value);
    }

    /**
     * Array with all cookies set during the execution. Data does not contains all cookies stored in $_COOKIE global.
     *
     * @return array
     */
    public function getData(){
        return $this->data;
    }
}