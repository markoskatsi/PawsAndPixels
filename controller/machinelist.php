<?php
session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['userId'])) {
    require_once "../controller/login.php";
    exit();
}

require_once "../model/dataAccess.php";
require_once "../model/machine.php";

$userId = $_SESSION['userId'];

if (!isset($_REQUEST["search"])) {
    $results = getAllMachines();
} else {
    $search = $_REQUEST["search"];
    $results = getMachinesByTitle($search);
    $_GET['search'] = '';
}

$timeSlots = [
    '09:00 - 11:00',
    '11:00 - 13:00',
    '13:00 - 15:00',
    '15:00 - 17:00',
];  // slot times for while paws and pixels is  open

require_once "../view/machinelist_view.php";
?>