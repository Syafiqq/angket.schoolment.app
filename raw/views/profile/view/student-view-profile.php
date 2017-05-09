<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 03 May 2017, 6:45 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

use Carbon\Carbon;

setlocale(LC_TIME, 'id_ID');
if (!isset($profile))
{
    $profile = [];
}

$profile['school'] = $profile['school'] === null ? '-' : $profile['school'];
$profile['grade'] = $profile['grade'] === null ? '-' : $profile['grade'];
$profile['gender'] = $profile['gender'] === 'male' ? 'Laki Laki' : 'Perempuan';
$profile['address'] = $profile['address'] === null ? '-' : $profile['address'];
$profile['birthplace'] = $profile['birthplace'] === null ? '-' : $profile['birthplace'];
$profile['datebirth'] = $profile['datebirth'] === null ? '-' : Carbon::createFromFormat('Y-m-d', $profile['datebirth'])->formatLocalized('%d %B %Y');
$profile['birth'] = (($profile['birthplace'] === '-') && ($profile['datebirth'] === '-')) ? '-' : (($profile['birthplace'] === '-') ? $profile['datebirth'] : (($profile['datebirth'] === '-') ? $profile['birthplace'] : "{$profile['birthplace']}, {$profile['datebirth']}"));

?>


<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Profil</title>
    <meta name="a temlplate" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('/apple-touch-icon.png') ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/normalize.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.min.css') ?>">

    <link href="<?php echo base_url('/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/profile/view/student-view-profile.min.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('/assets/js/html5shiv.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/js/respond.min.js') ?>"></script>
    <![endif]-->
    <script src="<?php echo base_url('/assets/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
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
                <li class="active">
                    <a class="_nav-a-link" href="<?php echo site_url('dashboard/jump?tab=dashboard') ?>">B-Kritis
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Profile
                        <span class="caret"></span>
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span>
                    </a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li>
                            <a class="_nav-a-link" href="<?php echo site_url('profile/jump?tab=profile') ?>">Lihat</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="_nav-a-link" href="<?php echo site_url('profile/jump?tab=profile%2Fedit') ?>">Edit</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Inventory
                        <span class="caret"></span>
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span>
                    </a>
                    <ul class="dropdown-menu forAnimate" role="menu">
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
                <li>
                    <a id="logout" href="<?php echo site_url('auth/do_logout') ?>">Logout
                        <span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="main">
    <div class="container">
        <form class="form-horizontal">
            <div class="form-group">
                <label for="avatar" class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                    <img src="<?php echo base_url("{$profile['avatar']}") ?>" alt="<?php echo base_url("{$profile['avatar']}") ?>" class="img-thumbnail" id="avatar" height="256" width="256">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?php echo "{$profile['name']}" ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">NISN</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?php echo "{$profile['credential']}" ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?php echo "{$profile['gender']}" ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sekolah</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?php echo "{$profile['school']}" ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Kelas</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?php echo "{$profile['grade']}" ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Alamat</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?php echo "{$profile['address']}" ?></p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tempat, Tanggal Lahir</label>
                <div class="col-sm-10">
                    <p class="form-control-static"><?php echo "{$profile['birth']}" ?></p>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-default" href="<?php echo site_url('profile/edit') ?>" role="button">Ubah</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"><\/script>')</script>
<script src="<?php echo base_url('/assets/js/plugins.min.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/profile/view/student-view-profile.min.js') ?>"></script>
</body>
</html>


