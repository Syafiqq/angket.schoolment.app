<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 28 April 2017, 3:15 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login</title>
    <meta name="a temlplate" content="">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('/apple-touch-icon.png') ?>">
    <!-- Place favicon.ico in the root directory -->

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/normalize.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.min.css') ?>">

    <link href="<?php echo base_url('/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/css/auth/login/student-login-auth.min.css') ?>" rel="stylesheet">

    <style>
        .audiojs {
            background: transparent;
            box-shadow: none;
        }

        .audiojs div {
            display: none;
        }
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('/assets/js/html5shiv.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/js/respond.min.js') ?>"></script>
    <![endif]-->
    <script src="<?php echo base_url('/assets/js/vendor/modernizr-2.8.3.min.js') ?>"></script>
</head>
<body>
<div class="container">

    <form class="well form-horizontal" id="login" action="<?php echo site_url('auth/do_login') ?>" method="post">
        <fieldset>
            <!-- Form Name -->
            <legend>Contact Us Today!</legend>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label" for="credential">NISN</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="credential" placeholder="NISN" name="credential" type="number" class="form-control">
                    </div>
                </div>
            </div>

            <!-- Text input-->

            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Password</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                </div>
            </div>
            <input type="hidden" name="role" value="student">

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning">Login
                        <span class="glyphicon glyphicon-send"></span>
                    </button>
                </div>
            </div>

            <div class="form-group" style="margin-top: 50px">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <b>Klik</b>
                    <a href="<?php echo site_url('/auth/login?role=counselor') ?>" type="submit" class="btn btn-warning">Konselor
                        <span class="glyphicon glyphicon-send"></span>
                    </a>
                    <b>&nbsp;Apabila Anda Konselor ?</b>
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <b>Klik</b>
                    <a href="<?php echo site_url('/auth/register?role=student') ?>" type="submit" class="btn btn-warning">Daftar
                        <span class="glyphicon glyphicon-send"></span>
                    </a>
                    <b>&nbsp;Apabila Belum Punya Akun ?</b>
                </div>
            </div>

            <div class="form-group" style="margin-top: 20px">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <b>Klik</b>
                    <a href="<?php echo site_url('/auth/recover?role=student') ?>" type="submit" class="btn btn-warning">Lupa
                        <span class="glyphicon glyphicon-send"></span>
                    </a>
                    <b>&nbsp;Apabila Anda Lupa ?</b>
                </div>
            </div>

        </fieldset>
    </form>
</div>
<audio src="<?php echo base_url('/assets/audio/mp3/black_heaven.mp3') ?>" preload="auto" autoplay loop/>

<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"><\/script>')</script>
<script src="<?php echo base_url('/assets/js/plugins.min.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/jquery-serialize-object/dist/jquery.serialize-object.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/audiojs/audiojs/audio.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/bower_components/audiojs/audiojs/audio.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/js/auth/login/student-login-auth.min.js') ?>"></script>

</body>
</html>

