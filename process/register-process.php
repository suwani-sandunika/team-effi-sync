<?php

require "../MySQL.php";

$displayName = $_POST["displayName"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if (empty($displayName)) {
    echo("Please enter the display name");
} else if (empty($username)) {
    echo("Please enter the username");
} else if (empty($email)) {
    echo("Please enter the email");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo("Please enter a valid email");
} else if (empty($password)) {
    echo("Please enter the password");
} else {

    $rs = MySQL::search("SELECT * FROM `user` WHERE `email` = '$email' OR `username` = '$username'");

    if ($rs->num_rows == 1) {
        echo("User has already registered");
    } else {
        MySQL::iud("INSERT INTO `user`(`displayName`, `username`, `email`, `password`) VALUES ('$displayName', '$username', '$email','$password')");

        session_start();
        $_SESSION["displayName"] = $displayName;
        $_SESSION["username"] = $username;

        echo("success");
    }
}