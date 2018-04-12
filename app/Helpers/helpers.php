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

if (!function_exists('iconFromMime')) {
    function iconFromMime($mime)
    {
        if (strpos($mime, 'image') !== false) {
            return 'fa-file-image-o';
        }

        if (strpos($mime, 'audio') !== false) {
            return 'fa-file-audio-o';
        }

        if (strpos($mime, 'audio') !== false) {
            return 'fa-file-audio-o';
        }

        if (strpos($mime, 'pdf') !== false) {
            return 'fa-file-pdf-o';
        }

        return 'fa-file-o';
    }
}
