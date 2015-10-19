<?php

/**
 * AutoLoaderInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
interface AutoLoaderInterface
{
    public function addPath($path, $recursiveLoad);
}