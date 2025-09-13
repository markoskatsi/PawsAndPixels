<?php

class Machine {

    private $machineId;

    private $machineName;
    private $company;
    private $yearOfRelease;
    private $ramSize;
    private $bitSize;

    function __get($name) {
        return $this->$name;
    }

    function __set($name,$value) {
        $this->$name = $value;
    }

}

?>