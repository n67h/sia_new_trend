<?php
    session_start();
    require_once 'db.inc.php';

    if(isset($_POST['delete'])){
        $delete_cat_id = mysqli_real_escape_string($conn, $_POST['delete_cat_id']);

        $sql = "DELETE FROM category WHERE cat_id = $delete_cat_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../category.php");
            die();
        }
    }else{
        header("location: ../category.php");
        die();
    }