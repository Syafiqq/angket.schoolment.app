<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 02 May 2017, 6:07 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

setlocale(LC_TIME, 'id_ID');
$profile['gender'] = $profile['gender'] === 'male' ? 'Laki Laki' : 'Perempuan';
$profile['address'] = $profile['address'] === null ? '' : $profile['address'];
$profile['birthplace'] = $profile['birthplace'] === null ? '' : $profile['birthplace'];
$profile['datebirth'] = $profile['datebirth'] === null ? '' : $profile['datebirth'];
?>


<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Edit Profil</title>
    <meta name="a temlplate" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('/apple-touch-icon.png') ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.css') ?>">

    <link href="<?php echo base_url('/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('/assets/js/html5shiv.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/js/respond.min.js') ?>"></script>
    <![endif]-->
    <script src="<?php echo base_url('/assets/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('dashboard') ?>">Site</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?php echo site_url('profile') ?>">Profile</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div class="container">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="avatar" class="col-sm-2 control-label">Avatar</label>
            <div class="col-sm-10">
                <img src="<?php echo base_url("{$profile['avatar']}") ?>" alt="<?php echo base_url("{$profile['avatar']}") ?>" class="img-thumbnail" id="avatar" height="256" width="256">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input id="imageupload" type="file" name="image" data-url="<?php echo site_url('profile/do_edit_avatar') ?>" class="btn col-sm-12">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?php echo "{$profile['name']}" ?></p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">NIP/NIK</label>
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
    </form>

    <form id="edit" action="<?php echo site_url('profile/do_edit_additional') ?>" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" placeholder="Alamat" name="address" value="<?php echo "{$profile['address']}" ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="birthplace" class="col-sm-2 control-label">Tempat Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="birthplace" placeholder="Tempat Lahir" name="birthplace" value="<?php echo "{$profile['birthplace']}" ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="datebirth" class="col-sm-2 control-label">Tanggal Lahir</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="datebirth" name="datebirth" placeholder="Tanggal Lahir" value="<?php echo "{$profile['datebirth']}" ?>"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Simpan</button>
            </div>
        </div>
    </form>
</div>

<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"><\/script>')</script>
<script src="<?php echo base_url('/assets/js/plugins.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/jquery-ui/ui/widget.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/jquery-iframe-transport/index.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/jquery.fileupload/index.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/moment/min/moment.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/jquery-serialize-object/dist/jquery.serialize-object.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/profile/edit/edit-profile-counselor.min.js') ?>"></script>
</body>
</html>