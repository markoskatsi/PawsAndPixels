<?php

class BookingMachine {

    private $bookingMachineId;

    private $bookingId;
    private $machineId;
    private $slotStartTime;
    private $slotEndTime;

    function __get($name) {
        return $this->$name;
    }

    function __set($name,$value) {
        $this->$name = $value;
    }

}

?>