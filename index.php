<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap CRUD Data Table for Database with Modal Form</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!--use toster for show massage jquery plugins -->

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
    .pagination {
        display: flex;
        /* Change to flex to apply justify-content */
        justify-content: flex-end;
        /* Align items to the end of the container */
        /* margin-top: 20px;  */
    }

    .pagination a {
        display: inline-block;
        border-radius: 30%;
        /* width: 30px; */
        height: 40px;
        line-height: 30px;
        text-align: center;
        margin-right: 5px;
        /* Adjust the margin between pagination numbers */
        background-color: #f0f0f0;
        color: black;
        /* Set font color to black */

    }


    body {
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
    }

    .table-responsive {
        /* margin: 30px 0; */
        align-items: center;
    }

    .table-wrapper {
        background: #fff;
        padding: 20px 25px;
        border-radius: 3px;
        min-width: 1000px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
        padding-bottom: 15px;
        background: #435d7d;
        color: #fff;
        padding: 16px 30px;
        min-width: 100%;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }

    .table-title .btn-group {
        float: right;
    }

    .table-title .btn {
        color: #fff;
        float: right;
        font-size: 13px;
        border: none;
        min-width: 50px;
        border-radius: 2px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }

    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }

    table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    table.table tr th:first-child {
        width: 60px;
    }

    table.table tr th:last-child {
        width: 100px;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
        outline: none !important;
    }

    table.table td a:hover {
        color: #2196F3;
    }

    table.table td a.edit {
        color: #FFC107;
    }

    table.table td a.delete {
        color: #F44336;
    }

    table.table td i {
        font-size: 19px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }


    .btn-page {
        margin-right: 10px;
        padding: 5px 10px;
        border: #CCC 1px solid;
        background: #FFF;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-page:hover {
        background: #F0F0F0;
    }

    .btn-page.current {
        background: #F0F0F0;
    }

    /* .pagination {
 float: right;
 margin: 0 0 5px;
}
.pagination li a {
 border: none;
 font-size: 13px;
 min-width: 30px;
 min-height: 30px;
 color: #999;
 margin: 0 2px;
 line-height: 30px;
 border-radius: 2px !important;
 text-align: center;
 padding: 0 6px;
}
.pagination li a:hover {
 color: #666;
}
.pagination li.active a, .pagination li.active a.page-link {
 background: #03A9F4;
}
.pagination li.active a:hover {
 background: #0397d6;
}
.pagination li.disabled i {
 color: #ccc;
}
.pagination li i {
 font-size: 16px;
 padding-top: 6px
} */
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }

    /* Custom checkbox */
    .custom-checkbox {
        position: relative;
    }

    .custom-checkbox input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        margin: 5px 0 0 3px;
        z-index: 9;
    }

    .custom-checkbox label:before {
        width: 18px;
        height: 18px;
    }

    .custom-checkbox label:before {
        content: '';
        margin-right: 10px;
        display: inline-block;
        vertical-align: text-top;
        background: white;
        border: 1px solid #bbb;
        border-radius: 2px;
        box-sizing: border-box;
        z-index: 2;
    }

    .custom-checkbox input[type="checkbox"]:checked+label:after {
        content: '';
        position: absolute;
        left: 6px;
        top: 3px;
        width: 6px;
        height: 11px;
        border: solid #000;
        border-width: 0 3px 3px 0;
        transform: inherit;
        z-index: 3;
        transform: rotateZ(45deg);
    }

    .custom-checkbox input[type="checkbox"]:checked+label:before {
        border-color: #03A9F4;
        background: #03A9F4;
    }

    .custom-checkbox input[type="checkbox"]:checked+label:after {
        border-color: #fff;
    }

    .custom-checkbox input[type="checkbox"]:disabled+label:before {
        color: #b8b8b8;
        cursor: auto;
        box-shadow: none;
        background: #ddd;
    }

    /* Modal styles */
    .modal .modal-dialog {
        max-width: 400px;
    }

    .modal .modal-header,
    .modal .modal-body,
    .modal .modal-footer {
        padding: 20px 30px;
    }

    .modal .modal-content {
        border-radius: 3px;
        font-size: 14px;
    }

    .modal .modal-footer {
        background: #ecf0f1;
        border-radius: 0 0 3px 3px;
    }

    .modal .modal-title {
        display: inline-block;
    }

    .modal .form-control {
        border-radius: 2px;
        box-shadow: none;
        border-color: #dddddd;
    }

    .modal textarea.form-control {
        resize: vertical;
    }

    .form-control {
        width: 70%;
    }

    .modal .btn {
        border-radius: 2px;
        min-width: 100px;
    }

    .modal form label {
        font-weight: normal;
    }
    </style>

</head>

<body>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>company</b></h2>
                            <!-- <input type="text" id="search" class="form-control" placeholder="Search"> -->
                        </div>

                        <div class="col-sm-6" style='text-align: right;
									margin: 20px 0px;
									display: flex;
									align-content: stretch;
									justify-content: flex-end;
									flex-wrap: nowrap;'>
                            <input type='text' style="width: 50%;height: 100%;" class="form-control mr-sm-2"
                                ria-label="Search" name='search_keyword' id='keyword' 
                                placeholder="serach" >
                            <a href="add.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add
                                    New Company</span></a>
                            <!--<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>-->

                        </div>
                    </div>
                </div>


                <table class="table table-striped table-hover" id="companyTable">
                    <thead>
                        <tr>

                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <!-- Table body -->
                    <tbody id='table-body'>
                        <!-- Results will be populated here using AJAX -->
                    </tbody>
                </table>
                <div id="pagination" style="text-align: end;"></div>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script>
    function fetchResults(page) {
        var keyword = $('#keyword').val();
        $.ajax({
            type: 'GET',
            url: 'ajax_search.php',
            data: {
                search_keyword: keyword,
                page: page
            },
            success: function(response) {
                $('#table-body').html(response.html);
                $('#pagination').html(response.pagination);
            }
        });
    }

    $(document).ready(function() {
        // Call fetchResults to load initial data
        fetchResults(1);

        // Event handler for input change
        $('#keyword').on('input', function() {
            fetchResults(1); // Fetch results for the first page when the keyword changes
        });

        // Event handler for pagination buttons
        $(document).on('click', '.btn-page', function() {
            var page = $(this).val();
            fetchResults(page); // Fetch results for the selected page when pagination button is clicked
        });
    });
    </script>
    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit company</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required name="name">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" required name="email>
					</div>
					<div class=" form-group">
                            <label>Address</label>
                            <textarea class="form-control" required name="address"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteForm" action="delete.php" method="post">
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Company</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                        <!-- Hidden input field to store the ID of the record -->
                        <input type="hidden" name="id" id="deleteId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <!-- Delete button within the form -->
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    $(document).on("click", ".delete", function() {
        var id = $(this).data('id');
        console.log(id);
        $("#deleteId").val(id); // Set the ID value in the hidden input field
        // Set the action attribute of the form with the ID appended
        $("#deleteForm").attr("action", "delete.php?id=" + id);
    });
    </script>





    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
    $(document).ready(function() {
        <?php if(isset($_SESSION['message'])): ?>
        // Show success message using Toastr
        toastr.success('<?php echo $_SESSION['message']; ?>');
        <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

    });
    </script>


</body>

</html>