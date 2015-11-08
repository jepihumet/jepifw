<?php
/**
 * RequestInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;


interface RequestInterface
{
    /**
     * @return mixed
     */
    public function getRequest();

    /**
     * @param $key
     * @return \stdClass
     */
    public function getHeader($key);
}