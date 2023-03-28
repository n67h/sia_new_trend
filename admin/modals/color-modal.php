<!-- start of prod color modal -->
<div class="modal fade" id="color_modal<?= $prod_id ?>">
    <!-- start of view modal dialog -->
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <!-- start of view modal content -->
        <div class="modal-content">
            <!-- start of modal header -->
            <div class="modal-header bg-dark border-0">
                <h4 class="modal-title text-white">Product colors</h4>
                <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                </button>
            </div>
            <!-- end of modal header -->
            <!-- start of view modal form -->
            <form action="" method="post" enctype="multipart/form-data">
                <!-- start of view modal body -->                
                <div class="modal-body">
                    <input type="hidden" name="view_prod_id" id="view_prod_id">
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
                                            <div class="col-md-12 col-6 fs-6">
                                                <!-- start of add color modal button -->
                                                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#add_color_modal">New <i class="fa-solid fa-plus"></i></button>
                                                <!-- end of add color modal button -->
                                                
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
                                                                            <!-- btn for size modal -->
                                                                            <a class="btn btn-sm btn-secondary size" href="#" data-bs-toggle="modal" data-bs-target="#size_modal"><i class="fa-solid fa-chart-simple"></i></a> 
                                                                            <?php
                                                                                // require 'modals/size-modal.php';
                                                                            ?>
                                                                            <!-- btn for delete color modal -->
                                                                            <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_color_modal<?= $prod_id ?>"><i class="fa-solid fa-trash"></i></a>
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
                                        </div>
                                    </div>
                                    <!-- end of view modal row -->
                                </div>
                                <!-- end of view modal card body -->
                                <!-- start of view modal footer -->
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Save changes</button>
                                    <!-- <button type="button" class="btn btn-danger" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Next</button> -->
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
<!-- end of prod color modal -->

<!-- start of add color modal -->
<div class="modal fade" id="add_color_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>
<!-- end of add color modal -->


<!-- start of size modal -->
<div class="modal fade" id="size_modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            ...
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
</div>
<!-- end of size modal -->