<?php
require "ArticleLOL.php";
require "Application.php";


$app = new Application();

?>

<?php $app->header("Domov"); ?>

<body class="background">

<?php $app->navbar(); ?>

<div class="container ramcek">
    <?php foreach ($app->loadAll() as $articleLOL) { ?>
        <div class="media pt-3 pb-3">
            <img class="d-flex align-self-center mr-3" src="img/<?php echo $articleLOL->getThumbnail(); ?>" alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-0"><?php echo $articleLOL->getTitle(); ?></h5>
                <?php foreach ($app->breakLongText($articleLOL->getText(), 500, 550) as $text) { ?>
                    <p><?php echo $text; ?></p>
                <?php } ?>
            </div>
        </div>
        <p></p>
    <?php } ?>
</div>

<?php $app->footer(); ?>

</body>
</html>