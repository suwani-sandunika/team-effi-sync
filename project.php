<?php

require "MySQL.php";

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: projects.php");
}

$projectId = $_GET["id"];
$projectRs = MySQL::search("SELECT * FROM project p WHERE p.id = '$projectId'");

if ($projectRs->num_rows != 1) {
    header("Location: projects.php");
}

$project = $projectRs->fetch_assoc();
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project - <?= $project['name'] ?> | Team Effi Sync</title>

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

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-chevron p-3 bg-body-tertiary rounded-3">
                    <li class="breadcrumb-item">
                        <a class="link-body-emphasis text-decoration-none gap-1" href="#">
                            <i class="bi bi-house"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        Projects
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Project - <?= $project['name'] ?>
                    </li>
                </ol>
            </nav>

            <div class="bg-body-tertiary rounded-3 p-3 " id="content">

                <span class="fs-5 fw-bold">Task List</span>

                <div class="my-3">

                    <div class="card bg-body-tertiary" style="width: 100%">
                        <div class="card-body d-flex justify-content-between">
                            <div class="d-flex align-items-center gap-4">
                                <i class="bi bi-check-all fs-1"></i>

                                <div>
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the
                                        bulk of the card's content.</p>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-center">
                                <span class="badge text-bg-primary mb-2" >Primary</span>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

<?php require "footer.php" ?>

<?php require "toast.php" ?>

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>