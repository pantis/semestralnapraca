<?php


class ArticleLOL
{
    private $id;
    private $title;
    private $text;
    private $thumbnail;

    /**
     * article constructor.
     * @param $title
     * @param $text
     * @param $thumbnail
     */
    public function __construct($title, $text,  $thumbnail)
    {
        $this->title = $title;
        $this->text = $text;
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $nazov
     */
    public function setTitle($title)
    {
        $this->title = $title;
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