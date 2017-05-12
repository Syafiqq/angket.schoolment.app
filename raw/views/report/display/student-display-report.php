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
$profile['assets']['record']['total'] = $profile['assets']['record']['total'] === null ? 'Belum Pernah' : $profile['assets']['record']['total'];
$profile['assets']['record']['latest'] = $profile['assets']['record']['latest'] === null ? ['date' => 'Belum Pernah', 'value' => 'Belum Pernah'] : ['date' => Carbon::createFromFormat('Y-m-d H:i:s', $profile['assets']['record']['latest']['date'])->formatLocalized('%d %B %Y'), 'value' => sprintf('%.4g%%', $profile['assets']['record']['latest']['value'])];
$profile['assets']['record']['highest'] = $profile['assets']['record']['highest'] === null ? ['date' => 'Belum Pernah', 'value' => 'Belum Pernah'] : ['date' => Carbon::createFromFormat('Y-m-d H:i:s', $profile['assets']['record']['highest']['date'])->formatLocalized('%d %B %Y'), 'value' => sprintf('%.4g%%', $profile['assets']['record']['highest']['value'])];
$profile['assets']['record']['lowest'] = $profile['assets']['record']['lowest'] === null ? ['date' => 'Belum Pernah', 'value' => 'Belum Pernah'] : ['date' => Carbon::createFromFormat('Y-m-d H:i:s', $profile['assets']['record']['lowest']['date'])->formatLocalized('%d %B %Y'), 'value' => sprintf('%.4g%%', $profile['assets']['record']['lowest']['value'])];

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
    <link href="<?php echo base_url('/assets/bower_components/components-font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/Ionicons/css/ionicons.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/AdminLTE/dist/css/AdminLTE.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/AdminLTE/dist/css/skins/skin-blue.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/bootstrap3_player/css/bootstrap3_player.css') ?>" rel="stylesheet">
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
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="<?php echo site_url('dashboard/jump?tab=dashboard') ?>" class="navbar-brand _nav-a-link">
                        <b>Schoolment</b>
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a class="_nav-a-link" href="<?php echo site_url('dashboard/jump?tab=dashboard') ?>">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown">Profil
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a class="_nav-a-link" href="<?php echo site_url('profile/jump?tab=profile') ?>">Lihat</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a class="_nav-a-link" href="<?php echo site_url('profile/jump?tab=profile%2Fedit') ?>">Ubah</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown">Inventori
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a class="_nav-a-link" href="<?php echo site_url('inventory/jump?tab=inventory') ?>">Lihat</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a class="_nav-a-link" href="<?php echo site_url('inventory/jump?tab=inventory%2Ftest') ?>">Pengerjaan</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a class="_nav-a-link" href="<?php echo site_url('inventory/jump?tab=inventory%2Fresult') ?>">Hasil</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a id="logout" class="btn btn-danger btn-sm" href="<?php echo site_url('auth/do_logout') ?>">Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
        <div class="container" style="margin-bottom: 60px">
            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url($profile['avatar']) ?>" alt="User profile picture">

                                <h3 class="profile-username text-center"><?php echo $profile['name'] ?></h3>

                                <p class="text-muted text-center"><?php echo strlen($profile['school']) <= 0 ?  '[Data Tidak Lengkap]' : $profile['school'] ?></p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Jumlah Pengerjaan</b>
                                        <a class="pull-right"><?php echo $profile['assets']['record']['total'] ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Terakhir</b>
                                        <a class="pull-right">
                                            <abbr title="<?php echo $profile['assets']['record']['latest']['value'] ?>"><?php echo $profile['assets']['record']['latest']['date'] ?></abbr>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tertinggi</b>
                                        <a class="pull-right">
                                            <abbr title="<?php echo $profile['assets']['record']['highest']['date'] ?>"><?php echo $profile['assets']['record']['highest']['value'] ?></abbr>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Terendah</b>
                                        <a class="pull-right">
                                            <abbr title="<?php echo $profile['assets']['record']['lowest']['date'] ?>"><?php echo $profile['assets']['record']['lowest']['value'] ?></abbr>
                                        </a>
                                    </li>
                                </ul>

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                        <!-- About Me Box -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Musik Pengantar</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <ol id="plList">
                                    <li data-audio="<?php echo base_url('/assets/audio/mp3/music1.mp3') ?>">Musik 1</li>
                                    <li data-audio="<?php echo base_url('/assets/audio/mp3/music2.mp3') ?>">Musik 2</li>
                                    <li data-audio="<?php echo base_url('/assets/audio/mp3/music3.mp3') ?>">Musik 3</li>
                                </ol>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Detail Pengerjaan</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="row vertical-align">
                                            <div class="col-sm-12 text-center">
                                                <p id="content_welcome" class="margin-bottom-4" style="font-weight: bold; font-size: 20px">HASIL INVENTORI</p>
                                                <p id="content_title" style="font-weight: bolder; font-size: 20px; margin: 4px"><b><i>SCHOOL ENGAGEMENT</i></b> SISWA</p>
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
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <strong>Copyright &copy; 2014-<?php echo Carbon::createFromFormat('Y-m-d H:i:s', \Carbon\Carbon::now())->format('Y') ?>.</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <strong>
                                <a href="http://almsaeedstudio.com">Almsaeed Studio</a>
                                .
                            </strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            All rights reserved.
                        </div>
                    </div>
                </div>
                <div class="col-sm-10 _cs-audio">
                    <audio preload id="music" controls="controls">Browser anda tidak support untuk memutar Musik</audio>
                </div>
            </div>
        </div>
        <!-- /.container -->
    </footer>
</div>

<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"><\/script>')</script>
<script src="<?php echo base_url('/assets/js/plugins.min.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/AdminLTE/plugins/fastclick/fastclick.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/AdminLTE/dist/js/app.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/bootstrap3_player/js/bootstrap3_player.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/report/display/student-display-report.min.js') ?>"></script>
</body>
</html>
