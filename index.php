<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <form action="" method="post" id="form-data">
                    <div class="form-group">
                        <input type="text" name="fname" class="form-control" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="lname" class="form-control" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="tel" name="Phone" class="form-control" placeholder="Phone Number">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="insert" class="btn btn-success" value="Add User" >
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/v/bs4/dt-1.13.4/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CONTROLLER -->
    <script type="text/javascript">
        $(document).ready(() => {
            $("table").DataTable();

            showAllUsers();

            function showAllUsers() {
                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: { action:"view"},
                    success: (response) => {
                        console.log(response);
                        $("#showUser").html(response);
                        $("table").DataTable({
                            order: [0, 'desc']
                        });
                    }
                });
            }

        });
    </script>
</body>
</html>