<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['userId'])) {
    require_once "../controller/login.php";
    exit();
}

require_once "../model/machine.php";
require_once "../model/booking.php";
require_once "../model/dataAccess.php";

$userId = $_SESSION["userId"];

if (isset($_GET["addToBasket"])) {
    $machine = getMachineById($_GET["addToBasket"]);
    if ($machine && !empty($_GET["slot"]) && !empty($_GET["date"])) {
        $dateSelected = $_GET["date"];
        $slotSelected = $_GET["slot"];

        foreach ($slotSelected as $slot) {
            [$startTime, $endTime] = explode(" - ", $slot);
            $_SESSION["basket"][] = [
                "machineId" => $machine->machineId,
                "machineName" => $machine->machineName,
                "slotStartTime" => $dateSelected . " " . $startTime,
                "slotEndTime" => $dateSelected . " " . $endTime,
            ];
        }
    }
}

if (isset($_GET["remove"])) {
    foreach ($_SESSION["basket"] as $key => $item) {
        if ($item["machineId"] == $_GET["remove"]) {
            unset($_SESSION["basket"][$key]);
            break;
        }
    }
}

if (!isset($_SESSION["basket"])) {
    $_SESSION["basket"] = [];
}

$basket = $_SESSION["basket"];

require_once "../view/basket_view.php";
?>
