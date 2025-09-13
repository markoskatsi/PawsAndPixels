<?php
session_start();
require_once "../model/user.php";
require_once "../model/dataAccess.php";

if (isset($_REQUEST['username'])) {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    // Fetching user by username
    $user = getAuthorisedUsers($username);

    // Verifying password
    if ($user && $password === $user["password"]) {
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $user['userId'];
        require_once "gamelist.php";
        exit();
    } else {
        $error_message = "Invalid credentials. Please try again.";
    }
}

require_once "../view/login_view.php";
?>