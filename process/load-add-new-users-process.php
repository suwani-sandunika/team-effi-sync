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

    <?php

    require "../MySQL.php";

    $projectId = $_GET["projectId"];
    $search = $_GET["search"];

    $pageNo = 1;
    if (isset($_GET["page"])) {
        $pageNo = $_GET["page"];
    }

    $query = "SELECT * FROM `user` WHERE id NOT IN (SELECT DISTINCT uhp.user_id FROM user_has_project uhp WHERE uhp.project_id = '$projectId') AND id <> (SELECT owner_id from project WHERE id = '$projectId')";
    if (!empty($search)) {
        $query .= "AND (username LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' OR displayName LIKE '%" . $search . "%')";
    }

    $teamMembersRs = MySQL::search($query);

    $results_per_page = 5;
    $number_of_pages = ceil($teamMembersRs->num_rows / $results_per_page);
    $viewed_result_count = ((int)$pageNo - 1) * $results_per_page;

    $teamMembersRs = MySQL::search($query . " LIMIT " . $results_per_page . " OFFSET " . $viewed_result_count);

    while ($member = $teamMembersRs->fetch_assoc()) {
        ?>
        <tr>
            <th scope="row"><?= $member["id"] ?></th>
            <td><?= $member["displayName"] ?></td>
            <td><?= $member["username"] ?></td>
            <td><?= $member["email"] ?></td>
            <td>
                <button class="btn btn-success btn-sm" onclick="assignUserToProject('<?= $projectId ?>', '<?= $member['id'] ?>')">Assign</button>
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
            <a class="page-link" href="javascript:loadTeamMembers('<?= $projectId?>', '<?= $search ?>', '<?= $pageNo - 1 ?>')">Previous</a>
        </li>
        <?php
        for ($page = 1; $page <= $number_of_pages; $page++) {
            if ($page == $pageNo) {
                ?>
                <li class="page-item active" aria-current="page">
                    <a class="page-link"
                       href="javascript:loadTeamMembers('<?= $projectId?>', '<?= $search ?>', '<?= $page ?>')"><?= $page ?></a>
                </li>
                <?php
            } else {
                ?>
                <li class="page-item" aria-current="page">
                    <a class="page-link"
                       href="javascript:loadTeamMembers('<?= $projectId?>', '<?= $search ?>', '<?= $page ?>')"><?= $page ?></a>
                </li>
                <?php
            }
        }

        ?>
        <li class="page-item <?= ($pageNo >= $number_of_pages) ? 'disabled' : '' ?>">
            <a class="page-link"
               href="javascript:loadTeamMembers('<?= $projectId ?>', '<?= $search ?>', '<?= $pageNo + 1 ?>')">Next</a>
        </li>
    </ul>
</nav>

