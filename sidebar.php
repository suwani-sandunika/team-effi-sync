<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary rounded-2" style="width: 280px;">
    <a href="/"
       class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <i class="bi bi-speedometer2 fs-4"></i>
        <span class="fs-4 ms-2">Dashboard</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php" class='nav-link <?= $_SESSION["active_tab"] == "index" ? "active" : "" ?>' aria-current="page">
                Home
            </a>
        </li>
        <li>
            <a href="projects.php" class="nav-link link-body-emphasis <?= $_SESSION["active_tab"] == "projects" ? "active" : "" ?>">
                Projects
            </a>
        </li>
    </ul>
</div>