<?php
    session_start();
    require_once 'db.inc.php';

    if(isset($_GET['prod_id'])){
        $prod_id = $_GET['prod_id'];
    }

    if(isset($_POST['delete'])){
        $delete_col_id = mysqli_real_escape_string($conn, $_POST['delete_col_id']);

        $sql = "DELETE FROM color WHERE col_id = $delete_col_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../color.php?prod_id=" .$prod_id);
            die();
        }
    }else{
        header("location: ../color.php?prod_id=0");
        die();
    }