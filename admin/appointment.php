<?php
    require_once '../includes/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <?php
        require_once 'sidebar.php';
    ?>
    <!-- start of first container -->
    <div class="container ms-5">
        <h3 class="text-dark mt-3 text-center">Appointments</h3>
        <!-- start of container fluid -->
        <div class="container-fluid mt-3">
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
                                        <th class="table-light text-uppercase">appointment id</th>
                                        <th class="table-light text-uppercase">user id</th>
                                        <th class="table-light text-uppercase d-none">email</th>
                                        <th class="table-light text-uppercase d-none">phone number</th>
                                        <th class="table-light text-uppercase d-none">first name</th>
                                        <th class="table-light text-uppercase d-none">last name</th>
                                        <th class="table-light text-uppercase">pet name</th>
                                        <th class="table-light text-uppercase">category</th>
                                        <th class="table-light text-uppercase">birthdate</th>
                                        <th class="table-light text-uppercase">gender</th>
                                        <th class="table-light text-uppercase">service</th>
                                        <th class="table-light text-uppercase">date</th>
                                        <th class="table-light text-uppercase">timeslot</th>
                                        <th class="table-light text-uppercase">status</th>
                                        <th class="table-light text-uppercase">date added</th>
                                        <th class="table-light text-uppercase">last updated</th>
                                        <th class="table-light text-uppercase">action</th>
                                    </tr>
                                </thead>
                                <!-- end of table header -->
                                <!-- start of table body -->
                                <tbody>
                                <?php
                                    $sql_select = "SELECT user_info.user_id, user_info.email, user_info.phone_number, user_info.first_name, user_info.last_name, category.category_id, category.category, appointment.appointment_id, appointment.pet_name, appointment.category_id, appointment.birthdate, appointment.gender, appointment.service_id, appointment.date, appointment.timeslot, appointment.status, appointment.date_added, appointment.last_updated, service.service_id, service.service FROM category INNER JOIN appointment USING (category_id) INNER JOIN service USING (service_id) INNER JOIN user_info USING (user_id) WHERE appointment.is_deleted != 1 ORDER BY appointment.appointment_id DESC";
                                    $result_select = mysqli_query($conn, $sql_select);
                                    if(mysqli_num_rows($result_select) > 0){
                                        while($row_select = mysqli_fetch_assoc($result_select)){
                                            $appointment_id = $row_select['appointment_id'];
                                            $user_id = $row_select['user_id'];
                                            $email = $row_select['email'];
                                            $phone_number = $row_select['phone_number'];
                                            $first_name = $row_select['first_name'];
                                            $last_name = $row_select['last_name'];
                                            $pet_name = $row_select['pet_name'];
                                            $category = $row_select['category'];
                                            $birthdate = $row_select['birthdate'];
                                            $gender = $row_select['gender'];
                                            $service = $row_select['service'];
                                            $date = $row_select['date'];
                                            $timeslot = $row_select['timeslot'];
                                            $status = $row_select['status'];
                                            $appointment_date_added = $row_select['date_added'];
                                            $appointment_last_updated = $row_select['last_updated'];

                                            if($status == 0){
                                                $status = 'Waiting';
                                            }elseif($status == 1){
                                                $status = 'Completed';
                                            }elseif($status == 2){
                                                $status = 'Canceled';
                                            }
                                ?>
                                            <tr>
                                                <td class="text-center"><?= $appointment_id ?></td>
                                                <td class="text-center"><?= $user_id ?></td>
                                                <td class="text-center d-none"><?= $email ?></td>
                                                <td class="text-center d-none"><?= $phone_number ?></td>
                                                <td class="text-center d-none"><?= $first_name ?></td>
                                                <td class="text-center d-none"><?= $last_name ?></td>
                                                <td class="text-center"><?= $pet_name ?></td>
                                                <td class="text-center"><?= $category ?></td>
                                                <td class="text-center"><?= $birthdate ?></td>
                                                <td class="text-center"><?= $gender ?></td>
                                                <td class="text-center"><?= $service ?></td>
                                                <td class="text-center"><?= $date ?></td>
                                                <td class="text-center"><?= $timeslot ?></td>
                                                <td class="text-center"><?= $status ?></td>
                                                <td class="text-center"><?= $appointment_date_added ?></td>
                                                <td class="text-center"><?= $appointment_last_updated ?></td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary view" href="#" data-bs-toggle="modal" data-bs-target="#view_appointment_modal"><i class="fa-solid fa-eye"></i></a> 
                                                    <a class="btn btn-sm btn-success edit" href="#" data-bs-toggle="modal" data-bs-target="#edit_appointment_modal"><i class="fa-solid fa-pen-to-square"></i></a>  
                                                    <a class="btn btn-sm btn-danger delete" href="#" data-bs-toggle="modal" data-bs-target="#delete_appointment_modal"><i class="fa-solid fa-trash"></i></a>
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
    <div class="modal fade" id="view_appointment_modal">
        <!-- start of view modal dialog -->
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- start of view modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">View appointment</h4>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <!-- end of modal header -->
                <!-- start of view modal form -->
                <form action="" method="post">
                    <!-- start of view modal body -->                
                    <div class="modal-body">
                        <input type="hidden" name="view_appointment_id" id="view_appointment_id">
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
                                            <h4 class="ps-4">Customer details</h4>
                                            <hr class="ms-3" style="width: 96%;">
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_first_name" class="ps-2 pb-2">First name</label>
                                                    <input type="text" class="form-control" name="view_first_name" id="view_first_name" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_last_name" class="ps-2 pb-2">Last name</label>
                                                    <input type="text" class="form-control" name="view_last_name" id="view_last_name" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_email" class="ps-2 pb-2">Email</label>
                                                    <input type="text" class="form-control" name="view_email" id="view_email" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_phone_number" class="ps-2 pb-2">Contact number</label>
                                                    <input type="text" class="form-control" name="view_phone_number" id="view_phone_number" value="" disabled>
                                                </div>
                                            </div>

                                            <h4 class="ps-4 mt-5">Pet details</h4>
                                            <hr class="ms-3" style="width: 96%;">

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_pet_name" class="ps-2 pb-2">Name of pet</label>
                                                    <input type="text" class="form-control" name="view_pet_name" id="view_pet_name" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_category" class="ps-2 pb-2">Species</label>
                                                    <input type="text" class="form-control" name="view_category" id="view_category" value="" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_birthdate" class="ps-2 pb-2">Birthdate</label>
                                                    <input type="text" class="form-control" name="view_birthdate" id="view_birthdate" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_gender" class="ps-2 pb-2">Gender</label>
                                                    <input type="text" class="form-control" name="view_gender" id="view_gender" value="" disabled>
                                                </div>
                                            </div>

                                            <h4 class="ps-4 mt-5">Appointment details</h4>
                                            <hr class="ms-3" style="width: 96%;">

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_service" class="ps-2 pb-2">Service</label>
                                                    <input type="text" class="form-control" name="view_service" id="view_service" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_date" class="ps-2 pb-2">Appointment date</label>
                                                    <input type="text" class="form-control" name="view_date" id="view_date" value="" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_timeslot" class="ps-2 pb-2">Timeslot</label>
                                                    <input type="text" class="form-control" name="view_timeslot" id="view_timeslot" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_status" class="ps-2 pb-2">Status</label>
                                                    <input type="text" class="form-control" name="view_status" id="view_status" value="" disabled>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_appointment_date_added" class="ps-2 pb-2">Date added</label>
                                                    <input type="text" class="form-control" name="view_appointment_date_added" id="view_appointment_date_added" value="" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="view_appointment_last_updated" class="ps-2 pb-2">Last updated</label>
                                                    <input type="text" class="form-control" name="view_appointment_last_updated" id="view_appointment_last_updated" value="" disabled>
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

    <!-- start of edit appointment modal -->
    <div class="modal fade" id="edit_appointment_modal">
        <!-- start of edit modal dialog -->
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <!-- start of edit modal content -->
            <div class="modal-content">
                <!-- start of modal header -->
                <div class="modal-header bg-dark border-0">
                    <h4 class="modal-title text-white">Edit appointment</h4>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <!-- end of modal header -->
                <!-- start of edit modal form -->
                <form action="includes/edit-appointment.inc.php" method="post">
                    <!-- start of edit modal body -->                
                    <div class="modal-body">
                        <input type="hidden" name="edit_appointment_id" id="edit_appointment_id">
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
                                            <h4 class="ps-4 mt-5">Appointment details</h4>
                                            <hr class="ms-3" style="width: 96%;">

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_service" class="ps-2 pb-2">Service</label>
                                                    <input type="text" class="form-control" name="edit_service" id="edit_service" value="" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_date" class="ps-2 pb-2">Appointment date</label>
                                                    <input type="date" class="form-control" name="edit_date" id="edit_date" value="" readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_timeslot" class="ps-2 pb-2">Timeslot</label>
                                                    <input type="text" class="form-control" name="edit_timeslot" id="edit_timeslot" value="" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 mt-3">
                                                <div class="form-group">
                                                    <label for="edit_status" class="ps-2 pb-2">Status</label>
                                                    <select class="form-select" aria-label="Default select example" name="edit_status" id="edit_status" required>
                                                        <option selected value="0">Waiting</option>
                                                        <option value="1">Completed</option>
                                                        <option value="2">Canceled</option>
                                                    </select>
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
    <!-- end of edit appointment modal -->

    <!-- start of delete appointment modal -->
    <div class="modal fade" id="delete_service_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete appointment</h1>
                    <button type="button" class="btn btn-danger close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span></button>
                </div>
                <!-- start of delete modal form -->
                <form action="includes/delete-appointment.inc.php" method="post">
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
                                                    <input type="hidden" name="delete_appointment_id" id="delete_appointment_id" class="form-control mb-3">
                                                    <h3>Are you sure you want to delete this data?</h3>
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
    <!-- end of delete appointment modal -->
    <?php
        require_once 'footer.php';
    ?>