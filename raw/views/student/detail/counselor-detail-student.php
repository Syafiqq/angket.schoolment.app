<?php
/**
 * This <angket.bkritis.app> project created by :
 * Name         : syafiq
 * Date / Time  : 09 May 2017, 3:54 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

setlocale(LC_TIME, 'id_ID');

if (!isset($answered))
{
    $answered = [];
}

if (!isset($categories))
{
    $categories = [];
}
$profile['birthplace'] = $profile['birthplace'] === null ? '-' : $profile['birthplace'];
$profile['datebirth'] = $profile['datebirth'] === null ? '-' : Carbon::createFromFormat('Y-m-d', $profile['datebirth'])->formatLocalized('%d %B %Y');
$profile['birth'] = (($profile['birthplace'] === '-') && ($profile['datebirth'] === '-')) ? '-' : (($profile['birthplace'] === '-') ? $profile['datebirth'] : (($profile['datebirth'] === '-') ? $profile['birthplace'] : "{$profile['birthplace']}, {$profile['datebirth']}"));
$counselor['assets']['record']['latest'] = $counselor['assets']['record']['latest'] === null ? 'Belum Pernah' : Carbon::createFromFormat('Y-m-d H:i:s', $counselor['assets']['record']['latest'][0]['answer_at'])->formatLocalized('%d %B %Y %H:%M');

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Daftar Siswa</title>
    <meta name="a temlplate" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('/apple-touch-icon.png') ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/normalize.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.min.css') ?>">

    <link href="<?php echo base_url('/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/datatables-autofill-bootstrap/css/autoFill.bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/components-font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/Ionicons/css/ionicons.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/AdminLTE/dist/css/AdminLTE.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/AdminLTE/dist/css/skins/skin-blue.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/bootstrap3_player/css/bootstrap3_player.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/student/detail/counselor-detail-student.min.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('/assets/js/html5shiv.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/js/respond.min.js') ?>"></script>
    <![endif]-->
    <script src="<?php echo base_url('/assets/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
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
                        <li>
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
                                    <a class="_nav-a-link" href="<?php echo site_url('inventory/jump?tab=inventory%2Fadd') ?>">Tambah
                                        <i>Item</i>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown active">
                            <a class="dropdown-toggle" data-toggle="dropdown">Siswa
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a class="_nav-a-link" href="<?php echo site_url('student/jump?tab=student') ?>">Aktivasi</a>
                                </li>
                                <li class="divider"></li>
                                <li class="active">
                                    <a class="_nav-a-link" href="<?php echo site_url('student/jump?tab=student%2Freport') ?>">Hasil Siswa</a>
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
                                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url($counselor['avatar']) ?>" alt="User profile picture">

                                <h3 class="profile-username text-center"><?php echo $counselor['name'] ?></h3>

                                <p class="text-muted text-center"><?php echo strlen($counselor['school']) <= 0 ? '[Data Tidak Lengkap]' : $counselor['school'] ?></p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Jumlah Konselor</b>
                                        <a class="pull-right">
                                            <abbr title="<?php echo "Laki Laki = {$counselor['assets']['record']['counselor']['male']}, Perempuan = {$counselor['assets']['record']['counselor']['female']}" ?>"><?php echo($counselor['assets']['record']['counselor']['female'] + $counselor['assets']['record']['counselor']['male']) ?></abbr>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jumlah Siswa</b>
                                        <a class="pull-right">
                                            <abbr title="<?php echo "Laki Laki = {$counselor['assets']['record']['student']['male']}, Perempuan = {$counselor['assets']['record']['student']['female']}" ?>"><?php echo($counselor['assets']['record']['student']['female'] + $counselor['assets']['record']['student']['male']) ?></abbr>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jumlah Pernyataan</b>
                                        <a class="pull-right">
                                            <abbr title="<?php echo "Aktif = {$counselor['assets']['record']['question']['active']}, Nonaktif = {$counselor['assets']['record']['question']['inactive']}" ?>"><?php echo($counselor['assets']['record']['question']['active'] + $counselor['assets']['record']['question']['inactive']) ?></abbr>
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Terakhir</b>
                                        <a class="pull-right">
                                            <?php echo $counselor['assets']['record']['latest'] ?>
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
                                <h3 class="box-title">Detail Siswa</h3>
                                <div class="box-tools pull-right">
                                    <!-- Buttons, labels, and many other things can be placed here! -->
                                    <!-- Here is a label for example -->
                                    <span class="label label-primary"></span>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Identitas</div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <dl class="dl-horizontal" style="margin-top: 50px">
                                                        <dt>Nama</dt>
                                                        <dd><?php echo ": {$profile['name']}" ?></dd>
                                                        <dt>NISN</dt>
                                                        <dd><?php echo ": {$profile['credential']}" ?></dd>
                                                        <dt>Kelas</dt>
                                                        <dd><?php echo ": {$profile['grade']}" ?></dd>
                                                        <dt>Sekolah</dt>
                                                        <dd><?php echo ": {$profile['school']}" ?></dd>
                                                        <dt>TTL</dt>
                                                        <dd><?php echo ": {$profile['birth']}" ?></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                            <div class="panel-body">
                                            </div>
                                            <div class="table-responsive">
                                                <table id="detail_tb" class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 40px">No</th>
                                                        <th style="width: 150px">Pengisian</th>
                                                        <?php foreach ($categories as $cv)
                                                            echo "<th style=\"width: 150px\">{$cv['name']}</th>"
                                                        ?>
                                                        <th style="width: 100px">Tampilkan</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $no = 0;
                                                    foreach ($answered as $av)
                                                    {
                                                        ++$no;
                                                        $av['answer_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $av['answer_at'])->formatLocalized('%d %B %Y %H:%M');
                                                        echo '<tr>';
                                                        echo "<td>{$no}</td>";
                                                        echo "<td>{$av['answer_at']}</td>";
                                                        foreach ($categories as $cv)
                                                        {
                                                            $cid = ".{$cv['id']}";
                                                            printf('<td>%.4f %%</td>', $av['category'][$cid]);
                                                        }
                                                        $url = site_url("report/publish?answer={$av['id']}");
                                                        echo "<td><a class=\"btn btn-default\" href=\"{$url}\" role=\"button\">Cetak</a></td>";
                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                    </tbody>
                                                </table>
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
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net-autofill/js/dataTables.autoFill.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables-autofill-bootstrap/js/autoFill.bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net-buttons/js/dataTables.buttons.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/AdminLTE/plugins/fastclick/fastclick.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/AdminLTE/dist/js/app.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/bootstrap3_player/js/bootstrap3_player.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/student/detail/counselor-detail-student.min.js') ?>"></script>
</body>
</html>
