<?php
require "ArticleLOL.php";
require "Aplikacia.php";

$id = 0;
$title = "";
$text = "";
$thumbnail = "";
$update = false;

$storage = new Aplikacia();

if (isset($_POST['vytvorit'])) {
    $thumbnail = $_FILES['file']['name'];
    $thumbnailtmp = $_FILES['file']['tmp_name'];
    $priecinok = 'img/' . $thumbnail;
    move_uploaded_file($thumbnailtmp, $priecinok);

    $title = $_POST['title'];
    $text = $_POST['text'];
    $storage->createArticle($title, $text, $thumbnail);

    header('location: editor.php');
}

if (isset($_GET['delete'])) {
    $storage->deleteArticle($_GET['delete']);

    header('location: editor.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $row = $storage->getArticle($id);
    $title = $row['title'];
    $text = $row['text'];
    $thumbnail = $row['thumbnail'];
}

if (isset($_POST['ulozit'])) {
    if (isset($_FILES['file'])) {
        $thumbnail = $_FILES['file']['name'];
        $thumbnailtmp = $_FILES['file']['tmp_name'];
        $priecinok = 'img/' . $thumbnail;
        move_uploaded_file($thumbnailtmp, $priecinok);
    }
    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    if ($thumbnail == "") {
        $row = $storage->getArticle($id);
        $thumbnail = $row['thumbnail'];
    }
    $storage->updateArticle($id, $title, $text, $thumbnail);

    header('location: editor.php');
}

?>
<!-- skript na zamedzenie opatovneho odoslania formularu -->
<script>
    // window - okno prehliadaca, replaceState - zmena vstupu, location.href - vrati url adresu
    if (window.history.replaceState) { //
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editor</title>

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

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <img class="znacka" src="img/lollogo.png" alt="lollogo">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="editor.php">Editor<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>
<div class="container ramcek">
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="formGroupExampleInput">Nazov</label>
            <input type="text" class="form-control" id="title" name="title" size="50"
                   maxlength="50" value="<?php echo $title; ?>" required>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Text</label>
            <input type="text" class="form-control" id="text" name="text" value="<?php echo $text; ?>" required>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Thumbnail</label>
            <input type="file" class="form-control-file" id="thumbnail" name="file"
                   value="" accept="image/jpeg, image/png" <?php if($thumbnail == "") { ?> required <?php } ?>>
        </div>
        <div class="form-group">
            <?php if ($update == true) { ?>
                <button type="submit" class="btn btn-success" name="ulozit">Ulozit</button>
            <?php } else { ?>
                <button type="submit" class="btn btn-success" name="vytvorit">Vytvorit</button>
            <?php } ?>
        </div>
    </form>
    <p></p>
    <?php foreach ($storage->loadAll() as $articleLOL) { ?>
        <div class="media pt-3 pb-3">
            <img class="d-flex align-self-center mr-3" src="img/<?php echo $articleLOL->getThumbnail(); ?>"
                 alt="Generic placeholder image">
            <div class="media-body">
                <a href="editor.php?delete=<?php echo $articleLOL->getId(); ?>"
                   class="btn btn-danger float-right" style="margin-right: 15px">Delete</a>
                <a href="editor.php?edit=<?php echo $articleLOL->getId(); ?>"
                   class="btn btn-success float-right" style="margin-right: 15px">Edit</a>
                <h5 class="mt-0"><?php echo $articleLOL->getTitle(); ?></h5>
                <?php foreach ($storage->breakLongText($articleLOL->getText(), 500, 550) as $text) { ?>
                    <p><?php echo $text; ?></p>
                <?php } ?>
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
