<?php
require "MySQL.php";
session_start();
$_SESSION["active_tab"] = "projects";

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
}

$username = $_SESSION["username"];

?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Projects | Team Effi Sync</title>

    <link rel="icon" href="assets/img/logo-white-bg.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body onload="loadProjects('<?= $username ?>', 1, '')">
<!--onload="loadProjects('<?= $username ?>', 1, '')"-->

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
                    <li class="breadcrumb-item active" aria-current="page">
                        Projects
                    </li>
                </ol>
            </nav>

            <div class="row d-flex justify-content-end my-3">
                <div class="col-9">
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#add-project-modal"><i
                                class="bi bi-plus-circle-dotted"></i>&nbsp;&nbsp;Add Project
                    </button>
                </div>
                <div class="col-3">
                    <input id="project-search-input" type="text" class="form-control" placeholder="search..."
                           onkeyup="searchProducts('<?= $username ?>')">
                </div>
            </div>
            <div class="bg-body-tertiary rounded-3 pb-2 " id="content">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Project Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">No of Members</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="5" class="text-center">
                            <div class="spinner-border my-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

<?php require "footer.php" ?>
<?php require "toast.php" ?>

<!--Edit Project Modal START-->
<div class="modal fade modal-lg" id="edit-project-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-2">
                        <label for="" class="form-label">Project ID</label>
                        <input type="text" class="form-control disabled" id="ep-project-id" disabled>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="ep-project-name">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Created At</label>
                        <input type="text" class="form-control disabled" id="ep-project-created-at" disabled>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateProject()">Update Project</button>
            </div>
        </div>
    </div>
</div>
<!--Edit Project Modal END-->


<!--Add Project Modal Start-->
<div class="modal fade" id="add-project-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="mb-2">
                        <label for="" class="form-label">Project Name</label>
                        <input type="text" class="form-control" id="ap-project-name">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addProject()">Add Project</button>
            </div>
        </div>
    </div>
</div>
<!--Add Project Modal END-->

<!-- Assign Members Modal Start -->
<div class="modal fade modal-lg" id="assign-members-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign or Remove Members From the Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2 row">
                    <div class="mb-2 col-6">
                        <label for="" class="form-label">Project ID</label>
                        <input type="text" class="form-control disabled" id="atm-project-id" disabled>
                    </div>
                    <div class="mb-2 col-6">
                        <label for="" class="form-label">Project Name</label>
                        <input type="text" class="form-control disabled" id="atm-project-name" disabled>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="row mb-2">
                        <div class="col-9">
                            <span class="fs-4">Team Members</span>
                        </div>
                        <div class="col-3 text-end">
                                <button class="btn btn-success btn-sm" onclick="showAssignNewMemberModal('', 1)">Assign New Member</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input id="atm-search-input" type="text" class="form-control" placeholder="search..."
                               onkeyup="searchTeamMembers()">
                    </div>

                    <div id="team-members-table-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Display Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="spinner-border my-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="loadProjects('<?= $username ?>', 1, '')">Close</button>
                <!--                <button type="button" class="btn btn-primary" onclick="addProject()">Add Project</button>-->
            </div>
        </div>
    </div>
</div>
<!-- Assign Members Modal End -->

<!-- New User Modal Start -->
<div class="modal fade modal-lg" id="assign-new-user-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign New Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <div class="row mb-2">
                        <div class="col-8">
                            <span class="fs-4">Team Members</span>
                        </div>
                        <div class="col-4">
                            <input id="assign-new-user-modal-input" type="text" class="form-control" placeholder="search..." onkeyup="searchAssignNewUsers()">
                        </div>
                    </div>

                    <div id="assign-new-user-table-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Display Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="spinner-border my-3" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- New User Modal Start -->

<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>