<?php
/**
 * View.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\View;


use Jepi\Fw\Config\ConfigInterface;
use Jepi\Fw\Libraries\FileManager;

class View implements ViewInterface
{
    /**
     * @var ConfigInterface
     */
    private $config;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var string
     */
    private $viewsDirectory = "";

    /**
     * @var array
     */
    private $vars = array();

    /**
     * @var string
     */
    private $view = null;

    /**
     * @var string
     */
    private $content = "";

    public function __construct(ConfigInterface $config, FileManager $fileManager)
    {
        $this->config = $config;
        $this->fileManager = $fileManager;
        $this->viewsDirectory = $this->config->get('Views', 'ViewsDirectory');
    }

    /**
     * @param $name string
     * @param $value mixed
     */
    public function addVar($name, $value)
    {
        $this->vars[$name] = $value;
    }

    /**
     * @param $url
     * @param array $vars
     * @return string
     */
    public function get($url, $vars = array())
    {
        $this->vars = array_merge($this->vars, $vars);

        ob_start();
        extract($this->vars);

        include APP_ROOT . $this->viewsDirectory . DIRECTORY_SEPARATOR . $url;

        $this->content = ob_get_clean();
        return $this->content;
    }
}