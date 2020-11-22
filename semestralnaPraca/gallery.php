<?php
require "Aplikacia.php";


$storage = new Aplikacia();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Galeria</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>

    <link rel="stylesheet" href="styl.css">

</head>
<body class="background">
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse navbar-center" id="navbarSupportedContent">
        <img class="znacka" src="img/lollogo.png" alt="lologo">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Domov<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="guides.html">Prirucky</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="gallery.php">Galeria</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container ramcek">
    <div class="row">
        <div class="col-md-3 galleryimg">
            <img src="img/g2vsdwg.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="img/sunvstes.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="img/pozadie.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 galleryimg">
            <img src="img/newlolskins.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="img/lolbracket.png" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="img/riven.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 galleryimg">
            <img src="img/riven1.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="img/g2vsgeng.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="img/tesvsfnc.png" class="img-fluid" alt="Responsive image">
        </div>
    </div>
</div>
<footer>
    Patrik Mydlar
</footer>
</body>
</html>