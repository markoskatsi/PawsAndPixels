<?php
session_start();
require_once "../model/dataAccess.php";
require_once "../model/booking.php";
require_once "../model/bookingMachine.php";

$bookingStatus = '';
$allSlotsAvailable = true;

foreach ($_GET['machineIds'] as $index => $machineId) {
    $startTime = $_GET['slotStartTimes'][$index];
    $endTime = $_GET['slotEndTimes'][$index];
    
    if (!isSlotAvailable($machineId, $startTime, $endTime)) {
        $allSlotsAvailable = false;
        $machine = getMachineById($machineId);
        if ($bookingStatus) {
            $bookingStatus .= "<br>";
        } else {
            $bookingStatus = "Machine(s) unavailable:<br>";
        }        
        $bookingStatus .= $machine->machineName . " (" . 
                         date('H:i', strtotime($startTime)) . " - " . 
                         date('H:i', strtotime($endTime)) . ") <br>";
    }
}

if ($allSlotsAvailable) {
    $booking = new Booking();
    $booking->userId = $_SESSION['userId'];
    $booking->bookingDate = date('Y-m-d'); //the date booking was made
    $bookingId = addBooking($booking);
    
    if ($bookingId) {
        foreach ($_GET['machineIds'] as $index => $machineId) {
            $bookingMachine = new BookingMachine();
            $bookingMachine->bookingId = $bookingId;
            $bookingMachine->machineId = $machineId;
            $bookingMachine->slotStartTime = $_GET['slotStartTimes'][$index];
            $bookingMachine->slotEndTime = $_GET['slotEndTimes'][$index];
            addBookingMachine($bookingMachine);
        }
        
        $bookingStatus = "Booking Complete";
        $_SESSION['basket'] = []; // Clear basket
    } 
}

$_SESSION['bookingStatus'] = $bookingStatus;
require_once "basket.php";
exit();
