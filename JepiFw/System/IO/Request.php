<?php
namespace Jepi\Fw\IO;


use Jepi\Fw\Config\ConfigAbstract;
use Jepi\Fw\Router\Router;
use Jepi\Fw\Router\RouterInterface;

/**
 * Request.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Request implements RequestInterface
{
    /**
     * @var DataCollection
     */
    protected $dataCollection;

    /**
     * @var RouterInterface
     */
    protected $router;

    /**
     * @var ConfigAbstract
     */
    protected $config;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var mixed
     */
    private $unsetValue;

    /**
     * @var RequestData
     */
    private $requestData;

    /**
     * @param ConfigAbstract $config
     */
    public function __construct(ConfigAbstract $config){
        $this->config = $config;
        $this->unsetValue = $config->get('Input', 'UnsetValue');
        $this->requestData = new RequestData(null);
        $this->dataCollection = new DataCollection($this->unsetValue);
    }

    /**
     * @return RequestData
     */
    public function getRequest(){
        return $this->requestData;
    }

    /**
     * @param $key
     * @return mixed
     * @throws Exception
     */
    public function getHeader($key)
    {
        if (empty($key)) {
            throw new Exception('An HTTP header name is required');
        }

        // Try to get it from the $_SERVER array first
        $temp = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
        if (!empty($_SERVER[$temp])) {
                return $_SERVER[$temp];
        }

        // This seems to be the only way to get the Authorization header on
        // Apache
        if (function_exists('apache_request_headers')) {
                $headers = apache_request_headers();
                if (!empty($headers[$key])) {
                        return $headers[$key];
            }
        }

        return $this->unsetValue;
    }

    /**
     * @return RouterInterface
     */
    public function validateRequest()
    {
        $method = $this->requestData->getMethod();

        switch($method){
            case 'POST':
                $input = $this->dataCollection->post();
                break;
            case 'PUT':
                $input = $this->dataCollection->post();
                break;
            case 'GET':
            case 'DELETE':
            case 'HEAD':
            default:
                $input = $this->dataCollection->get();
        }

        $uri = $this->requestData->getUri();
        $this->router = new Router($this->config, $uri, $input);

        return $this->router;
    }

    /**
     * 
     * @return RouterInterface
     */
    function getRouter() {
        return $this->router;
    }


}