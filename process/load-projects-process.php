<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Project Name</th>
        <th scope="col">Owner</th>
        <th scope="col">Created At</th>
        <th scope="col">No of Members</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>

    <?php

    require "../MySQL.php";

    $username = $_GET["username"];
    $search = $_GET["search"];

    $pageNo = 1;
    if (isset($_GET["page"])) {
        $pageNo = $_GET["page"];
    }

    $userRs = MySQL::search("SELECT * FROM user WHERE username = '$username'");
    $user = $userRs->fetch_assoc();


    $query = "SELECT * FROM project WHERE id IN (SELECT DISTINCT project.id FROM project LEFT JOIN user_has_project ON project.id = user_has_project.project_id WHERE user_has_project.user_id ='" . $user["id"] . "' OR project.owner_id = '" . $user["id"] . "') ";
    if (!empty($search)) {
        $query .= "AND `name` LIKE '%" . $search . "%'";
    }

    $projectRs = MySQL::search($query);

    $results_per_page = 10;
    $number_of_pages = ceil($projectRs->num_rows / $results_per_page);
    $viewed_result_count = ((int)$pageNo - 1) * $results_per_page;

    $projectRs = MySQL::search($query . " LIMIT " . $results_per_page . " OFFSET " . $viewed_result_count);

    while ($project = $projectRs->fetch_assoc()) {
        ?>
        <tr>
            <th scope="row"><?= $project["id"] ?></th>
            <td><a href="project.php?id=<?= $project['id'] ?>"><?= $project["name"] ?></a></td>
            <?php
            $ownerRs = MySQL::search("SELECT * FROM user WHERE id = '" . $project['owner_id'] . "'");
            $owner = $ownerRs->fetch_assoc();
            ?>
            <td><?= $user['id'] == $project['owner_id'] ? 'You' : $owner['displayName'] ?></td>
            <td><?= $project["created_at"] ?></td>
            <td>
                <?php
                $countRs = MySQL::search("SELECT COUNT(uhp.project_id) AS count FROM project JOIN user_has_project uhp on project.id = uhp.project_id WHERE project_id = '" . $project['id'] . "'");
                echo($countRs->fetch_assoc()["count"]);
                ?>
            </td>
            <td>
                <button class="btn btn-primary btn-sm <?= $user['id'] == $project['owner_id'] ? '' : 'disabled' ?>" onclick="showEditProjectModal('<?= $project['id'] ?>')" <?= $user['id'] == $project['owner_id'] ? '' : 'disabled' ?>><i
                            class="bi bi-pencil-square"></i></button>
                <button class="btn btn-danger btn-sm <?= $user['id'] == $project['owner_id'] ? '' : 'disabled' ?>" <?= $user['id'] == $project['owner_id'] ? '' : 'disabled' ?>><i class="bi bi-trash-fill"></i></button>
                <button class="btn btn-warning btn-sm <?= $user['id'] == $project['owner_id'] ? '' : 'disabled' ?>"
                        onclick="showAssignTeamMembersModal('<?= $project['id'] ?>', '<?= $project['name'] ?>');" <?= $user['id'] == $project['owner_id'] ? '' : 'disabled' ?>>
                    <i class="bi bi-person-fill-add"></i>
                </button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>

<nav class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item  <?= (($pageNo - 1) <= 0) ? 'disabled' : '' ?>">
            <a class="page-link"
               href="javascript:loadProjects('<?= $username ?>', '<?= $pageNo - 1 ?>', '<?= $search ?>');">Previous</a>
        </li>
        <?php
        for ($page = 1; $page <= $number_of_pages; $page++) {
            if ($page == $pageNo) {
                ?>
                <li class="page-item active" aria-current="page">
                    <a class="page-link"
                       href="javascript:loadProjects('<?= $username ?>', '<?= $page ?>', '<?= $search ?>')"><?= $page ?></a>
                </li>
                <?php
            } else {
                ?>
                <li class="page-item" aria-current="page">
                    <a class="page-link"
                       href="javascript:loadProjects('<?= $username ?>', '<?= $page ?>',  '<?= $search ?>')"><?= $page ?></a>
                </li>
                <?php
            }
        }

        ?>
        <li class="page-item <?= ($pageNo >= $number_of_pages) ? 'disabled' : '' ?>">
            <a class="page-link"
               href="javascript:loadProjects('<?= $username ?>', '<?= $pageNo + 1 ?>',  '<?= $search ?>');">Next</a>
        </li>
    </ul>
</nav>

