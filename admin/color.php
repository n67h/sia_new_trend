<?php
    if(isset($_GET['prod_id'])){
        $prod_id = $_GET['prod_id'];
    }else{
        $prod_id = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colors</title>
    <?php
        require_once 'sidebar.php';
    ?>
    <!-- start of first container -->
    <div class="container ms-5">
        <?php
            if(isset($_POST['add'])){
                $add_color = mysqli_real_escape_string($conn, $_POST['add_color']);
                
                if(empty($add_color)){
                    $error_message = "Color is required!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }else{
                    $sql = "INSERT INTO color (prod_id, color) VALUES ($prod_id, '$add_color');";
    
                    if(mysqli_query($conn, $sql)){
                    }
                }
            }
        ?>
        <?php
            $sql = "SELECT prod_name FROM products WHERE prod_id = $prod_id;";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $prod_name = $row['prod_name'];
            }else{
                $prod_name = 'Product color';
            }
        ?>
        <h3 class="text-dark mt-3 text-center"><?= $prod_name ?></h3>
        <!-- start of container fluid -->
        <div class="container-fluid mt-3">
            <div class="d-flex flex-row">
                <!-- start of button to products -->
                <a class="btn btn-secondary mb-3" href="product.php?cat_id=0" role="button">Go back</a>
                <!-- end of button to products -->

                <!-- start of add color modal button -->
                <button type="button" class="btn btn-primary mb-3 ms-3" data-bs-toggle="modal" data-bs-target="#add_color_modal">New <i class="fa-solid fa-plus"></i></button>
                <!-- end of add color modal button -->


                <!-- start of add color modal -->
                <div class="modal fade" id="add_color_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add color</h1>
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
                                                        <div class="col-md-12 col-6 mt-3 mb-5">
                                                            <div class="form-group">
                                                                <label for="add_color" class="ps-2 pb-2 fs-5">Color</label>
                                                                <input type="text" class="form-control" name="add_color" id="add_color" value="" required>
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
                <!-- end of add color modal -->
            </div>
            <!-- start of first row -->
            <div class="row">
                <!-- start of second container -->
                <div class="container">
                    <!-- start of second row -->
                    <div class="row">
                        <!-- start of div on center -->
                        <div class="col-md-12">
                            <!-- start of table -->
                            <table class="table table-bordered table-striped" id="datatable_color">
                                <!-- start of table header -->
                                <thead>
                                    <tr>
                                        <th class="table-light text-uppercase text-center">color id</th>
                                        <th class="table-light text-uppercase text-center">color</th>
                                        <th class="table-light text-uppercase text-center">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                    <?php
                                        $sql_select_color = "SELECT * FROM color WHERE prod_id = $prod_id;";
                                        $result_select_color = mysqli_query($conn, $sql_select_color);
                                        if(mysqli_num_rows($result_select_color) > 0){
                                            while($row_select_color = mysqli_fetch_assoc($result_select_color)){
                                                $col_id = $row_select_color['col_id'];
                                                $color = $row_select_color['color'];
                                    ?>
                                                <tr>
                                                    <td class="text-center"><?= $col_id ?></td>
                                                    <td class="text-center"><?= $color ?></td>
                                                    <td class="text-center">
                                                        <!-- btn for edit color modal -->
                                                        <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_color_modal<?= $col_id ?>"><i class="fa-solid fa-pen-to-square"></i></a> 
                                                        <?php
                                                            require 'modals/edit-color.modal.php';
                                                        ?>
                                                        <!-- btn for color size modal -->
                                                        <a class="btn btn-sm btn-secondary size" href="size.php?col_id=<?= $col_id ?>"><i class="fa-solid fa-chart-simple"></i></a>
                                                        <!-- btn for delete color modal -->
                                                        <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_color_modal<?= $col_id ?>"><i class="fa-solid fa-trash"></i></a>
                                                        <?php
                                                            require 'modals/delete-color.modal.php';
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
                                                <td colspan="3" class="text-center">No records found.</td>
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