<?php

require "../MySQL.php";

$id = $_POST["id"];
$name = $_POST["name"];

if (empty($id)) {
    echo("Id is required");
} else if (empty($name)) {
    echo("Project name is required");
} else {

    $projectRs = MySQL::search("SELECT * FROM project WHERE id = '$id'");
    if ($projectRs->num_rows > 0) {
        $project = $projectRs->fetch_assoc();
        if ($project["name"] !== $name) {
            MySQL::iud("UPDATE project SET name ='$name' WHERE id='$id'");
            echo("success");
        }
    } else {
        echo("Project couldn't find");
    }

}
