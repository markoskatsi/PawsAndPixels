<?php
session_start();

if (!isset($_SESSION['username'])) {
    require_once "../controller/login.php";
    exit();
}

$username = $_SESSION['username'];

require_once "../model/machine.php";
require_once "../model/game.php";
require_once "../model/dataAccess.php";

$machineStatus = "";
$gameStatus = "";

$games = getAllGames();
$machines = getAllMachines();

if (isset($_GET['machineId'])) {
    $machineId = $_GET['machineId'];
    $machine = getMachineById($machineId);

    if ($machine) {
        if (isset($_GET['machineName'])) {
            $machine->machineName = $_GET['machineName'];
            $machine->company = $_GET['company'];
            $machine->yearOfRelease = $_GET['yearOfRelease'];
            $machine->ramSize = $_GET['ramSize'];
            $machine->bitSize = $_GET['bitSize'];

            updateMachine($machine);

            $machineStatus = "$machine->machineName has been updated.";
        }
    }
}

if (isset($_GET['gameId'])) {
    $gameId = $_GET['gameId'];

    $game = getGameById($gameId);

    if ($game) {
        if (isset($_GET['title'])) {
            $game->title = $_GET['title']; 
            $game->publisher = $_GET['publisher']; 
            $game->genre = $_GET['genre']; 
            $game->rating = $_GET['rating']; 

            updateGame($game);

            if (isset($_GET['machineIds'])) {
                removeAllGameMachine($gameId);
                foreach ($_GET['machineIds'] as $machineId) {
                    addGameMachine($gameId, $machineId);
                }
            }

            $gameStatus = "$game->title has been updated.";
        }
        else {
            $selectedMachineIds = [];
        }
    }
}

require_once "../view/adminModify_view.php"; 
?>




