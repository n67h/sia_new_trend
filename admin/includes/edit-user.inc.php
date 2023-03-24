<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['edit'])){
        $edit_user_id = mysqli_real_escape_string($conn, $_POST['edit_user_id']);
        $edit_user_role = mysqli_real_escape_string($conn, $_POST['edit_user_role']);
        $edit_username = mysqli_real_escape_string($conn, $_POST['edit_username']);
        $edit_first_name = mysqli_real_escape_string($conn, $_POST['edit_first_name']);
        $edit_last_name = mysqli_real_escape_string($conn, $_POST['edit_last_name']);
        $edit_email = mysqli_real_escape_string($conn, $_POST['edit_email']);
        $edit_phone_number = mysqli_real_escape_string($conn, $_POST['edit_phone_number']);

        if($edit_user_role == 'Admin'){
            if(empty($edit_user_id) || empty($edit_username) || empty($edit_first_name) || empty($edit_last_name)){
                $error_message = "All fields are required!";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
    
                $error_redirect = '<h3 style="color: red; text-align: center;">All fields are required! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
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
                header("refresh:5;url=../user.php");
                die();
            }else{
                $sql = "UPDATE user SET username = '$edit_username' WHERE user_id = $edit_user_id;";
                if(mysqli_query($conn, $sql)){
                    // $user_id = mysqli_insert_id($conn);
                    $query = "UPDATE user_info SET email = '$edit_email', phone_number = '$edit_phone_number', first_name = '$edit_first_name', last_name = '$edit_last_name' WHERE user_id = $edit_user_id;";
                    if(mysqli_query($conn, $query)){
                        header("location: ../user.php?user=successfullyedited");
                        die();
                    }
                }else{
                    $query = "UPDATE user_info SET email = '$edit_email', phone_number = '$edit_phone_number', first_name = '$edit_first_name', last_name = '$edit_last_name' WHERE user_id = $edit_user_id;";
                    if(mysqli_query($conn, $query)){
                        header("location: ../user.php?user=successfullyedited");
                        die();
                    }
                }
            }
        }elseif($edit_user_role == 'Customer'){
            if(empty($edit_user_id) || empty($edit_username) || empty($edit_first_name) || empty($edit_last_name) || empty($edit_email)){
                $error_message = "All fields are required!";
                echo "<script type='text/javascript'>alert('$error_message');</script>";
    
                $error_redirect = '<h3 style="color: red; text-align: center;">All fields are required! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
                <script type="text/javascript">
                    function countdown() {
                        var i = document.getElementById("counter");
                        if (parseInt(i.innerHTML)<=0) {
                            location.href = "../user.php";
                        }
                        i.innerHTML = parseInt(i.innerHTML)-1;
                    }
                    setInterval(function(){ countdown(); },1000);
                </script>';
                echo $error_redirect;
                header("refresh:5;url=../user.php");
                die();
            }else{
                $sql = "UPDATE user SET username = '$edit_username' WHERE user_id = $edit_user_id;";
                if(mysqli_query($conn, $sql)){
                    // $user_id = mysqli_insert_id($conn);
                    $query = "UPDATE user_info SET email = '$edit_email', phone_number = '$edit_phone_number', first_name = '$edit_first_name', last_name = '$edit_last_name' WHERE user_id = $edit_user_id;";
                    if(mysqli_query($conn, $query)){
                        header("location: ../user.php?user=successfullyedited");
                        die();
                    }
                }else{
                    $query = "UPDATE user_info SET email = '$edit_email', phone_number = '$edit_phone_number', first_name = '$edit_first_name', last_name = '$edit_last_name' WHERE user_id = $edit_user_id;";
                    if(mysqli_query($conn, $query)){
                        header("location: ../user.php?user=successfullyedited");
                        die();
                    }
                }
            }
        }
    }else{
        header("location: ../user.php");
        die();
    }