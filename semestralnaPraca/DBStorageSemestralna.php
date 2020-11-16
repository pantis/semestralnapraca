<?php

class DBStorageSemestralna
{
    private $user = "root";
    private $pass = "dtb456";
    private $db = "lolclanky";
    private $host = "localhost";
    private $pdo;
    /**
     * DBStorageSemestralna constructor.
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
        $stmt = $this->pdo->query("select * from articles");
        $result = [];
        while ($row = $stmt->fetch()) {
            $article = new ArticleLOL($row["title"], $row["text"], $row["text2"], $row["thumbnail"]);
            $result[] = $article;
        }
        return $result;
    }

    public function createArticle($title, $text, $text2, $thumbnail) {
        $article = new ArticleLOL($title, $text, $text2, $thumbnail);
        $this->Save($article);
    }

    public function Save(ArticleLOL $article)
    {
       $stmt = $this->pdo->prepare("insert into articles (title, text, text2, thumbnail) VALUES (?, ?, ?, ?)");
       $stmt->execute([$article->getNazov(), $article->getText(), $article->getText2(), $article->getThumbnail()]);
    }
}