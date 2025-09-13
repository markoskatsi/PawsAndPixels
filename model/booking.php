<?php
class Booking {
    private $bookingId;
    private $userId;
    private $bookingDate;


    function __get($name) {
        return $this->$name;
    }

    function __set($name,$value) {
        $this->$name = $value;
    }

}

?>