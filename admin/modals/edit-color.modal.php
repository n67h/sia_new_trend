<!-- start of edit color modal -->
<div class="modal fade" id="edit_color_modal<?= $col_id ?>">
    <!-- start of edit modal dialog -->
    <div class="modal-dialog modal-dialog-centered">
        <!-- start of edit modal content -->
        <div class="modal-content">
            <!-- start of modal header -->
            <div class="modal-header bg-dark border-0">
                <h4 class="modal-title text-white">Edit color</h4>
                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
            <!-- end of modal header -->
            <!-- start of edit modal form -->
            <form action="includes/edit-color.inc.php?prod_id=<?= $prod_id ?>" method="post">
                <!-- start of edit modal body -->                
                <div class="modal-body">
                    <input type="hidden" name="edit_col_id" id="edit_col_id" value="<?= $col_id ?>">
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
                                            <div class="form-group text-start">
                                                <label for="edit_color<?= $col_id ?>" class="ps-2 pb-2 fs-5">Color</label>
                                                <input type="text" class="form-control" name="edit_color" id="edit_color<?= $col_id ?>" value="<?= $color ?>" required>
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
<!-- end of edit color modal -->