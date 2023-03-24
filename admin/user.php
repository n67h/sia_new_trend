<?php
    require_once '../includes/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <?php
        require_once 'sidebar.php';
    ?>
    <!-- start of first container -->
    <div class="container ms-5">
        <?php
            if(isset($_POST['add'])){
                $add_user_role = mysqli_real_escape_string($conn, $_POST['add_user_role']);
                $add_username = mysqli_real_escape_string($conn, $_POST['add_username']);
                $add_first_name = mysqli_real_escape_string($conn, $_POST['add_first_name']);
                $add_last_name = mysqli_real_escape_string($conn, $_POST['add_last_name']);
                $add_email = mysqli_real_escape_string($conn, $_POST['add_email']);
                $add_phone_number = mysqli_real_escape_string($conn, $_POST['add_phone_number']);
                $add_password = mysqli_real_escape_string($conn, $_POST['add_password']);
                $add_repeat_password = mysqli_real_escape_string($conn, $_POST['add_repeat_password']);
                
                if(empty($add_user_role) || empty($add_username) || empty($add_first_name) || empty($add_last_name) || empty($add_email) || empty($add_phone_number) || empty($add_password) || empty($add_repeat_password)){
                    $error_message = "All fields are required!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }elseif($add_password !== $add_repeat_password){
                    $error_message = "Password does not match!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }else{
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    //generate random verification key
                    $vkey = md5(time());

                    if($add_user_role == 2){
                        $sql = "INSERT INTO user (user_role_id, username, password, verification_key) VALUES ($add_user_role, '$add_username', '$hashed_password', '$vkey');";
                        if(mysqli_query($conn, $sql)){
                            $new_id = mysqli_insert_id($conn);
                            $query = "INSERT INTO user_info (user_id, email, phone_number, first_name, last_name) VALUES ($new_id, '$add_email', '$add_phone_number', '$add_first_name', '$add_last_name');";
                            if(mysqli_query($conn, $query)){
                                header('location: user.php?insertsuccess');
                            }
                        }
                    }elseif($add_user_role == 1){
                        $sql = "INSERT INTO user (user_role_id, username, password, verification_key) VALUES ($add_user_role, '$add_username', '$hashed_password', 'N/A');";
                        if(mysqli_query($conn, $sql)){
                            $new_id = mysqli_insert_id($conn);
                            $query = "INSERT INTO user_info (user_id, email, phone_number, first_name, last_name) VALUES ($new_id, '$add_email', '$add_phone_number', '$add_first_name', '$add_last_name');";
                            if(mysqli_query($conn, $query)){
                                header('location: user.php?insertsuccess');
                            }
                        }
                    }
                }
            }
        ?>
        <h3 class="text-dark mt-3 text-center">Users</h3>
        <!-- start of container fluid -->
        <div class="container-fluid mt-3">
            <!-- start of add user modal button -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_user_modal">Add user</button>
            <!-- end of add user modal button -->

            <!-- start of add user modal -->
            <div class="modal fade" id="add_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add user</h1>
                            <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                        </div>
                        <!-- start of add modal form -->
                        <form action="" method="post">
                            <!-- start of add modal body -->                
                            <div class="modal-body">
                                <!-- start of add modal row -->
                                <div class="row">
                                    <!-- start of add modal col -->
                                    <div class="col-md-12">
                                        <!-- start of add modal card -->
                                        <div class="card card-primary">
                                            <!-- start of add modal card body -->
                                            <div class="card-body">
                                                <!-- start of add modal row -->
                                                <div class="row">
                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_user_role" class="ps-2 pb-2">User role</label>
                                                            <select class="form-select" aria-label="Default select example" name="add_user_role" id="add_user_role" required>
                                                                <option selected value="2">Customer</option>
                                                                <option value="1">Admin</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_username" class="ps-2 pb-2">Username</label>
                                                            <input type="text" class="form-control" name="add_username" id="add_username" value="" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_first_name" class="ps-2 pb-2">First name</label>
                                                            <input type="text" class="form-control" name="add_first_name" id="add_first_name" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_last_name" class="ps-2 pb-2">Last name</label>
                                                            <input type="text" class="form-control" name="add_last_name" id="add_last_name" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_email" class="ps-2 pb-2">Email</label>
                                                            <input type="text" class="form-control" name="add_email" id="add_email" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_phone_number" class="ps-2 pb-2">Phone number</label>
                                                            <input type="text" class="form-control" name="add_phone_number" id="add_phone_number" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_password" class="ps-2 pb-2">Password</label>
                                                            <input type="password" class="form-control" name="add_password" id="add_password" value="" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_repeat_password" class="ps-2 pb-2">Repeat password</label>
                                                            <input type="password" class="form-control" name="add_repeat_password" id="add_repeat_password" value="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end of add modal row -->
                                            </div>
                                            <!-- end of add modal card body -->
                                            <!-- start of add modal footer -->
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" name="add" class="btn btn-success">Save Changes</button>
                                            </div>
                                            <!-- end of add modal footer -->
                                        </div>
                                        <!-- end of add modal card -->
                                    </div>
                                    <!-- end of add modal col -->
                                </div>
                                <!-- end of add modal row -->
                            </div>
                            <!-- end of add modal body -->                
                        </form>
                        <!-- end of add modal form -->
                    </div>
                </div>
            </div>
            <!-- end of add service modal -->

            <!-- start of first row -->
            <div class="row">
                <!-- start of second container -->
                <div class="container">
                    <!-- start of second row -->
                    <div class="row">
                        <!-- start of div on center -->
                        <div class="col-md-12">
                            <!-- start of table -->
                            <table class="table table-bordered table-striped" id="datatable">
                                <!-- start of table header -->
                                <thead>
                                    <tr>
                                        <th class="d-none">user role id</th>
                                        <th class="table-light text-uppercase">user id</th>
                                        <th class="table-light text-uppercase">user role</th>
                                        <th class="table-light text-uppercase">username</th>
                                        <th class="d-none">first name</th>
                                        <th class="d-none">last name</th>
                                        <th class="d-none">email</th>
                                        <th class="d-none">phone number</th>
                                        <th class="table-light text-uppercase">status</th>
                                        <th class="table-light text-uppercase">last login</th>
                                        <th class="table-light text-uppercase">date added</th>
                                        <th class="table-light text-uppercase">last updated</th>
                                        <th class="d-none">date added</th>
                                        <th class="d-none">last updated</th>
                                        <th class="table-light text-uppercase">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                <?php
                                    $sql_select = "SELECT user_role.user_role_id, user_role.role, user.user_id, user.user_role_id, user.username, user.is_verified, user.last_login, user.date_added AS user_date_added, user.last_updated AS user_last_updated, user_info.user_info_id, user_info.user_id, user_info.email, user_info.phone_number, user_info.first_name, user_info.last_name, user_info.date_added AS user_info_date_added, user_info.last_updated AS user_info_last_updated FROM user_info INNER JOIN user USING (user_id) INNER JOIN user_role USING (user_role_id) WHERE user.is_deleted != 1;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if(mysqli_num_rows($result_select) > 0){
                                        while($row_select = mysqli_fetch_assoc($result_select)){
                                            $user_role_id = $row_select['user_role_id'];
                                            $user_id = $row_select['user_id'];
                                            $role = $row_select['role'];
                                            $username = $row_select['username'];
                                            $first_name = $row_select['first_name'];
                                            $last_name = $row_select['last_name'];
                                            $email = $row_select['email'];
                                            $phone_number = $row_select['phone_number'];
                                            $is_verified = $row_select['is_verified'];
                                            $last_login = $row_select['last_login'];
                                            $user_date_added = $row_select['user_date_added'];
                                            $user_last_updated = $row_select['user_last_updated'];
                                            $user_info_date_added = $row_select['user_info_date_added'];
                                            $user_info_last_updated = $row_select['user_info_last_updated'];

                                            if($is_verified == 0){
                                                $is_verified = 'Not verified yet';
                                            }elseif($is_verified == 1){
                                                $is_verified = 'Verified';
                                            }
                                ?>
                                            <tr>
                                                <td class="d-none"><?= $user_role_id; ?></td>
                                                <td class="text-center"><?= $user_id ?></td>
                                                <td class="text-center"><?= $role ?></td>
                                                <td class="text-center"><?= $username ?></td>
                                                <td class="d-none"><?= $first_name; ?></td>
                                                <td class="d-none"><?= $last_name; ?></td>
                                                <td class="d-none"><?= $email; ?></td>
                                                <td class="d-none"><?= $phone_number; ?></td>
                                                <td class="text-center"><?= $is_verified ?></td>
                                                <td class="text-center"><?= $last_login ?></td>
                                                <td class="text-center"><?= $user_date_added ?></td>
                                                <td class="text-center"><?= $user_last_updated ?></td>
                                                <td class="d-none"><?= $user_info_date_added; ?></td>
                                                <td class="d-none"><?= $user_info_last_updated; ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary view" href="#" data-bs-toggle="modal" data-bs-target="#view_user_modal"><i class="fa-solid fa-eye"></i></a> 
                                                    <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_user_modal"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                    <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_user_modal"><i class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }else{
                                ?>
                                    <tr>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="10" class="text-center">No records found.</td>
                                    </tr>
                                <?php
                                    }
                                ?>
                                </tbody>
                                <!-- end of table body -->
                            </table>
                            <!-- end of table -->
                        </div>
                        <!-- end of div on center -->
                    </div>
                    <!-- end of second row -->
                </div>
                <!-- end of second container -->
            </div>
            <!-- end of first row -->
        </div>
        <!-- end of container fluid -->
    </div>
    <!-- end of first container -->
    
    <!-- start of view modal -->
    <div class="modal fade" id="view_user_modal">
        <!-- start of view modal dialog -->
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- start of view modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">View user</h4>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <!-- end of modal header -->
                <!-- start of view modal form -->
                <form action="" method="post">
                    <!-- start of view modal body -->                
                    <div class="modal-body">
                        <input type="hidden" name="view_service_id" id="view_service_id">
                        <!-- start of view modal row -->
                        <div class="row">
                            <!-- start of view modal col -->
                            <div class="col-md-12">
                                <!-- start of view modal card -->
                                <div class="card card-primary">
                                    <!-- start of view modal card body -->
                                    <div class="card-body">
                                        <!-- start of view modal row -->
                                        <div class="row">
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_user_id" class="ps-2 pb-2">User ID</label>
                                                    <input type="text" class="form-control" name="view_user_id" id="view_user_id" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_user_role" class="ps-2 pb-2">User role</label>
                                                    <input type="text" class="form-control" name="view_user_role" id="view_user_role" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_username" class="ps-2 pb-2">Username</label>
                                                    <input type="text" class="form-control" name="view_username" id="view_username" value="" required disabled>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_first_name" class="ps-2 pb-2">First name</label>
                                                    <input type="text" class="form-control" name="view_first_name" id="view_first_name" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_last_name" class="ps-2 pb-2">Last name</label>
                                                    <input type="text" class="form-control" name="view_last_name" id="view_last_name" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_email" class="ps-2 pb-2">Email</label>
                                                    <input type="text" class="form-control" name="view_email" id="view_email" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_phone_number" class="ps-2 pb-2">Phone number</label>
                                                    <input type="text" class="form-control" name="view_phone_number" id="view_phone_number" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_is_verified" class="ps-2 pb-2">Status</label>
                                                    <input type="text" class="form-control" name="view_is_verified" id="view_is_verified" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_last_login" class="ps-2 pb-2">Last login</label>
                                                    <input type="text" class="form-control" name="view_last_login" id="view_last_login" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_user_date_added" class="ps-2 pb-2">Date added</label>
                                                    <input type="text" class="form-control" name="view_user_date_added" id="view_user_date_added" value="" required disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_user_info_last_updated" class="ps-2 pb-2">Last updated</label>
                                                    <input type="text" class="form-control" name="view_user_info_last_updated" id="view_user_info_last_updated" value="" required disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of view modal row -->
                                    </div>
                                    <!-- end of view modal card body -->
                                    <!-- start of view modal footer -->
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    <!-- end of view modal footer -->
                                </div>
                                <!-- end of view modal card -->
                            </div>
                            <!-- end of view modal col -->
                        </div>
                        <!-- end of view modal row -->
                    </div>
                    <!-- end of view modal body -->                
                </form>
                <!-- end of view modal form -->
            </div>
            <!-- end of view modal content -->
        </div>
        <!-- end of view modal dialog -->
    </div>
    <!-- end of view modal -->

    <!-- start of edit user modal -->
    <div class="modal fade" id="edit_user_modal">
        <!-- start of edit modal dialog -->
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- start of edit modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">Edit user</h4>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <!-- end of modal header -->
                <!-- start of edit modal form -->
                <form action="includes/edit-user.inc.php" method="post">
                    <!-- start of edit modal body -->                
                    <div class="modal-body">
                        <!-- <input type="hidden" name="edit_user_id" id="edit_user_id"> -->
                        <!-- start of edit modal row -->
                        <div class="row">
                            <!-- start of edit modal col -->
                            <div class="col-md-12">
                                <!-- start of edit modal card -->
                                <div class="card card-primary">
                                    <!-- start of edit modal card body -->
                                    <div class="card-body">
                                        <!-- start of edit modal row -->
                                        <div class="row">
                                            <!-- <label for="edit_user_id" class="ps-2 pb-2">User ID</label> -->
                                            <input type="hidden" class="form-control" name="edit_user_id" id="edit_user_id" value="" required>
                                            <!-- <label for="edit_user_role" class="ps-2 pb-2">User role</label> -->
                                            <input type="hidden" class="form-control" name="edit_user_role" id="edit_user_role" value="" required>
                                           
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_first_name" class="ps-2 pb-2">First name</label>
                                                    <input type="text" class="form-control" name="edit_first_name" id="edit_first_name" value="" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_last_name" class="ps-2 pb-2">Last name</label>
                                                    <input type="text" class="form-control" name="edit_last_name" id="edit_last_name" value="" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_username" class="ps-2 pb-2">Username</label>
                                                    <input type="text" class="form-control" name="edit_username" id="edit_username" value="" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_email" class="ps-2 pb-2">Email</label>
                                                    <input type="text" class="form-control" name="edit_email" id="edit_email" value="">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_phone_number" class="ps-2 pb-2">Phone number</label>
                                                    <input type="text" class="form-control" name="edit_phone_number" id="edit_phone_number" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of edit modal row -->
                                    </div>
                                    <!-- end of edit modal card body -->
                                    <!-- start of edit modal footer -->
                                    <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="edit" class="btn btn-success">Save Changes</button>
                                    </div>
                                    <!-- end of edit modal footer -->
                                </div>
                                <!-- end of edit modal card -->
                            </div>
                            <!-- end of edit modal col -->
                        </div>
                        <!-- end of edit modal row -->
                    </div>
                    <!-- end of edit modal body -->                
                </form>
                <!-- end of edit modal form -->
            </div>
            <!-- end of edit modal content -->
        </div>
        <!-- end of edit modal dialog -->
    </div>
    <!-- end of edit user modal -->

    <!-- start of delete user modal -->
    <div class="modal fade" id="delete_user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete user</h1>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                </div>
                <!-- start of delete modal form -->
                <form action="includes/delete-user.inc.php" method="post">
                    <!-- start of delete modal body -->                
                    <div class="modal-body">
                        <!-- start of delete modal row -->
                        <div class="row">
                            <!-- start of delete modal col -->
                            <div class="col-md-12">
                                <!-- start of delete modal card -->
                                <div class="card card-primary">
                                    <!-- start of delete modal card body -->
                                    <div class="card-body">
                                        <!-- start of delete modal row -->
                                        <div class="row">
                                            <div class="col-md-12 col-12 mt-3">
                                                <div class="form-group">
                                                    <input type="hidden" name="delete_user_id" id="delete_user_id" class="form-control mb-3">
                                                    <h3>Are you sure you want to delete this user?</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of delete modal row -->
                                    </div>
                                    <!-- end of delete modal card body -->
                                    <!-- start of delete modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal">No</button>
                                        <button type="submit" name="delete" class="btn btn-danger btn-lg">Yes</button>
                                    </div>
                                    <!-- end of delete modal footer -->
                                </div>
                                <!-- end of delete modal card -->
                            </div>
                            <!-- end of delete modal col -->
                        </div>
                        <!-- end of delete modal row -->
                    </div>
                    <!-- end of delete modal body -->                
                </form>
                <!-- end of delete modal form -->
            </div>
        </div>
    </div>
    <!-- end of delete user modal -->
    <?php
        require_once 'footer.php';
    ?>