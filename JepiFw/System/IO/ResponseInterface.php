<?php
/**
 * ResponseInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;


interface ResponseInterface
{
    public function __construct($content, $status = 200, $headers = array());
    public function send();
}