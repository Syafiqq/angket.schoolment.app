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
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/normalize.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/main.css') ?>">

    <link href="<?php echo base_url('/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

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
                <li>
                    <a href="<?php echo site_url('inventory') ?>">Inventory</a>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a id="logout" href="<?php echo site_url('auth/do_logout') ?>">Logout</a>
                </li>
                <li>
                    <a href="<?php echo site_url('profile') ?>">Profile</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

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
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 40px">No</th>
                            <th>Pertanyaan</th>
                            <th style="width: 150px">Kategori</th>
                            <th style="width: 150px">
                                <i>Favourable</i>
                            </th>
                            <th style="width: 150px">Aktif</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $favourURL = site_url('inventory/do_change_favour');
                        $activeURL = site_url('inventory/do_change_active');
                        foreach ($questions as $no => $question)
                        {
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

<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<script>window.jQuery || document.write('<script src="<?php echo base_url('/assets/bower_components/jquery/dist/jquery.min.js') ?>"><\/script>')</script>
<script src="<?php echo base_url('/assets/js/plugins.js') ?>"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url('/assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/tether/dist/js/tether.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/bower_components/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js') ?>"></script>
<script src="<?php echo base_url('/assets/js/inventory/view/view-counselor.min.js') ?>"></script>
</body>
</html>

