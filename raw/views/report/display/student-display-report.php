<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 07 May 2017, 8:48 AM.
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
    $result = [];
}
if (!isset($answered))
{
    $answered = [];
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

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Laporan</title>
    <meta name="a temlplate" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('/apple-touch-icon.png') ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/normalize.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.min.css') ?>">

    <link href="<?php echo base_url('/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/report/display/student-display-report.min.css') ?>" rel="stylesheet">

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
<nav class="navbar navbar-default sidebar" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a class="_nav-a-link" href="<?php echo site_url('dashboard/jump?tab=dashboard') ?>">B-Kritis<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Profile <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a class="_nav-a-link" href="<?php echo site_url('profile/jump?tab=profile') ?>">Lihat</a></li>
                        <li class="divider"></li>
                        <li><a class="_nav-a-link" href="<?php echo site_url('profile/jump?tab=profile%2Fedit') ?>">Edit</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Inventory <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a class="_nav-a-link" href="<?php echo site_url('inventory/jump?tab=inventory') ?>">Lihat</a></li>
                        <li class="divider"></li>
                        <li><a class="_nav-a-link" href="<?php echo site_url('inventory/jump?tab=inventory%2Ftest') ?>">Pengerjaan</a></li>
                        <li class="divider"></li>
                        <li><a class="_nav-a-link" href="<?php echo site_url('inventory/jump?tab=inventory%2Fresult') ?>">Hasil</a></li>
                    </ul>
                </li>
                <li ><a id="logout" href="<?php echo site_url('auth/do_logout') ?>">Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="main">
    <div class="container" id="print_container">
        <div class="row vertical-align">
            <div class="col-sm-12 text-center">
                <p id="content_welcome" class="margin-bottom-4" style="font-weight: bold; font-size: 20px">HASIL INVENTORI</p>
                <p id="content_title" style="font-weight: bolder; font-size: 20px; margin: 4px">BERPIKIR KRITIS AKADEMIK</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                &nbsp;
            </div>
        </div>
        <div class="row vertical-align">
            <div class="col-sm-2  col-sm-offset-1 text-left">
                <p class="margin-left-1-cm">Nama</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['name'] ?></p>
            </div>
            <div class="col-sm-2  col-sm-offset-1 text-left">
                <p>Sekolah</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['school'] ?></p>
            </div>
        </div>
        <div class="row vertical-align">
            <div class="col-sm-2 col-sm-offset-1 text-left">
                <p class="margin-left-1-cm">NIS</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['credential'] ?></p>
            </div>
            <div class="col-sm-2  col-sm-offset-1 text-left">
                <p>Jenis Kelamin</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['gender'] ?></p>
            </div>
        </div>
        <div class="row vertical-align">
            <div class="col-sm-2  col-sm-offset-1 text-left">
                <p class="margin-left-1-cm">Kelas</p>
            </div>
            <div class="col-sm-3 no-padding-side">
                <p>: <?php echo $profile['grade'] ?></p>
            </div>
            <div class="col-sm-2  col-sm-offset-1 text-left">
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
                <p id="content_title" style="margin: 4px; font-size: 16px;">Berdasarkan pengisian inventori “Berpikir Kritis Akademik”
                    <b><?php echo strtoupper($profile['name']) ?></b>&nbsp;memiliki kemampuan berpikir kritis sebesar
                    <b><?php printf("%.4g%%", $result['value']) ?></b>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <table class="table">
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
                    <b>Saran :</b> <?php echo sprintf($suggest, 'anda') ?>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"><\/script>')</script>
<script src="<?php echo base_url('/assets/js/plugins.min.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/report/display/student-display-report.min.js') ?>"></script>
</body>
</html>
