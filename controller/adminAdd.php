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

  $machineStatus = false;
  $gameStatus = false;

  $machines = getAllMachines();

  if(isset($_REQUEST["machineName"])) {
    $machineName = $_REQUEST["machineName"];
    $company = $_REQUEST["company"];
    $yearOfRelease = $_REQUEST["yearOfRelease"];
    $ramSize = $_REQUEST["ramSize"];
    $bitSize = $_REQUEST["bitSize"];

    $machine = new Machine();
    $machine->machineName = htmlentities($machineName);
    $machine->company = htmlentities($company);
    $machine->yearOfRelease = htmlentities($yearOfRelease);
    $machine->ramSize = htmlentities($ramSize);
    $machine->bitSize = htmlentities($bitSize);

    addMachine($machine);
    $machineStatus = "$machineName has been added.";
  }

  if(isset($_REQUEST["title"])) {
    $title = $_REQUEST["title"];
    $publisher = $_REQUEST["publisher"];
    $genre = $_REQUEST["genre"];
    $rating = $_REQUEST["rating"];

    $game = new Game();
    $game->title = htmlentities($title);
    $game->publisher = htmlentities($publisher);
    $game->genre = htmlentities($genre);
    $game->rating = htmlentities($rating);

    $gameId = addGame($game);

    if (isset($_REQUEST['machineIds'])) {
      foreach ($_REQUEST['machineIds'] as $machineId) {
          addGameMachine($gameId, $machineId);
      }
    }
    $gameStatus = "$title has been added.";
}

require_once "../view/adminAdd_view.php";

?>