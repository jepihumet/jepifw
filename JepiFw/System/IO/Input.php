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

    /**
     * @var array
     */
    protected $data;
    /**
     * @var mixed
     */
    private $notFoundDefaultValue;

    /**
     * @param $notFoundDefaultValue
     */
    public function __construct($notFoundDefaultValue){
        $this->notFoundDefaultValue = $notFoundDefaultValue;

        $inputJSON = file_get_contents('php://input');
        $input= json_decode($inputJSON, TRUE);

        $this->data = array(
            "post" => $_POST,
            "get" => $_GET,
            "files" => $input
        );
    }

    public function xssPreventFilter($data){
        $trimmed = trim($data);
        $stripped = strip_tags($trimmed);
        $entities = htmlspecialchars($stripped);
        $sanitized = filter_var($entities, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this->typedValue($sanitized);
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
        if (!array_key_exists($globalVar, $this->data)){
            throw new Exception("Key '$globalVar' not found as an input array.");
        }

        $returnValue = $this->notFoundDefaultValue;
        if (array_key_exists($key, $this->data[$globalVar])){
            $returnValue = $this->data[$globalVar][$key];
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

    public function file($key, $xssPrevent = true)
    {
        $value = $this->getValue('files', $key);
        if ($xssPrevent) {
            $value = $this->xssPreventFilter($value);
        }
        return $value;
    }
}