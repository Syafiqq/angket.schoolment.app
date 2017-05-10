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

if (!function_exists('interpretCritical'))
{
    /**
     * @return array
     * @internal param $value
     */
    function interpretCritical()
    {
        return [
            '.1' => [
                'interval' => [
                    'min' => 67,
                    'max' => 100,
                    'value' => '67 - 100%'
                ],
                'class' => 'Tinggi',
                'interpretation' => [
                    'key' => 'Siswa memiliki kecenderungan Bipolar sebagai Berikut:',
                    'value' => [
                        'Siswa kurang bisa mengendalikan mood senang dan mood depresi',
                        'Siswa berbicara sesuka hati ketika mood bahagia tanpa memikirkan perasaan orang',

                    ]
                ],
                'suggest' => 'Kemampuan berpikir kritis akademik %s <b>Sudah Tinggi</b>, pertahankan!'
            ],
            '.2' => [
                'interval' => [
                    'min' => 34,
                    'max' => 66,
                    'value' => '34 - 66%'
                ],
                'class' => 'Sedang',
                'interpretation' => [
                    'key' => 'Siswa memiliki kecenderungan Bipolar sebagai berikut:',
                    'value' => [
                        'Siswa pantas menjadi ketua OSIS',
                        'Siswa marah ketika ada teman mengejek penampilan',

                    ]
                ],
                'suggest' => 'Kemampuan berpikir kritis akademik %s adalah <b>Cukup</b>, perlu ditingkatkan'
            ],
            '.3' => [
                'interval' => [
                    'min' => 0,
                    'max' => 33,
                    'value' => '0 - 33%'
                ],
                'class' => 'Rendah',
                'interpretation' => [
                    'key' => 'Siswa memiliki kecenderungan bipolar sebagai berikut:',
                    'value' => [
                        'bisa mengendalikan mood mania dan depresi',
                        'Saya befikiran ke hal yang positif'

                    ]
                ],
                'suggest' => 'Kemampuan berpikir kritis akademik . %s adalah <b>Kurang</b>, perlu banyak latihan dalam belajar '
            ]
        ];
    }
}