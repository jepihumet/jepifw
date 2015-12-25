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
    public function get($key, $xssPrevent = true);
}