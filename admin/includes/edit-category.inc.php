<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['edit'])){
        $edit_category_id = mysqli_real_escape_string($conn, $_POST['edit_category_id']);
        $edit_category = mysqli_real_escape_string($conn, $_POST['edit_category']);
        
        if(empty($edit_category)){
            $error_message = "Category is required!";
            echo "<script type='text/javascript'>alert('$error_message');</script>";

            $error_redirect = '<h3 style="color: red; text-align: center;">Category is  required! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
            <script type="text/javascript">
                function countdown() {
                    var i = document.getElementById("counter");
                    if (parseInt(i.innerHTML)<=0) {
                        location.href = "../service.php";
                    }
                    i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
            </script>';
            echo $error_redirect;
            header("refresh:5;url=../category.php");
            die();
        }else{
            $sql = "UPDATE category SET category = '$edit_category' WHERE category_id = $edit_category_id;";
            if(mysqli_query($conn, $sql)){
                header("location: ../category.php");
                die();
            }
        }
    }else{
        header("location: ../category.php");
        die();
    }