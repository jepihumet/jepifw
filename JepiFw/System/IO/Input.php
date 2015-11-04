<?php
/**
 * Input.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;


class Input implements InputInterface
{

    protected $data;
    protected $noInputFound;

    public function __construct(){
        $this->data = array(
            "post" => $_POST,
            "get" => $_GET
        );
    }

    public function xssPreventFilter($data){
        $trimmed = trim($data);
        $stripped = strip_tags($trimmed);
        $entities = htmlspecialchars($stripped);

        return $this->typedValue($entities);
    }

    private function typedValue($value){
        $typedValue = $value;
        if (is_int($value)){
            $typedValue = (int)$value;
        }else if (is_bool($value)){
            $typedValue = (bool)$value;
        }else if (is_float($value)){
            $typedValue = (float)$value;
        }else if (is_string($value)){
            $typedValue = (string)$value;
        }else if (is_long($value) || is_double($value)){
            $typedValue = (double)$value;
        }
        return $typedValue;
    }

    private function getValue($globalVar, $key){
        $vars = array();
        switch($globalVar){
            case 'get':
                $vars = $this->data['get'];
                break;
            case 'post':
                $vars = $this->data['post'];
                break;
        }
        $returnValue = $this->noInputFound;
        if (array_key_exists($key, $vars)){
            $returnValue = $vars[$key];
        }
        return $returnValue;

    }

    public function get($key, $xssPrevent = true)
    {
        $value = $this->getValue('get', $key);
        if ($xssPrevent) {
            $value = $this->xssPreventFilter($value);
        }
        return $value;
    }

    public function post($key, $xssPrevent = true)
    {
        $value = $this->getValue('post', $key);
        if ($xssPrevent) {
            $value = $this->xssPreventFilter($value);
        }
        return $value;
    }
}