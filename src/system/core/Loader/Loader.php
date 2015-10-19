<?php

/**
 * Loader.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Loader
{
    /**
     * @var AutoLoaderInterface
     */
    private $autoLoader = null;

    public function __construct(AutoLoaderInterface $autoLoader)
    {
        $this->autoLoader = $autoLoader;

        $this->loadSystemStructure();
        $this->loadApplicationStructure();
    }

    private function loadSystemStructure()
    {
        $this->autoLoader->addPath(ROOT . DS . 'system' . DS . 'core', true);
        $this->autoLoader->addPath(ROOT . DS . 'system' . DS . 'config');
        $this->autoLoader->addPath(ROOT . DS . 'system' . DS . 'db');
        $this->autoLoader->addPath(ROOT . DS . 'system' . DS . 'library');
    }

    private function loadApplicationStructure()
    {
        $this->autoLoader->addPath(ROOT . DS . 'application', true);
    }


}
