<?php
    session_start();
    require_once 'db.inc.php';

    if(isset($_GET['prod_id'])){
        $prod_id = $_GET['prod_id'];
    }

    if(isset($_POST['edit'])){
        $edit_col_id = mysqli_real_escape_string($conn, $_POST['edit_col_id']);
        $edit_color = mysqli_real_escape_string($conn, $_POST['edit_color']);
        
        if(empty($edit_color)){
            $error_message = "Color is required!";
            echo "<script type='text/javascript'>alert('$error_message');</script>";

            $error_redirect = '<h3 style="color: red; text-align: center;">Color is required! You will be redirected to previous page in <span id="counter">5</span> second(s).</h3>
            <script type="text/javascript">
                function countdown() {
                    var i = document.getElementById("counter");
                    if (parseInt(i.innerHTML)<=0) {
                        location.href = "../color.php?prod_id=' .$prod_id. '";
                    }
                    i.innerHTML = parseInt(i.innerHTML)-1;
                }
                setInterval(function(){ countdown(); },1000);
            </script>';
            echo $error_redirect;
            header("refresh:5;url=../color.php?prod_id=" .$prod_id);
            die();
        }else{
            $sql = "UPDATE color SET color = '$edit_color' WHERE col_id = $edit_col_id;";
            if(mysqli_query($conn, $sql)){
                header("location: ../color.php?prod_id=" .$prod_id);
                die();
            }
        }
    }else{
        header("location: ../color.php?prod_id=0");
        die();
    }