<?php
    session_start();
    require_once 'db.inc.php';

    if(isset($_GET['cat_id'])){
        $category_id = $_GET['cat_id'];
    }
    
    if(isset($_POST['edit'])){
        $edit_prod_id = mysqli_real_escape_string($conn, $_POST['edit_prod_id']);
        $edit_prod_cat = mysqli_real_escape_string($conn, $_POST['edit_prod_cat']);
        $edit_prod_name = mysqli_real_escape_string($conn, $_POST['edit_prod_name']);
        $edit_prod_price = mysqli_real_escape_string($conn, $_POST['edit_prod_price']);
        $edit_prod_desc = mysqli_real_escape_string($conn, $_POST['edit_prod_desc']);

        //validate product image
        $file = $_FILES['edit_prod_img'];
        $file_name = $_FILES['edit_prod_img']['name'];
        $file_tmp_name = $_FILES['edit_prod_img']['tmp_name'];
        $file_size = $_FILES['edit_prod_img']['size'];
        $file_error = $_FILES['edit_prod_img']['error'];
        $file_type = $_FILES['edit_prod_img']['type'];
        
        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext));

        $allowed = array('jpg', 'jpeg', 'png',);

        if(empty($edit_prod_cat) || empty($edit_prod_name) || empty($edit_prod_price) || empty($edit_prod_desc)){
            $error_message = "All fields are required!";
            echo "<script type='text/javascript'>alert('$error_message');</script>";

            $error_redirect = '<h3 style="color: red; text-align: center;">All fields are required! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
            <script type="text/javascript">
                function countdown() {
                    var i = document.getElementById("counter");
                    if (parseInt(i.innerHTML)<=0) {
                        location.href = "../product.php?cat_id=' .$category_id. '";
                    }
                    i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
            </script>';
            echo $error_redirect;
            header("refresh:5;url=../product.php?cat_id=" .$category_id);
            die();
        }elseif($_FILES["edit_prod_img"]["error"] == 4){
            $sql = "UPDATE products SET cat_id = $edit_prod_cat, prod_name = '$edit_prod_name', prod_price = $edit_prod_price, prod_desc = '$edit_prod_desc' WHERE prod_id = $edit_prod_id;";
            if(mysqli_query($conn, $sql)){
                header("location: ../product.php?cat_id=" .$category_id);
                die();
            }
        }else{
            if(in_array($file_actual_ext, $allowed)) {
                if($file_error === 0) {
                    if($file_size < 5000000) {
                        $file_name_new = $edit_prod_id. "." .$file_actual_ext;
                        $file_path = '../prod_imgs/' .$file_name_new;
                        $file_destination = 'prod_imgs/' .$file_name_new;
                        move_uploaded_file($file_tmp_name, $file_path);

                        $sql = "UPDATE products SET cat_id = $edit_prod_cat, prod_name = '$edit_prod_name', prod_price = $edit_prod_price, prod_desc = '$edit_prod_desc', prod_img = '$file_destination' WHERE prod_id = $edit_prod_id;";
                        if(mysqli_query($conn, $sql)){
                            header("location: ../product.php?cat_id=" .$category_id);
                            die();
                        }
                    }else {
                        $image_error = ' *Your file is too big.';
                    }
                }else {
                    $image_error = ' *There was an error uploading your file.';
                }
            }else{
                $image_error = ' *You cannot upload file of this type.';
            }
        }
    }else{
        header("location: ../product.php?cat_id=0");
        die();
    }