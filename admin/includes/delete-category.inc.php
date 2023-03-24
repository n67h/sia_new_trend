<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['delete'])){
        $delete_category_id = mysqli_real_escape_string($conn, $_POST['delete_category_id']);

        $sql = "UPDATE category SET is_deleted = 1 WHERE category_id = $delete_category_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../category.php");
            die();
        }

    }else{
        header("location: ../category.php");
        die();
    }