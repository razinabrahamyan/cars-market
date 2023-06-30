<?php

namespace App\Classes\Helpers;

class SourceChecker
{
    public static function isFileExist($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $retCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($retCode == 200);
    }
}
