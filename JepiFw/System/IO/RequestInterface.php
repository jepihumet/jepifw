<?php

/**
 * RequestInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;

use Jepi\Fw\Router\RouterInterface;

interface RequestInterface {

    /**
     * @return mixed
     */
    public function getRequest();

    /**
     * @param $key
     * @return \stdClass
     */
    public function getHeader($key);

    /**
     * @return RouterInterface
     */
    public function validateRequest();
}
