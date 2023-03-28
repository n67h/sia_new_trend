<?php
    if(isset($_GET['cat_id'])){
        $category_id = $_GET['cat_id'];
    }
?>
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
            <div class="d-flex flex-row">
                    <!-- start of add prod modal button -->
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_prod_modal">New <i class="fa-solid fa-plus"></i></button>
                    <!-- end of add prod modal button -->
    
                    <!-- start of category dropdown -->
                    <div class="dropdown ms-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Sort by category</button>
                        <ul class="dropdown-menu">
                            <li class=""><a class="dropdown-item text-dark sort-category" href="product.php?cat_id=0">All</a></li>
                            <?php
                                $query = "SELECT * FROM category;";
                                $result = mysqli_query($conn, $query);
                                if(mysqli_num_rows($result) > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $sort_cat_id = $row['cat_id'];
                                        $sort_cat_name = $row['cat_name'];
                                        echo '<li class=""><a class="dropdown-item text-dark sort-category" href="product.php?cat_id=' .$sort_cat_id. '">' .$sort_cat_name. '</a></li>';
                                    }
                                }else{
                                    echo '<li class=""><a class="dropdown-item text-dark sort-category" href="#">No categories found</a></li>';
                                }
                            ?>
                            <!-- <li class=""><a class="dropdown-item text-dark sort-category" href="#">Action</a></li> -->
                            <!-- <li class=""><a class="dropdown-item text-dark sort-category" href="#">Another action</a></li> -->
                            <!-- <li class=""><a class="dropdown-item text-dark sort-category" href="#">Something else here</a></li> -->
                        </ul>
                    </div>
                    <!-- end of category dropdown -->
            </div>

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
                                        <th class="table-light text-uppercase text-center">cat id</th>
                                        <th class="table-light text-uppercase text-center">product id</th>
                                        <th class="table-light text-uppercase text-center">category</th>
                                        <th class="table-light text-uppercase text-center">product</th>
                                        <th class="table-light text-uppercase text-center">price</th>
                                        <th class="table-light text-uppercase text-center">description</th>
                                        <th class="table-light text-uppercase text-center d-none">prod img</th>
                                        <th class="table-light text-uppercase text-center">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                <?php
                                    if($category_id == 0){
                                        $sql_select = "SELECT category.*, products.* FROM products INNER JOIN category USING (cat_id);";
                                    }else{
                                        $sql_select = "SELECT category.*, products.* FROM products INNER JOIN category USING (cat_id) WHERE category.cat_id = $category_id;";
                                    }
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
                                                <td class="text-center"><?= $cat_id ?></td>
                                                <td class="text-center"><?= $prod_id ?></td>
                                                <td class="text-center"><?= $cat_name ?></td>
                                                <td class="text-center"><?= $prod_name ?></td>
                                                <td class="text-center">₱<?= number_format($prod_price, 2, '.', ',') ?></td>
                                                <td class="text-center"><?= $prod_desc ?></td>
                                                <td class="text-center d-none"><?= $prod_img ?></td>
                                                <td class="">
                                                    <!-- btn for edit prod modal -->
                                                    <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_prod_modal<?= $prod_id ?>"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                    <?php
                                                        require 'modals/edit-product-modal.php';
                                                    ?>
                                                    <!-- btn for prod color modal -->
                                                    <a class="btn btn-sm btn-primary color" href="#" data-bs-toggle="modal" data-bs-target="#color_modal<?= $prod_id ?>"><i class="fa-solid fa-palette"></i></a> 
                                                    <?php
                                                        require 'modals/color-modal.php';
                                                    ?>
                                                    <!-- btn for delete prod modal -->
                                                    <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_prod_modal<?= $prod_id ?>"><i class="fa-solid fa-trash"></i></a>
                                                    <?php
                                                        require 'modals/delete-product-modal.php';
                                                    ?>
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
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="" class="text-center d-none"></td>
                                        <td colspan="8" class="text-center">No records found.</td>
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
    <?php
        require_once 'footer.php';
    ?>