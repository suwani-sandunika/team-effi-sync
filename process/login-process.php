<?php
require "../MySQL.php" ;

$email = $_POST["email"];
$password = $_POST["password"];


if (empty($email)){
    echo ("please Enter Your Email");
}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo ("Invalid Email Address");
}else if(empty($password)){
    echo ("Please Enter the Password");

}else {
    $rs = MySQL::search("SELECT * FROM `user` WHERE( `email`='$email' OR `username` = '$email') AND `password`='$password'");

    if ($rs->num_rows == 1) {

        $user = $rs->fetch_assoc();


        session_start();
        $_SESSION["displayName"] = $user["displayName"];
        $_SESSION["username"]  = $user["username"] ;
        echo ("success");
    }else {
        echo ("Invalid Email Or Password");

  }


}