<?php
class Game {

    private $gameId;
    private $title;
    private $publisher;
    private $genre;
    private $rating;

    function __get($name) {
        return $this->$name;
    }

    function __set($name,$value) {
        $this->$name = $value;
    }

}
?>