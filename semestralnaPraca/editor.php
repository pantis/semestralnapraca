<?php
require "ArticleLOL.php";
require "DBStorageSemestralna.php";

$storage = new DBStorageSemestralna();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Domov</title>

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
    <a class="navbar-brand" href="#"><img class="znacka" src="img/lollogo.png" alt="lollogo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Domov<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="guides.html">Prirucky</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="gallery.html">Galeria</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container ramcek">
    <?php foreach ($storage->loadAll() as $articleLOL) { ?>
        <div class="media pt-3 pb-3">
            <img class="d-flex align-self-center mr-3" src="<?php echo $articleLOL->getThumbnail() ?>" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-0"><?php echo $articleLOL->getNazov() ?></h5>
                <p><?php echo $articleLOL->getText() ?></p>
                <p class="mb-0"><?php echo $articleLOL->getText2() ?></p>
            </div>
        </div>
        <p></p>
    <?php } ?>
</div>
<footer>
    Patrik Mydlar
</footer>
</body>
</html>
