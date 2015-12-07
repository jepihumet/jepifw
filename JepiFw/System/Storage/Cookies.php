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
use Jepi\Fw\Security\XssFilter;

class Cookies
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var XssFilter
     */
    private $xssFilter;

    /**
     * @var mixed
     */
    private $configStorage;

    /**
     * @var mixed
     */
    private $unsetValue;

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
    }

    public function get($name, $xssPrevent = true)
    {
        $value = $this->unsetValue;
        if (array_key_exists($name, $_COOKIE)) {
            $value = $_COOKIE[$name];
        }
        if ($xssPrevent) {
            $value = $this->xssFilter->xssPreventFilter($value);
        }
        return $value;
    }

    /**
     * @param $name
     * @param string $value
     * @param string $expire minutes until cookie is alive
     * @param string $domain
     * @param string $path
     * @param bool $secure
     * @param bool $httpOnly
     */
    public function set($name, $value = null, $expire = null, $domain = null, $path = null, $secure = null, $httpOnly = null)
    {
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

        setcookie($this->prefix . $name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }

    public function delete($name)
    {
        $this->set($name, null, -1);
    }

    public function touch($name)
    {
        $value = $this->get($name);
        $this->set($name, $value);
    }
}