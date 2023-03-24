<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['delete'])){
        $delete_appointment_id = mysqli_real_escape_string($conn, $_POST['delete_appointment_id']);

        $sql = "UPDATE appointment SET is_deleted = 1 WHERE appointment_id = $delete_appointment_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../appointment.php");
            die();
        }

    }else{
        header("location: ../appointment.php");
        die();
    }