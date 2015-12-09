<?php
/**
 * Input.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\IO;

use Jepi\Fw\Security\XssFilter;

class Input extends XssFilter implements InputInterface
{

    /**
     * @var array
     */
    protected $data;
    /**
     * @var mixed
     */
    protected $unsetValue;

    /**
     * @param $dataArray
     * @param $unsetValue
     */
    public function setup($dataArray, $unsetValue){
        $this->unsetValue = $unsetValue;
        $this->data = $dataArray;
    }

    public function get($key, $xssPrevent = true)
    {
        $value = $this->unsetValue;
        if (array_key_exists($key, $this->data)){
            $value = $this->data[$key];
        }
        if ($xssPrevent) {
            $value = $this->xssPreventFilter($value);
        }
        return $value;
    }
}