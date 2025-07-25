
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .container { margin-top: 40px; }
        .table th, .table td { vertical-align: middle; }
        .nav-pills .nav-link.active { background: #0d6efd; }
        .section { display: none; }
        .section.active { display: block; }
        .action-btns a, .action-btns button { margin-right: 0.5em; }
    </style>
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Panel</h2>
        <a href="/admin?logout=1" class="btn btn-outline-danger">Logout</a>
    </div>

    <!-- NAVIGATION -->
    <ul class="nav nav-pills mb-4" id="adminNav">
        <li class="nav-item">
            <a class="nav-link active" href="#" data-section="usersSection">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-section="auctionsSection">Auctions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" data-section="bidsSection">Bids</a>
        </li>
    </ul>

    <!-- USERS SECTION -->
    <div class="section active" id="usersSection">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h4>Users</h4>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
        </div>
        <table class="table table-bordered bg-white shadow-sm" id="usersTable" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="action-btns">
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal" data-userid="{{ $user->id }}" data-username="{{ $user->name }}">Change Password</button>
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal" data-userid="{{ $user->id }}" data-username="{{ $user->name }}" data-useremail="{{ $user->email }}">Edit</button>
                        <form method="POST" action="/admin?delete_user={{ $user->id }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            <input type="hidden" name="_action" value="delete_user">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- AUCTIONS SECTION -->
    <div class="section" id="auctionsSection">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h4>Auctions</h4>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAuctionModal">Add Auction</button>
        </div>
        <table class="table table-bordered bg-white shadow-sm" id="auctionsTable" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>ID</th><th>Item</th><th>Creator</th><th>Description</th><th>Starting Bid</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($auctions as $auction)
                <tr>
                    <td>{{ $auction->id }}</td>
                    <td>{{ $auction->item }}</td>
                    <td>{{ $auction->user->name ?? 'N/A' }}</td>
                    <td>{{ $auction->description }}</td>
                    <td>{{ $auction->starting_bid }}</td>
                    <td class="action-btns">
                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#editAuctionModal"
                            data-auctionid="{{ $auction->id }}"
                            data-item="{{ $auction->item }}"
                            data-description="{{ $auction->description }}"
                            data-startingbid="{{ $auction->starting_bid }}">Edit</button>
                        <form method="POST" action="/admin?delete_auction={{ $auction->id }}"  class="d-inline" onsubmit="return confirm('Delete this auction?');">
                            @csrf
                            <input type="hidden" name="_action" value="delete_auction">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        <a href="/admin?view_auction={{ $auction->id }}" class="btn btn-info btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- BIDS SECTION -->
    <div class="section" id="bidsSection">
        <h4>Bids</h4>
        <table class="table table-bordered bg-white shadow-sm" id="bidsTable" style="width:100%">
            <thead class="table-light">
                <tr>
                    <th>Bid ID</th>
                    <th>Auction Title</th>
                    <th>User Name</th>
                    <th>Amount</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($bids as $bid)
                <tr>
                    <td>{{ $bid->id }}</td>
                    <td>{{ $bid->auction->item ?? 'N/A' }}</td>
                    <td>{{ $bid->user->name ?? 'N/A' }}</td>
                    <td>
                        <form method="POST" action="/admin?edit_bid={{ $bid->id }}" class="d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="_action" value="edit_bid">
                            <input name="amount" value="{{ $bid->amount }}" class="form-control form-control-sm me-2" style="width:100px;">
                            <button class="btn btn-success btn-sm">Save</button>
                        </form>
                    </td>
                    <td>
                        <form method="POST" action="/admin?delete_bid={{ $bid->id }}" class="d-inline" onsubmit="return confirm('Delete this bid?');">
                            @csrf
                            <input type="hidden" name="_action" value="delete_bid">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="/admin?reset_user=1" id="changePasswordForm">
        @csrf
        <input type="hidden" name="user_id" id="changePasswordUserId">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="newPassword" class="form-label">New Password for <span id="changePasswordUsername"></span></label>
                    <input type="password" class="form-control" name="password" id="newPassword" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save Password</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="/admin?add_user=1">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Add User</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editUserForm">
        @csrf
        <input type="hidden" name="_action" value="edit_user">
        <input type="hidden" name="user_id" id="editUserId">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input name="name" id="editUserName" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" id="editUserEmail" type="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password (leave blank to keep unchanged)</label>
                    <input name="password" type="password" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Add Auction Modal -->
<div class="modal fade" id="addAuctionModal" tabindex="-1" aria-labelledby="addAuctionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="/admin?add_auction=1">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAuctionLabel">Add Auction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Item</label>
                    <input name="item" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Starting Bid</label>
                    <input name="starting_bid" type="number" step="0.01" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Add Auction</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Edit Auction Modal -->
<div class="modal fade" id="editAuctionModal" tabindex="-1" aria-labelledby="editAuctionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editAuctionForm">
        @csrf
        <input type="hidden" name="_action" value="edit_auction">
        <input type="hidden" name="auction_id" id="editAuctionId">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAuctionLabel">Edit Auction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Item</label>
                    <input name="item" id="editAuctionItem" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="editAuctionDescription" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Starting Bid</label>
                    <input name="starting_bid" id="editAuctionStartingBid" type="number" step="0.01" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Navigation logic
    document.querySelectorAll('#adminNav .nav-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('#adminNav .nav-link').forEach(l => l.classList.remove('active'));
            link.classList.add('active');
            document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
            document.getElementById(link.getAttribute('data-section')).classList.add('active');
        });
    });

    // DataTables with all features enabled
    $('#usersTable').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
    });
    $('#auctionsTable').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
    });
    $('#bidsTable').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthChange: true,
        autoWidth: false,
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']
    });

    // Change password modal logic
    var changePasswordModal = document.getElementById('changePasswordModal');
    changePasswordModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-userid');
        var username = button.getAttribute('data-username');
        document.getElementById('changePasswordUserId').value = userId;
        document.getElementById('changePasswordUsername').textContent = username;
        document.getElementById('newPassword').value = '';
    });

    // Edit user modal logic
    var editUserModal = document.getElementById('editUserModal');
    editUserModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var userId = button.getAttribute('data-userid');
        var username = button.getAttribute('data-username');
        var useremail = button.getAttribute('data-useremail');
        document.getElementById('editUserId').value = userId;
        document.getElementById('editUserName').value = username;
        document.getElementById('editUserEmail').value = useremail;
        document.getElementById('editUserForm').action = '/admin?edit_user=' + userId;
    });

    // Edit auction modal logic
    var editAuctionModal = document.getElementById('editAuctionModal');
    editAuctionModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var auctionId = button.getAttribute('data-auctionid');
        var item = button.getAttribute('data-item');
        var description = button.getAttribute('data-description');
        var startingBid = button.getAttribute('data-startingbid');
        document.getElementById('editAuctionId').value = auctionId;
        document.getElementById('editAuctionItem').value = item;
        document.getElementById('editAuctionDescription').value = description;
        document.getElementById('editAuctionStartingBid').value = startingBid;
        document.getElementById('editAuctionForm').action = '/admin?edit_auction=' + auctionId;
    });
});
</script>
</body>
</html>