<?php

header('Content-Type: application/json');
require_once "../model/game.php";
require_once "../model/dataAccess.php";

if (isset($_GET["query"])) {
    $query = $_GET["query"];
    $games = getGamesByTitleAndGenre($query);  


    $results = [];
    foreach ($games as $game) {
        $results[] = ['title' => $game->title, 'genre' => $game->genre];
    }
    
    echo json_encode($results); 
} else {
    echo json_encode([]); 
}
?>

