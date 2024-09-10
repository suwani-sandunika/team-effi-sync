function login() {

    var email = document.getElementById("email");
    var password = document.getElementById("password");


    var form = new FormData();

    form.append("email", email.value);
    form.append("password", password.value);

    var request = new XMLHttpRequest();
    request.open("POST", "process/login-process.php", true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var response = request.responseText;

            if (response === "success") {
                window.location = "index.php ";
            } else {
                showToast(response, "Error");
            }

        }


    }
    request.send(form);

}

function register() {

    var displayName = document.getElementById("displayName");
    var name = document.getElementById("username");
    var email = document.getElementById("email");
    var password = document.getElementById("password");

    var form = new FormData();
    form.append("displayName", displayName.value);
    form.append("username", name.value);
    form.append("email", email.value);
    form.append("password", password.value);

    var request = new XMLHttpRequest();
    request.open("POST", "process/register-process.php", true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var data = request.responseText;
            if (data === "success") {
                showToast("User registered successfully", "Success");
                setTimeout(() => {
                    window.location = "index.php";
                }, 2000);
            } else {
                showToast(data, "Error");
            }
        }
    }
    request.send(form);
}

function showToast(message, type) {
    document.getElementById("toast-type").innerHTML = type;
    document.getElementById("toast-body").innerHTML = message;

    const toast = document.getElementById('my-toast')
    if (toast) {
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast)
        toastBootstrap.show()
    }
}

function loadProjects(username, page, search) {
    var request = new XMLHttpRequest();
    request.open("GET", "process/load-projects-process.php?username=" + username + "&page=" + page + "&search=" + search, true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            document.getElementById("content").innerHTML = request.responseText;
        }
    }
    request.send();
}

function searchProducts(username) {
    var search = document.getElementById("project-search-input");
    loadProjects(username, 1, search.value);
}

function showEditProjectModal(projectId) {
    const modal = new bootstrap.Modal(document.getElementById("edit-project-modal"));

    var request = new XMLHttpRequest();
    request.open("GET", "process/get-project-by-id.php?id=" + projectId, true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var json = JSON.parse(request.responseText);
            if (json.message === "success") {
                var project = json.project;
                document.getElementById("ep-project-id").value = project.id;
                document.getElementById("ep-project-name").value = project.name;
                document.getElementById("ep-project-created-at").value = project.created_at;
                modal.show();
            } else {
                showToast(json.message, "Error");
            }
        }
    }
    request.send();
}

function updateProject() {
    var id = document.getElementById("ep-project-id");
    var name = document.getElementById("ep-project-name");

    var form = new FormData();
    form.append("id", id.value);
    form.append("name", name.value);

    var request = new XMLHttpRequest();
    request.open("POST", "process/update-project-process.php", true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var resp = request.responseText

            if (resp === "" || resp === "success") {
                window.location.reload();
            } else {
                showToast(resp, "Error");
            }
        }
    }
    request.send(form);
}

function addProject() {
    var name = document.getElementById("ap-project-name");

    var form = new FormData();
    form.append("name", name.value);

    var request = new XMLHttpRequest();
    request.open("POST", "process/add-new-project-process.php", true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            var resp = request.responseText;
            if (resp === "success") {
                window.location.reload();
            } else {
                showToast(resp, "Error")
            }
        }
    }
    request.send(form);
}

function loadTeamMembers(projectId, search, page) {
    var request = new XMLHttpRequest();
    request.open("GET", "process/load-team-members.php?projectId=" + projectId + "&search=" + search + "&page=" + page, true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            document.getElementById("team-members-table-content").innerHTML = request.responseText;
        }
    }
    request.send();
}

var assignMemberModal;

function showAssignTeamMembersModal(projectId, projectName) {
    document.getElementById("atm-project-id").value = projectId;
    document.getElementById("atm-project-name").value = projectName;
    loadTeamMembers(projectId, '', 1);

    assignMemberModal = new bootstrap.Modal(document.getElementById("assign-members-modal"));
    assignMemberModal.show();
}


function searchTeamMembers() {
    var projectId = document.getElementById("atm-project-id").value;
    var search = document.getElementById("atm-search-input").value;

    loadTeamMembers(projectId, search, 1)
}

var assignNewUserModal;

function showAssignNewMemberModal(search, page) {
    var projectId = document.getElementById("atm-project-id").value;
    assignNewUserModal = new bootstrap.Modal(document.getElementById("assign-new-user-modal"));

    const request = new XMLHttpRequest();
    request.open("GET", "process/load-add-new-users-process.php?projectId=" + projectId + "&search=" + search + "&page=" + page, true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            document.getElementById("assign-new-user-table-content").innerHTML = request.responseText;
        }
    }
    request.send();

    assignMemberModal.hide();
    assignNewUserModal.show();
}

function searchAssignNewUsers() {
    console.log("called");
    var search = document.getElementById("assign-new-user-modal-input").value;
    var projectId = document.getElementById("atm-project-id").value;

    const request = new XMLHttpRequest();
    request.open("GET", "process/load-add-new-users-process.php?projectId=" + projectId + "&search=" + search + "&page=" + 1, true);
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            document.getElementById("assign-new-user-table-content").innerHTML = request.responseText;
        }
    }
    request.send();
}

function assignUserToProject(projectId, userId) {
    var form = new FormData();
    form.append("projectId", projectId);
    form.append("userId", userId);

    var request = new XMLHttpRequest();
    request.open("POST", "process/assign-new-user-process.php", true);
    request.onreadystatechange = function () {
        if(request.readyState === 4 && request.status === 200) {
            if(request.responseText === "success") {
                assignNewUserModal.hide();
                loadTeamMembers(projectId, '', 1);
                assignMemberModal.show();
            }else {
                showToast(request.responseText, "Error");
            }
        }
    }
    request.send(form);
}

function removeUserFromProject(userId, projectId) {
    let c = confirm("Are you sure to remove the selected user from project?");

    if(c) {
        var form = new FormData();
        form.append("userId", userId);
        form.append("projectId", projectId);

        var request = new XMLHttpRequest();
        request.open("POST", "process/remove-user-from-project-process.php", true);
        request.onreadystatechange = function () {
            if(request.readyState === 4 && request.status === 200) {
                var resp = request.responseText;
                if(resp === "success") {
                    loadTeamMembers(projectId, "", 1);
                }else {
                    showToast(resp, "Error");
                }
            }
        }
        request.send(form);
    }
}