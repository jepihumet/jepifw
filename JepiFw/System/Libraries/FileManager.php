<?php

namespace Jepi\Fw\Libraries;

/**
 * FileManager.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class FileManager {

    /**
     * Recursive function that returns all directories inside a base directory.
     *
     * @param string $baseDir
     * @return array
     */
    public function expandDirectories($baseDir) {
        $directories = array();
        foreach (scandir($baseDir) as $file) {
            if ($file == '.' || $file == '..')
                continue;
            $dir = $baseDir . DS . $file;
            if (is_dir($dir)) {
                $directories [] = $dir;
                $directories = array_merge($directories, $this->expandDirectories($dir));
            }
        }
        return $directories;
    }

    /**
     * Return all files inside a directory passed on $baseDir parameter.
     *
     * @param $baseDir
     * @return array
     */
    public function listAllFilesInDirectory($baseDir) {
        $files = array();
        foreach (scandir($baseDir) as $file) {
            if ($file == '.' || $file == '..')
                continue;
            $path = $baseDir . DIRECTORY_SEPARATOR . $file;
            if (is_file($path)) {
                $files[] = $path;
            }
        }

        return $files;
    }

}
