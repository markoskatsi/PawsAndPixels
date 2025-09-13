<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['userId'])) {
    require_once "../controller/login.php";
    exit();
}

require_once "../model/dataAccess.php";
require_once "../model/bookingMachine.php";
require_once "../model/machine.php";
require_once "../model/booking.php";

$username = $_SESSION["username"];

$results = getUserBookings($_SESSION['userId']);

require_once "../view/bookinglist_view.php";
?>