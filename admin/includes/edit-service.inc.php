<?php
    session_start();
    require_once '../../includes/db.inc.php';

    if(isset($_POST['edit'])){
        $edit_service_id = mysqli_real_escape_string($conn, $_POST['edit_service_id']);
        $edit_service = mysqli_real_escape_string($conn, $_POST['edit_service']);
        $edit_description = mysqli_real_escape_string($conn, $_POST['edit_description']);
        $edit_price = mysqli_real_escape_string($conn, $_POST['edit_price']);

        if(empty($edit_service) || empty($edit_description) || empty($edit_price)){
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
            header("refresh:5;url=../service.php");
            die();
        }else{
            $sql = "UPDATE service SET service = '$edit_service', description = '$edit_description', price = '$edit_price' WHERE service_id = $edit_service_id;";
            if(mysqli_query($conn, $sql)){
                header("location: ../service.php");
                die();
            }
        }
    }else{
        header("location: ../service.php");
        die();
    }