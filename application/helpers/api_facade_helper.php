<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 28 April 2017, 3:04 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

if (!function_exists('apiMakeCallback'))
{
    function apiMakeCallback($statusCode, $message, $data, $callback = '')
    {
        $return = [
            'code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ];
        if (strlen($callback) > 0)
        {
            $return['redirect'] = $callback;
        }

        return json_encode($return);
    }
}