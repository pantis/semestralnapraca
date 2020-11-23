<?php
require "ArticleLOL.php";
require "Application.php";

$id = 0;
$title = "";
$text = "";
$thumbnail = "";
$update = false;

$app = new Application();

if (isset($_POST['create'])) {
    $file = $_FILES['file'];
    $thumbnail = upload($file);

    $title = $_POST['title'];
    $text = $_POST['text'];
    $app->createArticle($title, $text, $thumbnail);

    header('location: editor.php');
}

if (isset($_GET['delete'])) {
    $app->deleteArticle($_GET['delete']);

    header('location: editor.php');
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;

    $row = $app->getArticle($id);

    $title = $row['title'];
    $text = $row['text'];
    $thumbnail = $row['thumbnail'];
}

if (isset($_POST['save'])) {
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $thumbnail = upload($file);
    }

    $id = $_POST['id'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    if ($thumbnail == "") {
        $row = $app->getArticle($id);
        $thumbnail = $row['thumbnail'];
    }

    $app->updateArticle($id, $title, $text, $thumbnail);

    header('location: editor.php');
}

    function upload($file){
        $thumbnail = $file['name'];
        $thumbnailTmp = $file['tmp_name'];
        $thumbnailSize = $file['size'];
        $thumbnailError = $file['error'];

        $thumbnailExt = explode('.', $thumbnail);
        $fileActualExt = strtolower(end($thumbnailExt));

        $validation = array('jpg', 'jpeg', 'png');

        if(in_array($fileActualExt, $validation)) {
            if($thumbnailError === 0) {
                if($thumbnailSize < 500000) {
                    $thumbnailNameNew = uniqid('', true) . "." . "$fileActualExt";
                    $folder = 'img/' . $thumbnailNameNew;
                    move_uploaded_file($thumbnailTmp, $folder);
                    return $thumbnailNameNew;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


?>
<!-- skript na zamedzenie opatovneho odoslania formularu -->
<script>
    // window - okno prehliadaca, replaceState - zmena vstupu, location.href - vrati url adresu
    if (window.history.replaceState) { //
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php $app->header("Editor"); ?>

<body class="background">

<?php $app->navbar(); ?>

<div class="container ramcek">
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label for="formGroupExampleInput">Nazov</label>
            <input type="text" class="form-control" id="title" name="title" size="50" pattern="(?=.*[A-Z]).{1,}"
                   maxlength="50" value="<?php echo $title; ?>" required>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Text</label>
            <input type="text" class="form-control" id="text" name="text" pattern="(?=.*[A-Z]).{1,}" value="<?php echo $text; ?>" required>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput2">Thumbnail</label>
            <input type="file" class="form-control-file" id="thumbnail" name="file"
                   value="" accept=".jpg, .jpeg, .png" <?php if($thumbnail == "") { ?> required <?php } ?>>
        </div>
        <div class="form-group">
            <?php if ($update == true) { ?>
                <button type="submit" class="btn btn-success" name="save">Ulozit</button>
            <?php } else { ?>
                <button type="submit" class="btn btn-success" name="create">Vytvorit</button>
            <?php } ?>
        </div>
    </form>
    <p></p>
    <?php foreach ($app->loadAll() as $articleLOL) { ?>
        <div class="media pt-3 pb-3">
            <img class="d-flex align-self-center mr-3" src="img/<?php echo $articleLOL->getThumbnail(); ?>"
                 alt="Generic placeholder image">
            <div class="media-body">
                <a href="editor.php?delete=<?php echo $articleLOL->getId(); ?>"
                   class="btn btn-danger float-right" style="margin-right: 15px">Delete</a>
                <a href="editor.php?edit=<?php echo $articleLOL->getId(); ?>"
                   class="btn btn-success float-right" style="margin-right: 15px">Edit</a>
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
