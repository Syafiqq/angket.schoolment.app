<?php
/**
 * This <angket.schoolment.app> project created by :
 * Name         : syafiq
 * Date / Time  : 11 May 2017, 7:13 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */ ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/assets/css/baked/musicplaylist.min.css" rel="stylesheet">
    <script type="text/javascript" src="/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/baked/musicplaylist.min.js"></script>
</head>
<body>
<div class="container">
    <div class="column center">
        <h1>HTML5 Audio Player</h1>
        <h6>w/ responsive playlist</h6>
    </div>
    <div class="column add-bottom">
        <div id="mainwrap">
            <div id="nowPlay">
                <span class="left" id="npAction">Paused...</span>
                <span class="right" id="npTitle"></span>
            </div>
            <div id="audiowrap">
                <div id="audio0">
                    <audio preload id="audio1" controls="controls">Your browser does not support HTML5 Audio!</audio>
                </div>
                <div id="tracks">
                    <a id="btnPrev">&laquo;</a>
                    <a id="btnNext">&raquo;</a>
                </div>
            </div>
            <div id="plwrap">
                <ul id="plList"></ul>
            </div>
        </div>
    </div>
    <div class="column add-bottom center">
        <p>Created by
            <a href="http://www.markhillard.com/">mh</a>
           . Music by
            <a href="http://www.mythium.net/">Mythium</a>
           .
        </p>
        <p>Download:
            <a href="https://archive.org/download/mythium/mythium_vbr_mp3.zip">zip</a>
           /
            <a href="https://archive.org/download/mythium/mythium_archive.torrent">torrent</a>
        </p>
    </div>
</div>

</body>
</html>
