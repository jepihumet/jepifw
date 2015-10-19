<?php

/**
 * DirectoryManagerInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
interface DirectoryManagerInterface
{
    /**
     * Recursive function that returns all directories inside a base directory
     *
     * @param string $baseDir
     * @return array
     */
    public function expandDirectories($baseDir);
}