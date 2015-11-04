<?php
/**
 * InputInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;


interface InputInterface
{
    public function xssPreventFilter($data);
    public function get($key, $xssPrevent = true);
    public function post($key, $xssPrevent = true);
}