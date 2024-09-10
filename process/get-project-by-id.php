<?php

require "../MySQL.php";

$id = $_GET["id"];

$obj = new stdClass();

if(empty($id)) {
   $obj->message = "Id is required";
}else {

    $rs = MySQL::search("SELECT * FROM `project` WHERE id = '$id'");

    if($rs->num_rows > 0) {
        $obj->message = "success";
        $obj->project = $rs->fetch_assoc();
    }else {
        $obj->message = "Project not found";
    }
}

echo(json_encode($obj));