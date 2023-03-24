<?php
    require_once '../includes/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <?php
        require_once 'sidebar.php';
    ?>
    <!-- start of first container -->
    <div class="container ms-5">
        <?php
            if(isset($_POST['add'])){
                $add_service_category = mysqli_real_escape_string($conn, $_POST['add_service_category']);
                $add_service = mysqli_real_escape_string($conn, $_POST['add_service']);
                $add_description = mysqli_real_escape_string($conn, $_POST['add_description']);
                $add_price = mysqli_real_escape_string($conn, $_POST['add_price']);
                
                
                if(empty($add_service_category) || empty($add_service) || empty($add_description) || empty($add_price)){
                    $error_message = "All fields are required!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }else{
                    $sql = "INSERT INTO service (category_id, service, description, price) VALUES ($add_service_category, '$add_service', '$add_description', '$add_price');";
    
                    if(mysqli_query($conn, $sql)){
                    }
                }
            }
        ?>
        <h3 class="text-dark mt-3 text-center">Services</h3>
        <!-- start of container fluid -->
        <div class="container-fluid mt-3">
            <!-- start of add service modal button -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_service_modal">Add service</button>
            <!-- end of add service modal button -->

            <!-- start of add service modal -->
            <div class="modal fade" id="add_service_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add service</h1>
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
                                                            <label for="add_service_category" class="ps-2 pb-2">Category</label>
                                                            <select class="form-select" aria-label="Default select example" name="add_service_category" id="add_service_category" required>
                                                                <option selected disabled>-- Select category --</option>
                                                                <?php
                                                                    $sql_category = "SELECT * FROM category;";
                                                                    $result_category = mysqli_query($conn, $sql_category);
                                                                    if(mysqli_num_rows($result_category) > 0){
                                                                        while($row_category = mysqli_fetch_assoc($result_category)){
                                                                            $category_id = $row_category['category_id'];
                                                                            $category_name = $row_category['category'];
                                                                            echo '<option value="' .$category_id. '">' .$category_name. '</option>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_service" class="ps-2 pb-2">Service</label>
                                                            <input type="text" class="form-control" name="add_service" id="add_service" value="" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_description" class="ps-2 pb-2">Service description</label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Leave a comment here" id="add_description" style="height: 100px" name="add_description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_price" class="ps-2 pb-2">Price</label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text" id="basic-addon1">₱</span>
                                                                <input type="text" class="form-control" name="add_price" id="add_price" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                            </div>
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
                                        <th class="table-light text-uppercase">service id</th>
                                        <th class="table-light text-uppercase d-none">category id</th>
                                        <th class="table-light text-uppercase">category</th>
                                        <th class="table-light text-uppercase">service</th>
                                        <th class="table-light text-uppercase">description</th>
                                        <th class="table-light text-uppercase">price</th>
                                        <th class="table-light text-uppercase">date added</th>
                                        <th class="table-light text-uppercase">last updated</th>
                                        <th class="table-light text-uppercase">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                <?php
                                    $sql_select = "SELECT category.category_id, category.category, service.* FROM category INNER JOIN service USING (category_id) WHERE service.is_deleted != 1 ORDER BY service.service_id DESC;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if(mysqli_num_rows($result_select) > 0){
                                        while($row_select = mysqli_fetch_assoc($result_select)){
                                            $service_id = $row_select['service_id'];
                                            $category_id = $row_select['category_id'];
                                            $category = $row_select['category'];
                                            $service = $row_select['service'];
                                            $description = $row_select['description'];
                                            $price = $row_select['price'];
                                            $service_date_added = $row_select['date_added'];
                                            $service_last_updated = $row_select['last_updated'];
                                ?>
                                            <tr>
                                                <td class="text-center"><?= $service_id ?></td>
                                                <td class="text-center d-none"><?= $category_id ?></td>
                                                <td class="text-center"><?= $category ?></td>
                                                <td class="text-center"><?= $service ?></td>
                                                <td class="text-center"><?= $description ?></td>
                                                <td class="text-center"><?= $price ?></td>
                                                <td class="text-center"><?= $service_date_added ?></td>
                                                <td class="text-center"><?= $service_last_updated ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary view" href="#" data-bs-toggle="modal" data-bs-target="#view_service_modal"><i class="fa-solid fa-eye"></i></a> 
                                                    <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_service_modal"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                    <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_service_modal"><i class="fa-solid fa-trash"></i></a>
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
    <div class="modal fade" id="view_service_modal">
        <!-- start of view modal dialog -->
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- start of view modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">View service</h4>
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
                                                    <label for="view_category" class="ps-2 pb-2">Category</label>
                                                    <input type="text" class="form-control" name="view_category" id="view_category" value="" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_service" class="ps-2 pb-2">Service</label>
                                                    <input type="text" class="form-control" name="view_service" id="view_service" value="" disabled>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_description" class="ps-2 pb-2">Service description</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control p-3" placeholder="Leave a comment here" id="view_description" style="height: 100px" name="view_description" disabled></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_price" class="ps-2 pb-2">Price</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">₱</span>
                                                        <input type="text" class="form-control" name="view_price" id="view_price" placeholder="" aria-label="" aria-describedby="basic-addon1" disabled>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_service_date_added" class="ps-2 pb-2">Date added</label>
                                                    <input type="text" class="form-control" name="view_service_date_added" id="view_service_date_added" value="" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_service_last_updated" class="ps-2 pb-2">Last updated</label>
                                                    <input type="text" class="form-control" name="view_service_last_updated" id="view_service_last_updated" value="" disabled>
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

    
    <!-- start of edit service modal -->
    <div class="modal fade" id="edit_service_modal">
        <!-- start of edit modal dialog -->
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- start of edit modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">Edit service</h4>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <!-- end of modal header -->
                <!-- start of edit modal form -->
                <form action="includes/edit-service.inc.php" method="post">
                    <!-- start of edit modal body -->                
                    <div class="modal-body">
                        <input type="hidden" name="edit_service_id" id="edit_service_id">
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
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_service" class="ps-2 pb-2">Service</label>
                                                    <input type="text" class="form-control" name="edit_service" id="edit_service" value="" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                            </div>
                                            
                                            <div class="col-md-12 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_description" class="ps-2 pb-2">Service description</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control pt-1" placeholder="Leave a comment here" id="edit_description" style="height: 100px" name="edit_description"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_price" class="ps-2 pb-2">Price</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">₱</span>
                                                        <input type="text" class="form-control" name="edit_price" id="edit_price" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                    </div>
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
    <!-- end of edit service modal -->


    <!-- start of delete service modal -->
    <div class="modal fade" id="delete_service_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete service</h1>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                </div>
                <!-- start of delete modal form -->
                <form action="includes/delete-service.inc.php" method="post">
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
                                                    <input type="hidden" name="delete_service_id" id="delete_service_id" class="form-control mb-3">
                                                    <h3>Are you sure you want to delete this service?</h3>
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
    <!-- end of delete service modal -->
    <?php
        require_once 'footer.php';
    ?>