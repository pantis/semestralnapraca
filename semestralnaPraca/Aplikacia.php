<?php

class Aplikacia
{
    private $user = "root";
    private $pass = "dtb456";
    private $db = "lolclanky";
    private $host = "localhost";
    private $pdo;
    /**
     * Aplikacia constructor.
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

    public function createArticle($title, $text, $thumbnail) {
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
        if (count([$stmt])==1) {
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

    public function loadAllImages()
    {
        $stmt = $this->pdo->query("select * from articles order by id desc");
        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = $row['thumbnail'];
        }
        return $result;
    }

    function breakLongText($text, $length = 200, $maxLength = 250){
        //Text length
        $textLength = strlen($text);

        //initialize empty array to store split text
        $splitText = [];

        //return without breaking if text is already short
        if (!($textLength > $maxLength)){
            $splitText[] = $text;
            return $splitText;
        }

        //Guess sentence completion
        $needle = '.';

        /*iterate over $text length
          as substr_replace deleting it*/
        while (strlen($text) > $length){

            $end = strpos($text, $needle, $length);

            if ($end === false){

                //Returns FALSE if the needle (in this case ".") was not found.
                $splitText[] = substr($text,0);
                $text = '';
                break;

            }

            $end++;
            $splitText[] = substr($text,0,$end);
            $text = substr_replace($text,'',0,$end);

        }

        if ($text){
            $splitText[] = substr($text,0);
        }

        return $splitText;

    }
}