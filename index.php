<?php
session_start();
$_SESSION["active_tab"] = "index";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TeamEffiSync</title>
    <link rel="icon" href="assets/img/logo-white-bg.png">
    <link rel="icon" href="assets/img/logo-white-bg.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php require "header.php" ?>

<div class="container">
    <div class="row">
        <?php require "sidebar.php"; ?>

        <div class="col px-4 pt-2">
            <h1>Hello</h1>
        </div>
    </div>
</div>

<?php require "footer.php" ?>

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>