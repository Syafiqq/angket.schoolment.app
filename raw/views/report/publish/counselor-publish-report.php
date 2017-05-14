<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 06 May 2017, 5:27 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */


use Carbon\Carbon;

setlocale(LC_TIME, 'id_ID');
if (!isset($profile))
{
    $profile = [];
}

if (!isset($categories))
{
    $categories = [];
}

if (!isset($result))
{
    $result = 0;
}
if (!isset($answered))
{
    $answered = [];
}
if (!isset($counslor))
{
    $counslor = [];
}


$suggest = '';
$profile['school'] = $profile['school'] === null ? '-' : $profile['school'];
$profile['grade'] = $profile['grade'] === null ? '-' : $profile['grade'];
$profile['gender'] = $profile['gender'] === 'male' ? 'Laki Laki' : 'Perempuan';
$profile['address'] = $profile['address'] === null ? '-' : $profile['address'];
$profile['birthplace'] = $profile['birthplace'] === null ? '-' : $profile['birthplace'];
$profile['datebirth'] = $profile['datebirth'] === null ? '-' : Carbon::createFromFormat('Y-m-d', $profile['datebirth'])->formatLocalized('%d %B %Y');
$profile['birth'] = (($profile['birthplace'] === '-') && ($profile['datebirth'] === '-')) ? '-' : (($profile['birthplace'] === '-') ? $profile['datebirth'] : (($profile['datebirth'] === '-') ? $profile['birthplace'] : "{$profile['birthplace']}, {$profile['datebirth']}"));
$answered['answer_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $answered['answer_at'])->formatLocalized('%d %B %Y %H:%M');
$now = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now('Asia/Jakarta'))->formatLocalized('%d %B %Y');
$counselor['school'] = $counselor['school'] === null ? '-' : $counselor['school'];
$counselor['head'] = $counselor['head'] === null ? '-' : $counselor['head'];
$counselor['head_credential'] = $counselor['head_credential'] === null ? '-' : $counselor['head_credential'];
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Print</title>
    <meta name="a temlplate" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('/apple-touch-icon.png') ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/normalize.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.min.css') ?>">

    <link href="<?php echo base_url('/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/report/publish/counselor-publish-report.min.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('/assets/js/html5shiv.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/js/respond.min.js') ?>"></script>
    <![endif]-->
    <script src="<?php echo base_url('/assets/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
    <style type="text/css">
        .no-padding-side {
            padding-left: 0;
            padding-right: 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>">Schoolment</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a class="_nav-a-link" href="<?php echo site_url('student/jump?tab=student%2Freport') ?>">Kembali</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a onclick="print()">Cetak</a>
                </li>
                <li>
                    <a id="logout" href="<?php echo site_url('auth/do_logout') ?>">Logout</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>


<page class="page" size="A4" id="printable-area">
    <div class="container" id="print_container">
        <div class="row vertical-align">
            <div class="col-sm-3">
                <img src="<?php echo base_url('/assets/img/avatar/logo/logo.png') ?>" alt="UM" class="img-rounded img-responsive center-block" style="width: 3.5cm; height: 3.5cm">
            </div>
            <div class="col-sm-9">
                <p class="margin-bottom-2" id="header_department">KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI</p>
                <p class="margin-bottom-2" id="header_university">UNIVERSITAS NEGERI MALANG (UM)</p>
                <p class="margin-bottom-2" id="header_faculty">FAKULTAS ILMU PENDIDIKAN</p>
                <p class="margin-bottom-2" id="header_faculty">JURUSAN BIMBINGAN DAN KONSELING</p>
                <p></p>
                <p class="margin-bottom-2" id="header_u_address">Jalan Semarang 5 Malang 65145</p>
                <p class="margin-bottom-2" id="header_u_desc">Telepon: 0341-566962, Laman: www.um.ac.id</p>
            </div>
        </div><!--/row-->
        <div class="row vertical-align">
            <div class="col-sm-12">
                <hr class="bigHr">
            </div>
        </div>
        <div class="row vertical-align">
            <div class="col-sm-9"></div>
            <div class="col-sm-3 text-center">
                <div id="secret_container">
                    <p id="secret">RAHASIA</p>
                </div>
            </div>
        </div>
        <div class="row vertical-align">
            <div class="col-sm-12 text-center">
                <p id="content_welcome" class="margin-bottom-4" style="font-weight: bold; font-size: 20px">LAPORAN HASIL INVENTORI</p>
                <p id="content_title" style="font-weight: bolder; font-size: 20px; margin: 4px">
                    <b>
                        <i>SCHOOL ENGAGEMENT</i>
                    </b>
                    SISWA
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                &nbsp;
            </div>
        </div>
        <div class="row vertical-align">
            <div class="col-sm-3 text-left">
                <p class="margin-left-1-cm">Nama</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['name'] ?></p>
            </div>
            <div class="col-sm-3 text-left">
                <p>Sekolah</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['school'] ?></p>
            </div>
        </div>
        <div class="row vertical-align">
            <div class="col-sm-3 text-left">
                <p class="margin-left-1-cm">NIS</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['credential'] ?></p>
            </div>
            <div class="col-sm-3 text-left">
                <p>Jenis Kelamin</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['gender'] ?></p>
            </div>
        </div>
        <div class="row vertical-align">
            <div class="col-sm-3 text-left">
                <p class="margin-left-1-cm">Kelas</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['grade'] ?></p>
            </div>
            <div class="col-sm-3 text-left">
                <p>Tanggal Pengisian</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $answered['answer_at'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10 text-center">
                <p id="content_welcome" style="font-weight: bold; font-size: 16px; margin: 4px">HASIL ANALISA</p>
                <b><?php printf("%.4g%%", $result['value']) ?></b>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <table class="color-transparent custom-table">
                    <thead>
                    <tr>
                        <th width="150" class="text-center font-size-14px">
                            <b>Interval Persentase</b>
                        </th>
                        <th width="150" class="text-center font-size-14px">
                            <b>Klasifikasi</b>
                        </th>
                        <th class="text-center font-size-14px">
                            <b>Interpretasi</b>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($grading as $kg => $vg)
                    {
                        $isBold = $result['value'] >= $vg['interval']['min'] ? ($result['value'] <= $vg['interval']['max'] ? 'bold-normal' : '') : '';
                        $suggest = strlen($isBold) > 0 ? $vg['suggest'] : $suggest;
                        if ($isBold)
                        {
                            echo '<tr>';
                            echo "<td class=\"font-size-12px text-center {$isBold}\">{$vg['interval']['value']}</td>";
                            echo "<td class=\"font-size-12px text-center {$isBold}\">{$vg['class']}</td>";
                            echo "<td class=\"font-size-12px {$isBold}\">";
                            echo "<b>{$vg['interpretation']['key']}</b><ol>";
                            foreach ($vg['interpretation']['value'] as $kiv => $viv)
                            {
                                echo "<li>{$viv}</li>";
                            }
                            echo '</ol>';
                            echo '</td>';
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10 text-left">
                <p style="margin: 4px; font-size: 16px;">
                </p>
            </div>
        </div>
        <div class="row" style="margin-top: .5cm">
            <div class="col-sm-8 ">
            </div>
            <div class="col-sm-4 no-padding-side">
                <p class="margin-bottom-2">Malang, <?php echo $now ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 ">
            </div>
            <div class="col-sm-4 no-padding-side">
                <p class="margin-bottom-2">Kepala Sekolah <?php echo $counselor['school'] ?></p>
            </div>
            <div class="col-sm-3 ">
            </div>
            <div class="col-sm-4 no-padding-side">
                <p class="margin-bottom-2">Konselor</p>
            </div>
        </div>
        <div class="row" style="margin-top: 1.2cm">
            <div class="col-sm-1 ">
            </div>
            <div class="col-sm-4 no-padding-side">
                <p class="margin-bottom-2"><?php echo $counselor['head'] ?></p>
            </div>
            <div class="col-sm-3 ">
            </div>
            <div class="col-sm-4 no-padding-side">
                <p class="margin-bottom-2"><?php echo $counselor['name'] ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-1 ">
            </div>
            <div class="col-sm-4 no-padding-side">
                <p class="margin-bottom-2"><?php echo $counselor['head_credential'] ?></p>
            </div>
            <div class="col-sm-3 ">
            </div>
            <div class="col-sm-4 no-padding-side">
                <p class="margin-bottom-2"><?php echo $counselor['credential'] ?></p>
            </div>
        </div>
    </div>
</page>

<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"><\/script>')</script>
<script src="<?php echo base_url('/assets/js/plugins.min.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/jQuery.print/jQuery.print.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/report/publish/counselor-publish-report.min.js') ?>"></script>
</body>
</html>

