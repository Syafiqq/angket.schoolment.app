<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 02 May 2017, 2:44 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

use Eventviva\ImageResize;

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

if (!function_exists('makeProperImage'))
{
    function makeProperImage($source, $destination)
    {
        $image = new ImageResize(FCPATH . $source);
        $min = min($image->getSourceHeight(), $image->getSourceWidth());
        $image->crop($min, $min);
        $image->save(FCPATH . $destination);
    }
}