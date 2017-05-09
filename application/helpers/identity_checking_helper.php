<?php
/**
 * This <angket.bkritis.app> project created by :
 * Name         : syafiq
 * Date / Time  : 09 May 2017, 2:47 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */


if (!function_exists('isStudentIdentityComplete'))
{
    function isStudentIdentityIsComplete($auth)
    {
        $complete = false;
        if (
            (strlen($auth['grade']) > 0) &&
            (strlen($auth['school']) > 0) &&
            (strlen($auth['address']) > 0) &&
            (strlen($auth['birthplace']) > 0) &&
            (strlen($auth['datebirth']) > 0)
        )
        {
            $complete = true;
        }

        return $complete;
    }
}
