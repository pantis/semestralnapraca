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
    function loadAll()
    {
        $stmt = $this->pdo->query("select * from articles");
        $result = [];
        while ($row = $stmt->fetch()) {
            $article = new ArticleLOL($row["title"], $row["text"], $row["text2"], $row["thumbnail"]);
            $result[] = $article;
        }
        return $result;
    }


    function Save(ArticleLOL $article)
    {
        // TODO: Implement Save() method.
    }
}