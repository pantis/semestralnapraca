<?php


class ArticleLOL
{
    private $id;
    private $title;
    private $text;
    private $text2;
    private $thumbnail;

    /**
     * article constructor.
     * @param $nazov
     * @param $text
     * @param $text2
     * @param $thumbnail
     */
    public function __construct($nazov, $text, $text2, $thumbnail)
    {
        $this->title = $nazov;
        $this->text = $text;
        $this->text2 = $text2;
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getNazov()
    {
        return $this->title;
    }

    /**
     * @param mixed $nazov
     */
    public function setNazov($nazov)
    {
        $this->title = $nazov;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return mixed
     */
    public function getText2()
    {
        return $this->text2;
    }

    /**
     * @param mixed $text2
     */
    public function setText2($text2)
    {
        $this->text2 = $text2;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->$thumbnail = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}