<?php

require "../MySQL.php";

$userId = $_POST["userId"];
$projectId = $_POST["projectId"];

if (empty($userId)) {
    echo("User ID is required");
} else if (empty($projectId)) {
    echo("Project ID is required");
} else {

    $rs = MySQL::search("SELECT * FROM user_has_project WHERE project_id='$projectId' AND user_id='$userId'");

    if ($rs->num_rows == 1) {
        MySQL::iud("DELETE FROM user_has_project WHERE user_id = '$userId' AND project_id='$projectId'");
        echo("success");
    } else {
        echo("Something went wrong");
    }

}
