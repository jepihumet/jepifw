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
    public function getRequest();
    public function getHeader($key);
}