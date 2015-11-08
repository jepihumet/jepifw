<?php

/**
 * JepiException.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Exceptions;

class JepiException extends \Exception
{
    public function getProductionMessage()
    {
        $texts = \Jepi\Fw\IO\Response::$statusTexts;
        if (array_key_exists($this->getCode(), $texts)){
            $message = $texts[$this->getCode()];
        }else{
            $message = 'Unknown error';
        }
        $errorMsg = sprintf('Error $s: $s', $this->getCode(), $message);
        return $errorMsg;
    }
    public function getDevelopmentMessage()
    {
        $errorMsg = sprintf('Error on line %s in %s: %s',$this->getLine(),$this->getFile(),$this->getMessage());
        return $errorMsg;
    }

}