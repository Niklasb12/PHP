<?php
class Valorant extends Games
{
    private $best;
    public function __construct($title, $genre, $best)
    {
        $this->best  = $best;
        parent::__construct($title, $genre);
    }

    public function setBest($best)
    {
        $this->best = $best;
    }
    public function getBest()
    {
        return $this->best;
    }
}