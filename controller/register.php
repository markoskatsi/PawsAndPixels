<?php
session_start();

require_once "../model/user.php";
require_once "../model/dataAccess.php";

$userStatus = "";
$error_message = "";

if(isset($_REQUEST["username"]))
{
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $email = $_REQUEST["email"];

    $existingUsernames = getUsername($username);
    if (!empty($existingUsernames)) {
        $error_message = "Username already exists. Please choose another.";
    } 
    else {
        $existingEmails = getEmail($email);
        if (!empty($existingEmails)) {
            $error_message = "Email already registered. Please use another email.";
        }
        else {
            $user = new User();
            $user->username = htmlentities($username);
            $user->password = htmlentities($password);
            $user->email = htmlentities($email);

            addUser($user);
            $userStatus = "Account for " . $username . " created!";
        }
    }
}

require_once "../view/register_view.php";
?>