<?php

/**
 * AutoLoader.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class AutoLoader implements AutoloaderInterface
{
    /**
     * @var array<AutoLoaderPath>
     */
    private $autoLoaderPaths = array();
    /**
     * @var DirectoryManagerInterface
     */
    private $directoryManager = null;

    public function __construct(DirectoryManagerInterface $directoryManager)
    {
        $this->directoryManager = $directoryManager;
    }

    public function addPath($path, $recursiveLoad = false)
    {
        if ($recursiveLoad) {
            $recursivePaths = $this->directoryManager->expandDirectories($path);
            foreach ($recursivePaths as $singlePath) {
                $this->addSinglePath($singlePath);
            }
        } else {
            $this->addSinglePath($path);
        }
    }

    private function addSinglePath($path)
    {
        $this->autoLoaderPaths[] = new AutoLoaderPath($path);
    }

}