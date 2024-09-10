<?php

require "../MySQL.php";

$projectId = $_POST["projectId"];
$userId = $_POST["userId"];

if (empty($projectId)) {
    echo("Project ID is required");
} else if (empty($userId)) {
    echo("User ID is required");
} else {
    MySQL::iud("INSERT INTO user_has_project(user_id, project_id) VALUE ('$userId','$projectId')");
    echo("success");
}