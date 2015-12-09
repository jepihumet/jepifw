<?php
/**
 * ViewInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\View;


interface ViewInterface
{
    public function addVar($name, $value);
    public function get($url, $vars = array());
}