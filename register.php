<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | Team Effi Sync</title>

    <link rel="icon" href="assets/img/logo-white-bg.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/sign-in.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php require "header.php" ?>

<main class="form-signin w-100 m-auto">
    <div>
        <div class="text-center">
            <img class="mb-4" src="/assets/img/logo-dark-bg.png" alt="" height="100" style="clip-path: circle()">
        </div>
        <h1 class="h3 mb-3 fw-normal">Please register</h1>

        <div class="form-floating mb-2">
            <input type="text" class="form-control rounded-2" id="displayName" placeholder="John Doe">
            <label for="name">Display Name</label>
        </div>
        <div class="form-floating mb-2">
            <input type="text" class="form-control rounded-2" id="username" placeholder="John Doe">
            <label for="name">Username</label>
        </div>
        <div class="form-floating mb-2">
            <input type="email" class="form-control rounded-2" id="email" placeholder="name@example.com">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating mb-2">
            <input type="password" class="form-control rounded-2" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <button class="btn btn-warning w-100 py-2" type="submit" onclick="register()">Register</button>
        <p class="mt-5 mb-3 text-body-secondary text-center">Team Effi Sync © 2023</p>
    </div>
</main>

<?php require "footer.php" ?>

<?php require "toast.php" ?>

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>