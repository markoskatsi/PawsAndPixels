<?php
  session_start();

  if (!isset($_SESSION['username']) && !isset($_SESSION['userId'])) {
    require_once "../controller/login.php";
    exit();
  }

  require_once "../model/machine.php";
  require_once "../model/game.php";
  require_once "../model/dataAccess.php";

  $username = $_SESSION['username'];
  $userId = $_SESSION['userId'];

  require_once "../view/adminOptions_view.php";

?>