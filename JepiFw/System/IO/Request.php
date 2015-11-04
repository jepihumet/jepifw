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

    public function getRequest()
    {
        // TODO: Implement getRequest() method.
    }

    public function getHeader($key)
    {
        // TODO: Implement getHeader() method.
    }


}