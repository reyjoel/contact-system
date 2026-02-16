<!DOCTYPE html>
<html>
<head>
    <title>Contacts</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #eee;
        }
        .container-box {
            background: #fff;
            padding: 20px;
            border: 1px solid #ccc;
        }
        table {
            background: #fff;
        }
        th {
            background: #ddd;
        }
        .top-links {
            float: right;
        }
        .search-box {
            float: right;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-4 container-box">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center">
        <h3>Contacts</h3>

        <div>
            <a href="/contact/create" class="me-2">Add Contact</a> |
            <a href="/dashboard" class="mx-2">Contacts</a> |
            <form action="/logout" method="POST" style="display:inline;">
                @csrf
                <button class="btn btn-link p-0">Logout</button>
            </form>
        </div>
    </div>

    <!-- Search -->
    <div class="search-box">
        <input type="text" id="search" class="form-control" placeholder="Search" style="width: 250px;">
    </div>

    <div class="clearfix mb-3"></div>

    <!-- Table -->
    <div id="contact-list"></div>
    
</div>

<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content p-3">
        <h5>Confirm Delete</h5>
        <p>Are you sure you want to DELETE?</p>

        <div class="text-end">
            <button class="btn btn-danger" id="confirmDelete">Delete</button>
            <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'continue'
        });
    </script>
    @endif

<script>
function loadContacts(page = 1, search = '') {
    $.get('/contacts', {
        page: page,
        search: search
    }, function(data) {
        $('#contact-list').html(data);
    });
}
// initial load
loadContacts();

// search
$('#search').on('keyup', function() {
    loadContacts(1, $(this).val());
});

// pagination
$('body').on('click', '.pagination a', function(e) {
    e.preventDefault();

    let page = $(this).data('page');
    loadContacts(page, $('#search').val());
});

// delete
let deleteId = null;

// open modal
$(document).on('click', '.btn-delete', function() {
    deleteId = $(this).data('id');
    let modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
});

// confirm delete
$('#confirmDelete').click(function() {

    $.ajax({
        url: '/contacts/' + deleteId,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            loadContacts();
            $('#deleteModal').modal('hide');
        }
    });

});
</script>

</body>
</html>