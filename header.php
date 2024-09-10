<?php

session_start();

$displayName = "";
if (isset($_SESSION["displayName"])) {
    $displayName = $_SESSION["displayName"];
}
?>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="index.php"
               class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none gap-2">
                <img src="assets/img/logo-dark-bg.png" alt="" style="clip-path: circle(); height: 50px">
                <span class="fw-bold fs-5">TEAM EFFI SYNC</span>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 ms-3 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 link-secondary">Home</a></li>
                <li><a href="#" class="nav-link px-2 link-body-emphasis">Projects</a></li>
            </ul>


            <?php

            if ($displayName == "") {
                ?>
                <div>
                    <a href="login.php" class="btn btn-warning me-2">Login</a>
                    <a href="register.php" type="button" class="btn btn-outline-secondary me-2">Register</a>
                </div>
                <?php
            } else {
                ?>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                        <span class="ms-2">Hello, <?= $displayName ?></span>
                    </a>
                    <ul class="dropdown-menu text-small">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="process/logout-process.php">Sign out</a></li>
                    </ul>
                </div>
            <?php
            }

            ?>
        </div>
    </div>
</header>