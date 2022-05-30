<?php

if (!function_exists('convertNumberIntoTimeFormat')) {
    function convertNumberIntoTimeFormat(int $number): string
    {
        $hours      = floor($number / 3600);
        $minutes    = floor(($number - ($hours * 3600)) / 60);
        $seconds    = $number - ($hours * 3600) - ($minutes * 60);
        
        return
            str_pad($hours, 2, '0', STR_PAD_LEFT) .
            ':' .
            str_pad($minutes, 2, '0', STR_PAD_LEFT) .
            ':' .
            str_pad($seconds, 2, '0', STR_PAD_LEFT);
    }
}