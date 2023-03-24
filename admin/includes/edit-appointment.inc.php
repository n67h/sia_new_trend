<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['edit'])){
        $edit_appointment_id = mysqli_real_escape_string($conn, $_POST['edit_appointment_id']);
        $edit_status = mysqli_real_escape_string($conn, $_POST['edit_status']);

        
        $sql = "UPDATE appointment SET status = '$edit_status' WHERE appointment_id = $edit_appointment_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../appointment.php");
            die();
        }
    }else{
        header("location: ../appointment.php");
        die();
    }