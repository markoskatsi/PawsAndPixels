<?php

class User {

    private $userId;
    private $username;
    private $password;
    private $email;

    function __get($name) {
        return $this->$name;
    }

    function __set($name,$value) {
        $this->$name = $value;
    }
}

?>