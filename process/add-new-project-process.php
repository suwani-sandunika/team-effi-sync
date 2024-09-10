<?php

require "../MySQL.php";
session_start();

$name = $_POST["name"];

if (!isset($_SESSION["username"])) {
    echo("You must login first");
} else if (empty($name)) {
    echo("Please enter the project name");
} else {
    $username = $_SESSION["username"];
    $rs = MySQL::search("SELECT * FROM project WHERE name = '$name'");

    if ($rs->num_rows > 0) {
        echo("Project with the provided name already exists");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        $user = MySQL::search("SELECT * FROM user WHERE username = '$username'");
        if ($user->num_rows == 1) {
            $userRow = $user->fetch_assoc();
            $userId = $userRow["id"];

            MySQL::iud("INSERT INTO project(name, created_at, owner_id) VALUES ('$name', '$date', '$userId')");
            echo("success");
        } else {
            echo("User couldn't be found");
        }
    }

}