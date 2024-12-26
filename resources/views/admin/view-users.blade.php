@include('admin.header')

<div class="container p-4">
    <h1>All Users</h1>
    <div class="notifications"></div>
    <table id="usertable" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name/User Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th>Actions</th> <!-- New Actions Column -->
            </tr>
        </thead>
        
        <tbody></tbody>
    </table>
</div>
<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="editUserId">
                    <div class="mb-3">
                        <label for="editUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="editUsername" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editUserEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUserRole" class="form-label">Role</label>
                        <select id="editUserRole" class="form-control">
                            <option value="1">Admin</option>
                            <option value="2">Manager</option>
                            <option value="3">Adviser</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this user?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteUser">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var table = $('#usertable').DataTable({
        "order": []
    });

    viewuser();
    function viewuser() {
    $.ajax({
        type: "GET",
        url: "/view-userajax",
        dataType: "json",
        success: function(response) {
            table.clear();
            $.each(response.users, function(keys, items) {
                var roleDropdown = `
                    <select class="form-control role-dropdown" data-id="${items.id}">
                        <option value="1" ${items.userrole == 1 ? 'selected' : ''}>Admin</option>
                        <option value="2" ${items.userrole == 2 ? 'selected' : ''}>Manager</option>
                        <option value="3" ${items.userrole == 3 ? 'selected' : ''}>Adviser</option>
                    </select>
                `;

                var featurestatus = '';
                    switch (items.userrole) {
                        case 1:
                            featurestatus = '<span class="status-role" data-id="' + items.id + '">Admin</span>';
                            break;
                        case 2:
                            featurestatus = '<span class="status-role" data-id="' + items.id + '">Manager</span>';
                            break;
                        case 3:
                            featurestatus = '<span class="status-role" data-id="' + items.id + '">Adviser</span>';
                            break;
                        default:
                            featurestatus = '<span class="status-role" data-id="' + items.id + '">Unknown</span>';
                            break;
                    }


                var actionButtons = `
                    <button class="btn btn-warning btn-sm edit-user" data-id="${items.id}" 
                            data-username="${items.username}" 
                            data-useremail="${items.useremail}" 
                            data-role="${items.userrole}">
                        Edit
                    </button>
                    <button class="btn btn-danger btn-sm delete-user" data-id="${items.id}">
                        Delete
                    </button>
                `;

                table.row.add([
                    items.id,
                    items.username,
                    items.useremail,
                    roleDropdown,
                    featurestatus,
                    actionButtons 
                ]);
            });
            table.draw();
        }
    });
}


$('#usertable').on('click', '.edit-user', function() {
    var userId = $(this).data('id');
    var username = $(this).data('username');
    var useremail = $(this).data('useremail');
    var userrole = $(this).data('role');

    $('#editUserId').val(userId);
    $('#editUsername').val(username);
    $('#editUserEmail').val(useremail);
    $('#editUserRole').val(userrole);

    $('#editUserModal').modal('show');
});



$('#usertable').on('change', '.role-dropdown', function() {
    var userId = $(this).data('id');
    var newRole = $(this).val(); 

    $.ajax({
        type: "POST",
        url: "/update-user-role",
        data: {
            id: userId,
            userrole: newRole,
            _token: $('meta[name="csrf-token"]').attr('content') 
        },
        success: function(response) {
            viewuser();
            if (response.status === 200) {
                $('.notifications').html(response.message); 
            } else {
                alert('Failed to update user role');
            }
        },
        error: function() {
            alert('An error occurred while updating the role');
        }
    });
});



$('#editUserForm').on('submit', function(e) {
    e.preventDefault();
    var userId = $('#editUserId').val();
    var username = $('#editUsername').val();
    var useremail = $('#editUserEmail').val();
    var userrole = $('#editUserRole').val();

    $.ajax({
        type: "POST",
        url: "/edit-user",
        data: {
            id: userId,
            username: username,
            useremail: useremail,
            userrole: userrole,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.status === 200) {
                $('#editUserModal').modal('hide');
                viewuser();
                $('.notifications').html(response.message);
            } else {
                alert('Failed to update user');
            }
        }
    });
});

// Delete User Button Click
$('#usertable').on('click', '.delete-user', function() {
    var userId = $(this).data('id');
    $('#confirmDeleteUser').data('id', userId);
    $('#deleteUserModal').modal('show');
});

// Confirm Delete User
$('#confirmDeleteUser').on('click', function() {
    var userId = $(this).data('id');

    $.ajax({
        type: "POST",
        url: "/delete-user",
        data: {
            id: userId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.status === 200) {
                $('#deleteUserModal').modal('hide');
                viewuser();
                $('.notifications').html(response.message);
            } else {
                alert('Failed to delete user');
            }
        }
    });
});

});

</script>
@include('admin.footer')