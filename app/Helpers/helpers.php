<?php

if (!function_exists('appendToStringWhen')) {
    function appendToStringWhen($condition, $string, $addition)
    {
        if ($condition) {
            $string .= $addition;
        }
        return $string;
    }
}
