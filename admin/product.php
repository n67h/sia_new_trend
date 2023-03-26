<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <?php
        require_once 'sidebar.php';
    ?>
    <!-- start of first container -->
    <div class="container ms-5">
        <?php
            if(isset($_POST['add'])){
                $add_prod_cat = mysqli_real_escape_string($conn, $_POST['add_prod_cat']);
                $add_prod_name = mysqli_real_escape_string($conn, $_POST['add_prod_name']);
                $add_prod_price = mysqli_real_escape_string($conn, $_POST['add_prod_price']);
                $add_prod_desc = mysqli_real_escape_string($conn, $_POST['add_prod_desc']);
                
                //validate product image
                $file = $_FILES['add_prod_img'];
                $file_name = $_FILES['add_prod_img']['name'];
                $file_tmp_name = $_FILES['add_prod_img']['tmp_name'];
                $file_size = $_FILES['add_prod_img']['size'];
                $file_error = $_FILES['add_prod_img']['error'];
                $file_type = $_FILES['add_prod_img']['type'];
                
                $file_ext = explode('.', $file_name);
                $file_actual_ext = strtolower(end($file_ext));

                $allowed = array('jpg', 'jpeg', 'png',);
                
                if(empty($add_prod_cat) || empty($add_prod_name) || empty($add_prod_price) || empty($add_prod_desc)){
                   $error_message = "All fields are required!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }elseif($_FILES["add_prod_img"]["error"] == 4){
                    //means there is no file uploaded
                    // $file_destination = $image_value;
                    $error_message = "All fields are required!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }else{
                    $sql = "INSERT INTO products (cat_id, prod_name, prod_price, prod_desc) VALUES ($add_prod_cat, '$add_prod_name', $add_prod_price, '$add_prod_desc');";
    
                    if(mysqli_query($conn, $sql)){
                        $prod_id = mysqli_insert_id($conn);
                        
                        if(in_array($file_actual_ext, $allowed)) {
                            if($file_error === 0) {
                                if($file_size < 5000000) {
                                    $file_name_new = $prod_id. "." .$file_actual_ext;
                                    $file_destination = 'prod_imgs/' .$file_name_new;
                                    move_uploaded_file($file_tmp_name, $file_destination);

                                    $sql_update_img = "UPDATE products SET prod_img = '$file_destination' WHERE prod_id = $prod_id;";
                                    if(mysqli_query($conn, $sql_update_img)){
                                    }
                                }else {
                                    $image_error = ' *Your file is too big.';
                                }
                            }else {
                                $image_error = ' *There was an error uploading your file.';
                            }
                        }else{
                            $image_error = ' *You cannot upload file of this type.';
                        }
                    }
                } 
            }
        ?>
        <h3 class="text-dark mt-3 text-center">Products</h3>
        <!-- start of container fluid -->
        <div class="container-fluid mt-3">
            <!-- start of add prod modal button -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_prod_modal">New <i class="fa-solid fa-plus"></i></button>
            <!-- end of add prod modal button -->

            <!-- start of add prod modal -->
            <div class="modal fade" id="add_prod_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add product</h1>
                            <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                        </div>
                        <!-- start of add modal form -->
                        <form action="" method="post" enctype="multipart/form-data">
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
                                                    <div class="col-md-5 col-6 mt-4">
                                                        <div class="mb-1">
                                                            <img class="text-dark border border-dark border-3" id="add_image" src="prod_imgs/prod_img_placeholder.jpg" alt="" style="width: 260px; height: 174px;">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="add_prod_img" class="form-label fs-5 ps-2">Select image</label>
                                                            <input class="form-control" type="file" id="add_prod_img" name="add_prod_img" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-7 col-6 mt-3">
                                                        <div class="col-md-12 col-6">
                                                            <div class="form-group">
                                                                <label for="add_prod_cat" class="ps-2 pb-2 fs-5">Category</label>
                                                                <select class="form-select" aria-label="Default select example" name="add_prod_cat" id="add_prod_cat" required>
                                                                    <option selected disabled>-- Select category --</option>
                                                                    <?php
                                                                        $sql_category = "SELECT * FROM category;";
                                                                        $result_category = mysqli_query($conn, $sql_category);
                                                                        if(mysqli_num_rows($result_category) > 0){
                                                                            while($row_category = mysqli_fetch_assoc($result_category)){
                                                                                $cat_id = $row_category['cat_id'];
                                                                                $cat_name = $row_category['cat_name'];
                                                                                echo '<option value="' .$cat_id. '">' .$cat_name. '</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="add_prod_name" class="ps-2 pb-2 fs-5">Product name</label>
                                                                <input type="text" class="form-control" name="add_prod_name" id="add_prod_name" value="" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 col-6 mt-3">
                                                            <div class="form-group">
                                                                <label for="add_prod_price" class="ps-2 pb-2 fs-5">Price</label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text" id="basic-addon1">₱</span>
                                                                    <input type="number" class="form-control" name="add_prod_price" id="add_prod_price" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                                    <div class="col-md-12 col-6 mt-3">
                                                        <div class="form-group">
                                                            <label for="add_prod_desc" class="ps-2 pb-2 fs-5">Product description</label>
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Leave a comment here" id="add_prod_desc" style="height: 100px" name="add_prod_desc"></textarea>
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
                                                <button type="submit" name="add" class="btn btn-success">Add</button>
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
            <!-- end of add prod modal -->

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
                                        <th class="table-light text-uppercase text-center d-none">cat id</th>
                                        <th class="table-light text-uppercase text-center">product id</th>
                                        <th class="table-light text-uppercase text-center">cat name</th>
                                        <th class="table-light text-uppercase text-center">product name</th>
                                        <th class="table-light text-uppercase text-center">product price</th>
                                        <th class="table-light text-uppercase text-center">product description</th>
                                        <th class="table-light text-uppercase text-center">prod img</th>
                                        <th class="table-light text-uppercase text-center">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                <?php
                                    $sql_select = "SELECT category.*, products.* FROM products INNER JOIN category USING (cat_id);";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if(mysqli_num_rows($result_select) > 0){
                                        while($row_select = mysqli_fetch_assoc($result_select)){
                                            $cat_id = $row_select['cat_id'];
                                            $prod_id = $row_select['prod_id'];
                                            $cat_name = $row_select['cat_name'];
                                            $prod_name = $row_select['prod_name'];
                                            $prod_price = $row_select['prod_price'];
                                            $prod_desc = $row_select['prod_desc'];
                                            $prod_img = $row_select['prod_img'];
                                ?>
                                            <tr>
                                                <td class="text-center d-none"><?= $cat_id ?></td>
                                                <td class="text-center"><?= $prod_id ?></td>
                                                <td class="text-center"><?= $cat_name ?></td>
                                                <td class="text-center"><?= $prod_name ?></td>
                                                <td class="text-center"><?= $prod_price ?></td>
                                                <td class="text-center"><?= $prod_desc ?></td>
                                                <td class="text-center"><?= $prod_img ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary view" href="#" data-bs-toggle="modal" data-bs-target="#view_prod_modal"><i class="fa-solid fa-eye"></i></a> 
                                                    <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_prod_modal"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                    <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_prod_modal"><i class="fa-solid fa-trash"></i></a>
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
                                        <td colspan="12" class="text-center">No records found.</td>
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
    <div class="modal fade" id="view_prod_modal">
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

    
    <!-- start of edit prod modal -->
    <div class="modal fade" id="edit_prod_modal">
        <!-- start of edit modal dialog -->
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <!-- start of edit modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">Edit product</h4>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <!-- end of modal header -->
                <!-- start of edit modal form -->
                <form action="includes/edit-product.inc.php" method="post" enctype="multipart/form-data">
                    <!-- start of edit modal body -->                
                    <div class="modal-body">
                        <input type="hidden" name="edit_prod_id" id="edit_prod_id">
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
                                            <div class="col-md-5 col-6 mt-4">
                                                <div class="mb-1">
                                                    <img class="text-dark border border-dark border-3" id="edit_img" src="prod_imgs/prod_img_placeholder.jpg" alt="" style="width: 260px; height: 174px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="edit_prod_img" class="form-label fs-5 ps-2">Select image</label>
                                                    <input class="form-control" type="file" id="edit_prod_img" name="edit_prod_img">
                                                </div>
                                            </div>

                                            <div class="col-md-7 col-6 mt-3">
                                                <div class="col-md-12 col-6">
                                                    <div class="form-group">
                                                        <label for="edit_prod_cat" class="ps-2 pb-2 fs-5">Category</label>
                                                        <select class="form-select" aria-label="Default select example" name="edit_prod_cat" id="edit_prod_cat" required>
                                                            <option selected disabled>-- Select category --</option>
                                                            <?php
                                                                $sql_category = "SELECT * FROM category;";
                                                                $result_category = mysqli_query($conn, $sql_category);
                                                                if(mysqli_num_rows($result_category) > 0){
                                                                    while($row_category = mysqli_fetch_assoc($result_category)){
                                                                        $cat_id = $row_category['cat_id'];
                                                                        $cat_name = $row_category['cat_name'];
                                                                        echo '<option value="' .$cat_id. '">' .$cat_name. '</option>';
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_prod_name" class="ps-2 pb-2 fs-5">Product name</label>
                                                        <input type="text" class="form-control" name="edit_prod_name" id="edit_prod_name" value="" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-6 mt-3">
                                                    <div class="form-group">
                                                        <label for="edit_prod_price" class="ps-2 pb-2 fs-5">Price</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-editon1">₱</span>
                                                            <input type="number" class="form-control" name="edit_prod_price" id="edit_prod_price" placeholder="" aria-label="" aria-describedby="basic-addon1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            <div class="col-md-12 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_prod_desc" class="ps-2 pb-2 fs-5">Product description</label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Leave a comment here" id="edit_prod_desc" style="height: 100px" name="edit_prod_desc"></textarea>
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
    <!-- end of edit prod modal -->


    <!-- start of delete prod modal -->
    <div class="modal fade" id="delete_prod_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete product</h1>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                </div>
                <!-- start of delete modal form -->
                <form action="includes/delete-product.inc.php" method="post">
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
                                                    <input type="hidden" name="delete_prod_id" id="delete_prod_id" class="form-control mb-3">
                                                    <h5 class="fs-5">Are you sure you want to delete this product?</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of delete modal row -->
                                    </div>
                                    <!-- end of delete modal card body -->
                                    <!-- start of delete modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="submit" name="delete" class="btn btn-danger">Yes</button>
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
    <!-- end of delete prod modal -->
    <?php
        require_once 'footer.php';
    ?>