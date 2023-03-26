<?php
    session_start();
    require_once 'db.inc.php';

    if(isset($_POST['delete'])){
        $delete_prod_id = mysqli_real_escape_string($conn, $_POST['delete_prod_id']);

        $sql = "DELETE FROM products WHERE prod_id = $delete_prod_id;";
        if(mysqli_query($conn, $sql)){
            header("location: ../product.php");
            die();
        }

    }else{
        header("location: ../product.php");
        die();
    }