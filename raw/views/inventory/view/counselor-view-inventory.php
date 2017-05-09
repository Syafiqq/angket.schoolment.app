<?php
/**
 * This <angket.000.app> project created by :
 * Name         : syafiq
 * Date / Time  : 04 May 2017, 5:10 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

if (!isset($categories))
{
    $categories = [];
}

if (!isset($favourables))
{
    $favourables = [];
}

if (!isset($questions))
{
    $questions = [];
}

$_categories = [];
foreach ($categories as $category)
{
    $_categories[".{$category['id']}"] = $category;
}
$categories = $_categories;
unset($_categories);

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Inventory</title>
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
    <link href="<?php echo base_url('/assets/css/inventory/view/counselor-view-inventory.min.css') ?>" rel="stylesheet">

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
                        <li><a class="_nav-a-link" href="<?php echo site_url('inventory/jump?tab=inventory%2Fadd') ?>">Tambah Inventory</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Data Siswa <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a>
                    <ul class="dropdown-menu forAnimate" role="menu">
                        <li><a class="_nav-a-link" href="<?php echo site_url('student/jump?tab=student') ?>">Aktifkan Siswa</a></li>
                        <li class="divider"></li>
                        <li><a class="_nav-a-link" href="<?php echo site_url('student/jump?tab=student%2Freport') ?>">Nilai Siswa</a></li>
                    </ul>
                </li>
                <li ><a id="logout" href="<?php echo site_url('auth/do_logout') ?>">Logout<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-off"></span></a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Panel heading</div>
                    <div class="panel-body">
                        <div class="col-sm-2 col-sm-offset-10">
                            <a class="btn btn-default" href="<?php echo site_url('inventory/add') ?>" role="button">Tambah Inventory</a>
                        </div>
                    </div>
                    <div class="table table-responsive">
                        <table id="inventory_tb" class="table table-hover">
                            <thead>
                            <tr>
                                <th style="width: 40px">No</th>
                                <th>Pertanyaan</th>
                                <th style="width: 150px">Kategori</th>
                                <th style="width: 150px">
                                    <i>Favourable</i>
                                </th>
                                <th style="width: 150px">Aktif</th>
                                <th style="width: 30px">Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $favourURL = site_url('inventory/do_change_favour');
                            $activeURL = site_url('inventory/do_change_active');
                            foreach ($questions as $no => $question)
                            {
                                $url = site_url("inventory/edit/{$question['id']}");
                                ++$no;
                                echo '<tr>';
                                echo "<td>{$no}</td>";
                                echo "<td>{$question['question']}</td>";
                                echo "<td>{$categories['.'.$question['category']]['name']}</td>";
                                echo '<td>';
                                echo "<select data-question-id=\"{$question['id']}\" id=\"favour\" name=\"favour\" class=\"form-control\" data-question-action=\"{$favourURL}\">";
                                foreach ($favourables as $favourable)
                                {
                                    $favourable['description'] = ucfirst($favourable['description']);
                                    $selected = $favourable['id'] === $question['favour'] ? 'selected' : '';
                                    echo "<option value=\"{$favourable['id']}\" {$selected}>{$favourable['description']}</option>";
                                }
                                echo '</select>';
                                echo '</td>';
                                echo '<td>';
                                echo "<select data-question-id=\"{$question['id']}\" id=\"active\" name=\"active\" class=\"form-control\" data-question-action=\"$activeURL\">";
                                foreach ([['id' => 1, 'description' => 'Aktif'], ['id' => 0, 'description' => 'Tidak Aktif']] as $active)
                                {
                                    $selected = $active['id'] === (int)$question['is_active'] ? 'selected' : '';
                                    echo "<option value=\"{$active['id']}\" {$selected}>{$active['description']}</option>";
                                }
                                echo '</select>';
                                echo '</td>';
                                echo "<td><a class=\"btn btn-default\" href=\"{$url}\" role=\"button\"><span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span></a></td>";
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net-autofill/js/dataTables.autoFill.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables-autofill-bootstrap/js/autoFill.bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net-buttons/js/dataTables.buttons.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/inventory/view/counselor-view-inventory.min.js') ?>"></script>
</body>
</html>

