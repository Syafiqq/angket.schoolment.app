<?php
/**
 * This <angket.bipolar.app> project created by :
 * Name         : syafiq
 * Date / Time  : 10 May 2017, 1:09 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inventory Bipolar Siswa</title>

    <!-- Bootstrap Core CSS -->
    <link href="/assets/baked/freelancer/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="/assets/baked/freelancer/css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/assets/baked/freelancer/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index" >
<div id="skipnav"><a href="#maincontent">Lewati menuju konten utama</a></div>

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Navigasi</span> Menu <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="#page-top">Inventori Bipolar Siswa</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="#about">Pengantar</a>
                </li>
                <li class="page-scroll">
                    <a href="#portfolio">Profil Pengembang</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<!-- Header -->
<header style="background-image:url(/assets/baked/freelancer/img/backhome.png) !important; size:1366x768">
    <div class="container" id="maincontent" tabindex="-1">
        <div class="row">
            <div class="col-lg-12">
                <img class="img-responsive" src="/assets/baked/freelancer/img/profile.png"  width=300 height=300 alt="">
                <div class="intro-text">
                    <h1 class="name">Inventori Bipolar Siswa SMA</h1>
                    <hr class="star-light">
                    <span class="skills">Aplikasi Asesmen Non-Tes Bimbingan dan Konseling</span>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- About Section -->
<section class="success" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Pengantar</h2>
                <hr class="star-light">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-2">
                <p>FreGangguan bipolar adalah suatu gangguan suasana hati (mood atau perasaan) yang sangat ekstrim dengan dua kutub, yakni depresi (perasaan sedih berlebihan) dan mania (perasaan bahagia berlebihan) yang mengganggu keadaan individu dan merupakan pemicu upaya bunuh diri. Gangguan ini termasuk gangguan otak yang menyebabkan perubahan perubahan yang tidak biasa pada suasana hati, energi, aktivitas, dan kemampuan untuk melakukan tugas-tugas harian. Perasaan mereka mudah naik dan turun secara berlebihan dibandingkan manusia normal pada umumnya (Franky, 2013) .</p>
            </div>
            <div class="col-lg-4">
                <p>Herditya (2012) mengatakan hal yang sama bahwa bipolar adalah bagian integral dari psikologi    klinis. Terdapat dua jenis bipolar yaitu mania dan depresi. Gangguan bipolar adalah gangguan mood dengan yang berupa mania (peningkatan mood dan peningkatan aktivitas) dan depresi (penurunan mood dan penurunan aktivitas). Mania ditandai dengan suasana hati gembira, reaktivitas (peningkatan aktivitas), agresivitas, peningkatan aktivitas psikomotor, dan penurunan kebutuhan untuk tidur berlangsung untuk jangka waktu minimal satu minggu.</p>
            </div>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a href="<?php echo site_url('auth/login')?>" class="btn btn-lg btn-outline">
                    <i class="fa fa-download" href=""></i> Masuk Aplikasi
                </a>
            </div>
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <a href="<?php echo site_url('auth/register')?>" class="btn btn-lg btn-outline">
                    <i class="fa fa-download" href=""></i> Daftar Akun
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Portfolio Grid Section -->
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Profil Pengembang</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="/assets/baked/freelancer/img/portfolio/P-Nur.JPG" class="img-responsive" style="margin:auto" alt="Cabin">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal2" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="/assets/baked/freelancer/img/portfolio/fa.jpg" class="img-responsive" style="margin:auto" alt="Slice of cake">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal3" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="/assets/baked/freelancer/img/portfolio/l.jpg" class="img-responsive" style="margin:auto" alt="Circus tent">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal4" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="/assets/baked/freelancer/img/portfolio/f.jpg" class="img-responsive" style="margin:auto" alt="Game controller">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="/assets/baked/freelancer/img/portfolio/m.jpg" class="img-responsive" style="margin:auto" alt="Safe">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal6" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="/assets/baked/freelancer/img/portfolio/k.jpg" class="img-responsive" style="margin:auto" alt="Submarine">
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal7" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="/assets/baked/freelancer/img/portfolio/s.png" class="img-responsive" style="margin:auto" alt="Submarine">
                </a>
            </div>
            <div class="col-sm-4 portfolio-item">
                <a href="#portfolioModal8" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                    <img src="/assets/baked/freelancer/img/portfolio/h.jpg" class="img-responsive" style="margin:auto" alt="Submarine">
                </a>
            </div>
        </div>
    </div>
    </div>
</section>


<!-- Footer -->
<footer class="text-center">
    <div class="footer-above">
        <div class="container">
            <div class="row">
                <div class="footer-col col-md-4">
                    <h3>Universitas Negeri Malang</h3>
                    <p>Jl. Semarang No. 5
                        <br>Malang</p>
                </div>
                <div class="footer-col col-md-4">
                    <h3></h3>
                    <ul class="list-inline">
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only"></span><i class="fa fa-fw fa-"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only"> </span><i class="fa fa-fw fa--"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only"></span><i class="fa fa-fw fa-"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only"> </span><i class="fa fa-fw fa-"></i></a>
                        </li>
                        <li>
                            <a href="#" class="btn-social btn-outline"><span class="sr-only"></span><i class="fa fa-fw fa-"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="footer-col col-md-4">
                    <h3>About Freelancer</h3>
                    <p>Freelance is a free to use, open source Bootstrap theme created by <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-below">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    &copy; konseling-bipolar.esy.es 2017
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
<div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
    <a class="btn btn-primary" href="#page-top">
        <i class="fa fa-chevron-up"></i>
    </a>
</div>

<!-- Portfolio Modals -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Prof. Dr. Hj. Nur Hidayah, M.Pd</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/P-Nur.JPG" class="img-responsive img-centered" alt="">
                        <p>Lahir di Gresik, 17 Agustus 1959 dan Bertempat tinggal di Perum Permata Hijau D/57. Memiliki Hobby Membaca dan Motto “ Be Your Self”. Telah selesai menempuh Pendidikan S-1, S-2, S-3 jurusan Bimbingan dan Konseling dan telah menjadi dosen dan guru besar Bimbingan dan Konseling Universitas Megeri Malang </a></p>
                        <ul class="list-inline item-details">
                            <li>Email
                                <strong><a>nur.hidayah.fip@um.ac.id </a>
                                </strong>
                            </li>

                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Feny Andriyanti</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/fa.jpg" class="img-responsive img-centered" alt="">
                        <p>Lahir di Sidoarjo, 17 Juni 1995 dan beralamat di Ds. Janti, Kec. Tarik,Kab.Sidoarjo. Memiliki Hobby Browsing dan Motto Inginkan yang Terbaik dan Lakukan yang Terbaik</p>
                        <ul class="list-inline item-details">
                            <li>Email
                                <strong><a >Feny.andriyanti95@gmail.com     </a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Maghfirotul Amalia</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/l.jpg" class="img-responsive img-centered" alt="">
                        <p>Lahir di Malang, 06 April 1995 dan beralamat Jl Raya Pang. Sudirman No.74 Bululawang-Malang. Memiliki Hobi berwisata kuliner dan Motto Selalu Berpikir Besar dan Bertindak Mulai Sekarang</p>
                        <ul class="list-inline item-details">
                            <li>Email
                                <strong><a >amalia_maghfirotul@yahoo.com</a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Fauzi Okta Dyanto</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/f.jpg" class="img-responsive img-centered" alt="">
                        <p> Lahir di Blitar 16 Oktober 1996 dan beralamat di Jl. Jendral Sudirman no.25 desa Ponggok, kec. Ponggok, kab. Blitar. Memiliki Hobi bermain Sepak Bola dan memiliki motto "There I no limit of struggling"
                        </p>
                        <ul class="list-inline item-details">
                            <li>Email
                                <strong><a href="http://startbootstrap.com">fauziokta92@gmail.com </a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Maya Enggar Siara</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/m.jpg" class="img-responsive img-centered" alt="">
                        <p>Lahir di Malang 30 September 1996 dan beralamat di Jl. Sersan sapar rt 13 rw. 02 kedawung Pojok, Dampit. Memiliki hobi singing dan memiliki motto "Work Hard, Play Hard, Be happy" </p>
                        <ul class="list-inline item-details">
                            <li>Email
                                <strong><a href="http://startbootstrap.com">mayaenggar30@gmail.com</a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Kania Shintia Duday</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/k.jpg" class="img-responsive img-centered" alt="">
                        <p>Lahir di Biak Papua 10 Desember 1996 dan beralamatkan di Jl. Timika Indah 2 Perumahan PT.Freeport. Memiliki hobi Traveling dan Motto "Learn From Yesterday, Live For Today, Hope for Tomorrow" </p>
                        <ul class="list-inline item-details">
                            <li>Email
                                <strong><a href="http://startbootstrap.com">kaniashintia@yahoo.com </a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal7" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Muhammad Syafiq, S.Kom</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/s.png" class="img-responsive img-centered" alt="">
                        <p>Lahir di Pasuruan, 16 Desember 1993 dan beralamat di Jl. Apel I No. 449 Bangil, Pasuruan. Memiliki Motto Hidup Bermakna seperti Larry. Telah menyelesaikan Pendidikan S-1 Teknik Informatika Universitas Brawijaya</p>
                        <ul class="list-inline item-details">
                            <li>Email
                                <strong><a href="http://startbootstrap.com"> id.muhammad.syafiq@gmail.com</a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal8" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Husni Hanafi, S.Pd</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/h.jpg" class="img-responsive img-centered" alt="">
                        <p>Lahir di Biak Papua 10 Desember 1996 dan beralamatkan di Jl. Timika Indah 2 Perumahan PT.Freeport. Memiliki hobi Traveling dan Motto "Learn From Yesterday, Live For Today, Hope for Tomorrow" </p>
                        <ul class="list-inline item-details">
                            <li>Email
                                <strong><a href="http://startbootstrap.com">husnihanafi.19@gmail.com</a>
                                </strong>
                            </li>
                        </ul>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <div class="modal-body">
                        <h2>Project Title</h2>
                        <hr class="star-primary">
                        <img src="/assets/baked/freelancer/img/portfolio/submarine.png" class="img-responsive img-centered" alt="">
                        <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                        <ul class="list-inline item-details">
                            <li>Client:
                                <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                </strong>
                            </li>
                            <li>Date:
                                <strong><a href="http://startbootstrap.com">April 2014</a>
                                </strong>
                            </li>
                            <li>Service:
                                <strong><a href="http://startbootstrap.com">Web Development</a>
                                </strong>
                            </li>
                        </ul>
                        <button id="btnSubmit" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="/assets/baked/freelancer/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/assets/baked/freelancer/vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

<!-- Contact Form JavaScript -->
<script src="/assets/baked/freelancer/js/jqBootstrapValidation.min.js"></script>
<script src="/assets/baked/freelancer/js/contact_me.min.js"></script>

<!-- Theme JavaScript -->
<script src="/assets/baked/freelancer/js/freelancer.min.js"></script>

</body>

</html>
