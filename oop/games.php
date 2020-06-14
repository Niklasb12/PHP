<?php 

class Games
{
    private $title;
    private $genre;
    public function __construct($title, $genre)
    {
        $this->title = $title;
        $this->genre    = $genre;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle()
    {
        $this->title = $title;
    }
    public function getGenre()
    {
        return $this->genre;
    }
    public function setGenre()
    {
        $this->genre = $genre;
    }

}

?>