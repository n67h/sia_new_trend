<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['delete'])){
        $delete_service_id = mysqli_real_escape_string($conn, $_POST['delete_service_id']);

        $sql = "UPDATE service SET is_deleted = 1 WHERE service_id = $delete_service_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../service.php");
            die();
        }

    }else{
        header("location: ../service.php");
        die();
    }