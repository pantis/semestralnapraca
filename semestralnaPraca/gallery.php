<?php
require "Application.php";


$app = new Application();

?>

<?php $app->header("Galeria"); ?>

<body class="background">

<?php $app->navbar(); ?>

<div class="container ramcek">
    <div class="row">
        <div class="col-md-3 galleryimg">
            <img src="gallery/g2vsdwg.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="gallery/sunvstes.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="gallery/pozadie.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 galleryimg">
            <img src="gallery/newlolskins.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="gallery/lolbracket.png" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="gallery/riven.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 galleryimg">
            <img src="gallery/riven1.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="gallery/g2vsgeng.jpg" class="img-fluid" alt="Responsive image">
        </div>
        <div class="col-md-3 galleryimg">
            <img src="gallery/tesvsfnc.png" class="img-fluid" alt="Responsive image">
        </div>
    </div>
</div>

<?php $app->footer(); ?>

</body>
</html>