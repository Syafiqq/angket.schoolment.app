<?php
/**
 * This <angket.lgbt.app> project created by :
 * Name         : syafiq
 * Date / Time  : 07 May 2017, 2:09 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

if (!function_exists('interpretLesbian'))
{
    /**
     * @param $value
     * @return array
     */
    function interpretLesbian($value)
    {
        $value = doubleval($value);
        if ($value <= 33)
        {
            return [
                'Memiliki kecenderungan berpenampilan menor agar menarik perhatian sesama jenis perempuan',
                'Memiliki kecenderungan menghindari baju ketat',
                'Memiliki kecenderungan menghindari memakai perhiasan anting dan gelang'
            ];
        }
        elseif (($value > 34) && ($value <= 66))
        {
            return [
                'Memiliki kecenderungan cemburu ketika teman perempuan yang saya sukai berdekatan dengan laki-laki.',
                'Memiliki kecenderungan menjauhi teman dekat laki-laki.',
                'Memiliki kecenderungan browsing di internet mengenai perilaku sesama jenis perempuan.',
            ];
        }
        else
        {
            return [
                'Memiliki kecenderungan bergabung di akun komunitas sesama jenis perempuan',
                'Memiliki kecenderungan bercerita dengan sahabat jika menyukai teman perempuan saya',
                'Memiliki kecenderungan membagikan cerita tentang pacar perempuan saya di sosmed'
            ];
        }
    }
}

if (!function_exists('interpretGay'))
{
    /**
     * @param $value
     * @return array
     */
    function interpretGay($value)
    {
        $value = doubleval($value);
        if ($value <= 33)
        {
            return [
                'Memiliki kecenderungan  berpenampilan macho agar menarik perhatian sesama jenis laki-laki',
                'Memiliki kecenderungan suka ke salon dibandingkan bermain sepak bola/basket',
                'Memiliki kecenderungan menghindari memakai perhiasan anting dan gelang'
            ];
        }
        elseif (($value > 34) && ($value <= 66))
        {
            return [
                'Memiliki kecenderungan cemburu ketika teman laki-laki yang saya sukai berdekatan dengan perempuan',
                'Memiliki kecenderungan  menjauhi teman dekat laki-laki',
                'Memiliki kecenderungan  browsing di internet mengenai perilaku sesama jenis laki-laki',
            ];
        }
        else
        {
            return [
                'Memiliki kecenderungan bergabung di akun komunitas sesama jenis laki-laki',
                'Memiliki kecenderungan bercerita dengan sahabat jika menyukai teman laki-laki saya',
                'Memiliki kecenderungan menolak ketika teman perempuan mendeka'
            ];
        }
    }
}

if (!function_exists('interpretBisexual'))
{
    /**
     * @param $value
     * @return array
     */
    function interpretBisexual($value)
    {
        $value = doubleval($value);
        if ($value <= 33)
        {
            return [
                'Memiliki kecenderungan  mempunyai pasangan lawan jenis.',
                'Memiliki kecenderungan  bangga ketika berpacran dengan lawan jenis.',
                'Memiliki kecenderungan  merasa bahagia saat liburan dengan lawan jenis.'
            ];
        }
        elseif (($value > 34) && ($value <= 66))
        {
            return [
                'Memiliki kecenderungan  terlibat untuk melakukan aktivitas seksual dengan kedua lawan jenis.',
                'Memiliki kecenderungan  ingin memenuhi kebutuhan akan adanya variasi dan kreativitas untuk mendapatkan kepuasan dan kenikmatan dalam melakukan hubungan seksual',
                'Memiliki kecenderungan  tertarik untuk untuk melakukan aktivitas seksual dengan kedua lawsn jenis.'
            ];
        }
        else
        {
            return [
                'Memiliki kecenderungan  melakukan aktivitas seksual dengan kedua jenis kelamin.',
                'Memiliki kecenderungan  melakukan seks bebas (free sex) untuk mendapatkan kenikmatan dan cenderung diulang-ulang',
                'Memiliki kecenderungan  memiliki pasangan perempuan dan laki-laki. '
            ];
        }
    }
}

if (!function_exists('interpretTransGender'))
{
    /**
     * @param $value
     * @return array
     */
    function interpretTransGender($value)
    {
        $value = doubleval($value);
        if ($value <= 33)
        {
            return [
                'Memiliki kecenderungan  berpakaian selayaknya jenis kelamin saya.',
                'Memiliki kecenderungan  berperilaku selayaknya jenis kelamin saya.',
                'Memiliki kecenderungan  menolak merubah gender.'
            ];
        }
        elseif (($value > 34) && ($value <= 66))
        {
            return [
                'Memiliki kecenderungan  tertarik berpakaian seperti lawan jenis.',
                'Memiliki kecenderungan  tertarik berperilaku seperti lawan jenis.',
                'Memiliki kecenderungan  merasa biasa saja dengan  gender yang saya miliki'
            ];
        }
        else
        {
            return [
                'Memiliki kecenderungan  nyaman berpakaian seperti lawan jenis.',
                'Memiliki kecenderungan  nyaman berperilaku seperti lawan jenis.',
                'Memiliki kecenderungan  ingin merubah gender'
            ];
        }
    }
}