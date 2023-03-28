<!-- start of edit prod modal -->
<div class="modal fade" id="edit_prod_modal<?= $prod_id ?>">
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
            <form action="includes/edit-product.inc.php?cat_id=<?= $category_id ?>" method="post" enctype="multipart/form-data">
                <!-- start of edit modal body -->                
                <div class="modal-body">
                    <input type="hidden" name="edit_prod_id" id="edit_prod_id" value="<?= $prod_id ?>">
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
                                                <img class="text-dark border border-dark border-3" id="edit_img" src="<?= $prod_img ?>" alt="" style="width: 260px; height: 174px;">
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
                                                        <?php
                                                            echo '<option value="' .$cat_id. '" selected>' .$cat_name. '</option>';
                                                            
                                                            $sql_category = "SELECT * FROM category WHERE cat_id != $cat_id;";
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
                                                    <input type="text" class="form-control" name="edit_prod_name" id="edit_prod_name" value="<?= $prod_name ?>" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_prod_price" class="ps-2 pb-2 fs-5">Price</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-editon1">₱</span>
                                                        <input type="number" class="form-control" name="edit_prod_price" id="edit_prod_price" placeholder="" aria-label="" aria-describedby="basic-addon1" value="<?= $prod_price ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="col-md-12 col-6 mt-3">
                                            <div class="form-group">
                                                <label for="edit_prod_desc" class="ps-2 pb-2 fs-5">Product description</label>
                                                <div class="form-floating">
                                                    <textarea class="form-control" placeholder="Leave a comment here" id="edit_prod_desc" style="height: 100px" name="edit_prod_desc" value="" required><?= $prod_desc ?></textarea>
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