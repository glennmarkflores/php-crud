<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
</head>
<body>
   
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Navbar</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            </ul>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="font-weight-normal my-3">Crud App</h4>
            </div>
            <div class="col-lg-6">
                <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#addModal">
                    <i class="fas fa-user"></i>  Add  New User
                </button>
            </div>
            <div class="col-lg-12 my-4">
                <div class="table-responsive" id="showUser">
                    <!--TABLE-->

                </div>
            </div>
        </div>
    </div>

    <!-- Add New User MODAL -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Add New User</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" method="POST" id="form-data">
                    <div class="form-group">
                        <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="insert" id="insert" class="btn btn-success" value="Add User" required>
                    </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
        </div>
        </div>
    </div>

    <!-- Edit User MODAL -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Edit User</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body px-4">
                <form action="" method="POST" id="edit-form-data">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" name="fname" id="fname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lname" id="lname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" id="phone" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="update" id="update" class="btn btn-primary" value="Update User" required>
                    </div>
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            
        </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CONTROLLER -->
    <script type="text/javascript">
        $(document).ready(() => {
            $("table").DataTable();

            showAllUsers();

            //show users ajax request
            function showAllUsers() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: { action:"view"},
                    success: (response) => {
                        $("#showUser").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }

            // insert ajax request
            $("#insert").click((e) => {
                if($("#form-data")[0].checkValidity()) {
                    e.preventDefault();
                    $.ajax({
                        url: "action.php",
                        type: "POST",
                        data: $("#form-data").serialize()+"&action=insert",
                        success: (response) => {
                            console.log(response);
                            Swal.fire({
                                title: 'User added successfully',
                                type: 'success'
                            })
                            $("#addModal").modal('hide');
                            $("#form-data")[0].reset();
                            showAllUsers();
                        }
                    });
                }
            });

            //edit user ajax request
            $("body").on("click", ".editBtn", (e) => {
                edit_id = $(this).attr('id');
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {edit_id:edit_id},
                    success: (response) => {
                       data = JSON.parse(response);
                       $("#id").val(data.id);
                    }
                });
            });

        });
    </script>
</body>
</html>