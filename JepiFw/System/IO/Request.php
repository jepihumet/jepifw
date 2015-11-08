<?php
/**
 * Request.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;


class Request implements RequestInterface
{
    /**
     * @var InputInterface
     */
    protected $input;

    /**
     * @var \Jepi\Fw\Router\RouterInterface
     */
    protected $router;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var mixed
     */
    private $notFoundDefaultValue;

    /**
     * @var RequestData
     */
    private $requestData;

    /**
     * @param $notFoundDefaultValue
     */
    public function __construct($notFoundDefaultValue){
        $this->notFoundDefaultValue = $notFoundDefaultValue;

        $this->requestData = new RequestData(null);
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

        return $this->notFoundDefaultValue;
    }

}