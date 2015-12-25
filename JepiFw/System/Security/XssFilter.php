<?php

/**
 * XssFilter.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Security;

class XssFilter
{
    public function xssPreventFilter($data){
        $trimmed = trim($data);
        $stripped = strip_tags($trimmed);
        $entities = htmlspecialchars($stripped);
        $sanitized = filter_var($entities, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this->typedValue($sanitized);
    }

    private function typedValue($value)
    {
        $typedValue = $value;
        if (is_int($value)) {
            $typedValue = (int)$value;
        } else if (is_bool($value)) {
            $typedValue = (bool)$value;
        } else if (is_float($value)) {
            $typedValue = (float)$value;
        } else if (is_string($value)) {
            $typedValue = (string)$value;
        } else if (is_long($value) || is_double($value)) {
            $typedValue = (double)$value;
        }
        return $typedValue;
    }
}