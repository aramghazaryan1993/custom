<?php

include('check/isNotLogin.php');

include('index.php');

$data = $userController->getData();


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Bootstrap CRUD Data Table for Database with Modal Form</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="asset/style.css" />
        <script type="text/javascript" src="asset/script.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <a href="logout.php" class="btn btn-danger" ><span>Logout</span></a>
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>age</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if(!empty($data)) { foreach ($data as $value){ ?>
                            <script>var id = "<?php $value["user_id"]; ?>"</script>
                        <tr data-id="<?php echo $value["id"]; ?>">
                            <?php
                            echo '<td >'.$value["user_id"].'</td>
                            <td>'.$value["name"].'</td>
                            <td>'.$value["username"].'</td>
                            <td>'.$value["address"].'</td>
                            <td>'.$value["phone"].'</td>
                            <td>'.$value["age"].'</td>
                            <td>
                                <a href="#editEmployeeModal" data-id="'.$value["user_id"].'" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" >&#xE254;</i></a>
                                <a href="#deleteEmployeeModal" data-id="'.$value["user_id"].'" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" >&#xE872;</i></a>
                            </td>';
                            ?>

                        </tr>
                    <?php }} ?>
                    </tbody>
                </table>

            </div>
        </div>

        <!-- Add Modal HTML -->
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="employeeForm">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username"  class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address"  required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone"  required />
                            </div>
                            <div class="form-group">
                                <label>Age</label>
                                <input type="number" class="form-control" name="age"  required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />
                            <input type="submit" class="btn btn-success" value="Add" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="editEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editEmployeeForm" method="POST">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <!-- Hidden input for ID -->
                            <input type="hidden" name="id" />
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" name="phone" required />
                            </div>
                            <div class="form-group">
                                <label>Age</label>
                                <input type="number" class="form-control" name="age" required />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control"  />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Delete Modal HTML -->
        <div id="deleteEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete these Records?</p>
                            <p class="text-warning"><small>This action cannot be undone.</small></p>
                        </div>

                        <div class="modal-footer">
                            <input  type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />
                            <input id="confirmDelete" type="button" class="btn btn-danger delete" value="Delete" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>