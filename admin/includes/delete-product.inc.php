<?php
    session_start();
    require_once 'db.inc.php';

    if(isset($_GET['cat_id'])){
        $category_id = $_GET['cat_id'];
    }

    if(isset($_POST['delete'])){
        $delete_prod_id = mysqli_real_escape_string($conn, $_POST['delete_prod_id']);
        $delete_prod_img = mysqli_real_escape_string($conn, $_POST['delete_prod_img']);
        
        $sql = "DELETE FROM products WHERE prod_id = $delete_prod_id;";
        if(mysqli_query($conn, $sql)){
            if(array_key_exists('delete_prod_img', $_POST)) {
                $filename = '../' .$delete_prod_img;
                if(file_exists($filename)) {
                    unlink($filename);
                    header("location: ../product.php?cat_id=" .$category_id);
                    die();
                } else {
                    
                }
            }
        }
    }else{
        header("location: ../product.php?cat_id=0");
        die();
    }