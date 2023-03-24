<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['delete'])){
        $delete_user_id = mysqli_real_escape_string($conn, $_POST['delete_user_id']);

        $sql = "UPDATE user SET is_deleted = 1 WHERE user_id = $delete_user_id;";
        if(mysqli_query($conn, $sql)){
            // $user_id = mysqli_insert_id($conn);
            $query = "UPDATE user_info SET is_deleted = 1 WHERE user_id = $delete_user_id";
            if(mysqli_query($conn, $query)){
                header("location: ../user.php");
                die();
            }
        }

    }else{
        header("location: ../user.php");
        die();
    }