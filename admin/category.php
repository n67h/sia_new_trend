<?php
    require_once '../includes/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <?php
        require_once 'sidebar.php';
    ?>
    <!-- start of first container -->
    <div class="container ms-5">
        <?php
            if(isset($_POST['add'])){
                $add_category = mysqli_real_escape_string($conn, $_POST['add_category']);
                
                if(empty($add_category)){
                    $error_message = "Category is required!";
                    echo "<script type='text/javascript'>alert('$error_message');</script>";
                }else{
                    $sql = "INSERT INTO category (category) VALUES ('$add_category');";
    
                    if(mysqli_query($conn, $sql)){
                    }
                }
            }
        ?>
        <h3 class="text-dark mt-3 text-center">Categories</h3>
        <!-- start of container fluid -->
        <div class="container-fluid mt-3">
            <!-- start of add category modal button -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_category_modal">Add category</button>
            <!-- end of add category modal button -->

            <!-- start of add category modal -->
            <div class="modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add category</h1>
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
                                                            <label for="add_category" class="ps-2 pb-2">Category</label>
                                                            <input type="text" class="form-control" name="add_category" id="add_category" value="" required>
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
            <!-- end of add category modal -->

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
                                        <th class="table-light text-uppercase">category id</th>
                                        <th class="table-light text-uppercase">category</th>
                                        <th class="table-light text-uppercase">date added</th>
                                        <th class="table-light text-uppercase">last updated</th>
                                        <th class="table-light text-uppercase">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                <?php
                                    $sql_select = "SELECT * FROM category WHERE is_deleted != 1 ORDER BY category_id DESC;";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if(mysqli_num_rows($result_select) > 0){
                                        while($row_select = mysqli_fetch_assoc($result_select)){
                                            $category_id = $row_select['category_id'];
                                            $category = $row_select['category'];
                                            $category_date_added = $row_select['date_added'];
                                            $category_last_updated = $row_select['last_updated'];
                                ?>
                                            <tr>
                                                <td class="text-center"><?= $category_id ?></td>
                                                <td class="text-center"><?= $category ?></td>
                                                <td class="text-center"><?= $category_date_added ?></td>
                                                <td class="text-center"><?= $category_last_updated ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary view" href="#" data-bs-toggle="modal" data-bs-target="#view_category_modal"><i class="fa-solid fa-eye"></i></a> 
                                                    <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_category_modal"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                    <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_category_modal"><i class="fa-solid fa-trash"></i></a>
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
    <div class="modal fade" id="view_category_modal">
        <!-- start of view modal dialog -->
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- start of view modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">View category</h4>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <!-- end of modal header -->
                <!-- start of view modal form -->
                <form action="" method="post">
                    <!-- start of view modal body -->                
                    <div class="modal-body">
                        <input type="hidden" name="view_category_id" id="view_category_id">
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
                                            <div class="col-md-12 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_category" class="ps-2 pb-2">Category</label>
                                                    <input type="text" class="form-control" name="view_category" id="view_category" value="" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_category_date_added" class="ps-2 pb-2">Date added</label>
                                                    <input type="text" class="form-control" name="view_category_date_added" id="view_category_date_added" value="" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3 mb-5">
                                                <div class="form-group">
                                                    <label for="view_category_last_updated" class="ps-2 pb-2">Last updated</label>
                                                    <input type="text" class="form-control" name="view_category_last_updated" id="view_category_last_updated" value="" disabled>
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

    <!-- start of edit category modal -->
    <div class="modal fade" id="edit_category_modal">
        <!-- start of edit modal dialog -->
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- start of edit modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">Edit category</h4>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <!-- end of modal header -->
                <!-- start of edit modal form -->
                <form action="includes/edit-category.inc.php" method="post">
                    <!-- start of edit modal body -->                
                    <div class="modal-body">
                        <input type="hidden" name="edit_category_id" id="edit_category_id">
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
                                            <div class="col-md-12 col-6 mt-3 mb-5">
                                                <div class="form-group">
                                                    <label for="edit_category" class="ps-2 pb-2">Category</label>
                                                    <input type="text" class="form-control" name="edit_category" id="edit_category" value="" required>
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
    <!-- end of edit category modal -->

    <!-- start of delete category modal -->
    <div class="modal fade" id="delete_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete category</h1>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                </div>
                <!-- start of delete modal form -->
                <form action="includes/delete-category.inc.php" method="post">
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
                                                    <input type="hidden" name="delete_category_id" id="delete_category_id" class="form-control mb-3">
                                                    <h3>Are you sure you want to delete this category?</h3>
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
    <!-- end of delete category modal -->
    <?php
        require_once 'footer.php';
    ?>