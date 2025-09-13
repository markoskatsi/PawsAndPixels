<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username']) && !isset($_SESSION['userId'])) {
    require_once "../controller/login.php";
    exit();
  }

require_once "../model/game.php";
require_once "../model/dataAccess.php";

$username = $_SESSION['username'];

$user = getAuthorisedUsers($username);

if (!isset($_REQUEST["search"])) 
{
    $results = getAllGames();
}
else
{
    $search = $_REQUEST["search"];
    $results = getGamesByTitle($search);

    if (empty($results)) 
    {
        $search = $_REQUEST["search"];
        $results = getGamesByGenre($search);
    }
}

require_once "../view/gamelist_view.php";
?>