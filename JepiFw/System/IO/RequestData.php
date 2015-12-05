<?php
/**
 * RequestData.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;


use Jepi\Fw\Config\ConfigInterface;

class RequestData
{
    private $notFoundDefaultValue;
    private $remoteHost;
    private $remoteAddr;
    private $remotePort;
    private $uri;
    private $method;
    private $time;
    private $timeFloat;
    private $userAgent;
    private $scriptFilename;
    private $queryString;

    /**
     * @return mixed
     */
    public function getRemoteHost()
    {
        return $this->remoteHost;
    }

    /**
     * @return mixed
     */
    public function getRemoteAddr()
    {
        return $this->remoteAddr;
    }

    /**
     * @return mixed
     */
    public function getRemotePort()
    {
        return $this->remotePort;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @return mixed
     */
    public function getTimeFloat()
    {
        return $this->timeFloat;
    }

    /**
     * @return mixed
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @return mixed
     */
    public function getScriptFilename()
    {
        return $this->scriptFilename;
    }

    /**
     * @return mixed
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config){
        $this->notFoundDefaultValue = $config->get('Input', 'UnsetValue');

        $this->remoteHost= $this->getServerData('REMOTE_HOST');
        $this->remoteAddr = $this->getServerData('REMOTE_ADDR');
        $this->remotePort = $this->getServerData('REMOTE_PORT');
        $this->uri = $this->getServerData('REQUEST_URI');
        $this->method = $this->getServerData('REQUEST_METHOD');
        $this->time = $this->getServerData('REQUEST_TIME');
        $this->timeFloat = $this->getServerData('REQUEST_TIME_FLOAT');
        $this->userAgent = $this->getServerData('HTTP_USER_AGENT');
        $this->scriptFilename = $this->getServerData('SCRIPT_FILENAME');
        $this->queryString = $this->getServerData('QUERY_STRING');
    }

    /**
     * @param $key
     * @return mixed
     */
    private function getServerData($key){
        if (array_key_exists($key, $_SERVER)){
            return $_SERVER[$key];
        }else{
            return $this->notFoundDefaultValue;
        }
    }




}