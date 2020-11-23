<?php

class Application
{
    private $user = "root";
    private $pass = "dtb456";
    private $db = "lolclanky";
    private $host = "localhost";
    private $pdo;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    /**
     * @return ArticleLOL[]
     */
    public function loadAll()
    {
        $stmt = $this->pdo->query("select * from articles order by id desc");
        $result = [];
        while ($row = $stmt->fetch()) {
            $article = new ArticleLOL($row["title"], $row["text"], $row["thumbnail"]);
            $article->setId($row["id"]);
            $result[] = $article;
        }
        return $result;
    }

    public function createArticle($title, $text, $thumbnail)
    {
        $article = new ArticleLOL($title, $text, $thumbnail);
        $this->Save($article);
    }

    public function Save(ArticleLOL $article)
    {
        $stmt = $this->pdo->prepare("insert into articles (title, text, thumbnail) VALUES (?, ?, ?)");
        $stmt->execute([$article->getTitle(), $article->getText(), $article->getThumbnail()]);
    }

    public function deleteArticle($id)
    {
        $stmt = $this->pdo->prepare("delete from articles where id=?");
        $stmt->execute([$id]);
    }

    public function getArticle($id)
    {
        $stmt = $this->pdo->prepare("select * from articles where id=?");
        $stmt->execute([$id]);
        if (count([$stmt]) == 1) {
            $result = $stmt->fetch();
        }
        return $result;
    }

    public function updateArticle($id, $title, $text, $thumbnail)
    {
        $stmt = $this->pdo->prepare("update articles set title=?, text=?, 
                            thumbnail=? where id=?");
        $stmt->execute([$title, $text, $thumbnail, $id]);
    }

    function breakLongText($text, $length = 200, $maxLength = 250)
    {
        //dlzka textu
        $textLength = strlen($text);

        //pole do ktoreho sa bude ukladat text
        $splitText = [];

        //ak je text kratky funkcia sa ukonci a vrati sa cely text
        if (!($textLength > $maxLength)) {
            $splitText[] = $text;
            return $splitText;
        }

        //oddelovac
        $needle = '.';

        // prechadzanie textu, ukladaniu do vyslednej premennej a mazanie uz prejdeneho textu
        while (strlen($text) > $length) {

            $end = strpos($text, $needle, $length);

            if ($end === false) {

                $splitText[] = substr($text, 0);
                $text = '';
                break;

            }

            $end++;
            $splitText[] = substr($text, 0, $end);
            $text = substr_replace($text, '', 0, $end);

        }

        if ($text) {
            $splitText[] = substr($text, 0);
        }

        return $splitText;

    }

    function navbar()
    {
        echo ' <nav class="navbar navbar-expand-lg navbar-light bg-white">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <img class="znacka" src="gallery/lollogo.png" alt="lollogo">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="home.php">Domov<span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="guides.php">Prirucky</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="gallery.php">Galeria</a>
                                    </li>
                                </ul>
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item ">
                                        <a class="nav-link" href="editor.php">Editor<span class="sr-only">(current)</span></a>
                                    </li>
                                </ul>
                    </div>
                </nav> ';
    }

    function header($nazov)
    {
        echo ' <html lang = "en">
                <head >
                <meta charset = "UTF-8">
                <title>'.$nazov.'</title>

                <link rel = "stylesheet" href = "https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
                        integrity = "sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin = "anonymous" >

                <script src = "https://code.jquery.com/jquery-3.5.1.slim.min.js"
                        integrity = "sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                        crossorigin = "anonymous" ></script >
                <script src = "https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
                        integrity = "sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
                        crossorigin = "anonymous" ></script >

                <link rel = "stylesheet" href = "styl.css" >

                </head> ';
    }

    function footer()
    {
        echo ' <footer>
                    Patrik Mydlar
               </footer> ';
    }
}