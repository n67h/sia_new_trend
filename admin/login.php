<?php
    session_start();
    require_once 'includes/db.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- font-awesome cdn -->
    <script src="https://kit.fontawesome.com/3481525a72.js" crossorigin="anonymous"></script>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../resources/css/admin-login.css">
</head>
<body>
    <?php
        if(isset($_POST['login'])) {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            if(empty($email) || empty($password)) {
                header('location: login.php?error=emptyfields');
                die();
            }


            // function to check if email already exists
            function emailExists($conn, $email) {
                $sql = "SELECT * FROM admin WHERE email = ?;";
                $stmt = mysqli_stmt_init($conn);
        
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                }
        
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
        
                $resultData = mysqli_stmt_get_result($stmt);
        
                if($row = mysqli_fetch_assoc($resultData)) {
                    return $row;
                } else {
                    $result = false;
                    return $result;
                }
        
                mysqli_stmt_close($stmt);
            }
            // end of function

            $emailExists = emailExists($conn, $email);

            if($emailExists === false) {
                header("location: login.php?error=invalidemail");
                die();
            }
            
            $passwordHashed = $emailExists['password'];

            $checkPassword = password_verify($password, $passwordHashed);

            if($checkPassword === false) {
                header("location: login.php?error=invalidpassword");
                die();
            } elseif($checkPassword === true) {
            // }else{
                $query = "SELECT * FROM admin WHERE admin_id = '" .$emailExists['admin_id']. "' AND email = '" .$emailExists['email']. "';";
                $result = mysqli_query($conn, $query);
                $count = mysqli_num_rows($result);
                if($count === 1) {    
                    session_start();
                    $_SESSION['admin_id'] = $emailExists['admin_id'];
                    $_SESSION['user_level'] = $emailExists['user_level'];
                    $_SESSION['email'] = $emailExists['email'];

                    $result = mysqli_query($conn, $query);

                    header("location: dashboard.php");
                    die();
                }
            }
        }
    ?>
    <section class="container">
        <div class="row content d-flex justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="box shadow bg-white p-4">
                    <h6 class="mb-4 text-center fs-1">Login Form</h6>
                    <form action="" method="post" class="mb-3">
                        <div class="form-floating mb-3">
                            <input type="text" name="email" class="form-control rounded-0" id="email" placeholder="Email" required!>
                            <label for="username">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control rounded-0" id="password" placeholder="Password" required!>
                            <label for="password">Password</label>
                        </div>
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" name="login" class="btn btn-dark btn-lg border-0 rounded-0">Log in</button>
                        </div>
                        <?php
                            $error_message = '';
                            if(isset($_GET['error'])){
                                if($_GET['error'] === 'emptyfields'){
                                    $error_message = 'All fields are required.';
                                }elseif($_GET['error'] === 'invalidemail'){
                                    $error_message = 'Invalid email.';
                                }elseif($_GET['error'] === 'invalidpassword'){
                                    $error_message = 'Invalid password.';
                                }elseif($_GET['error'] === 'accessdenied'){
                                    $error_message = 'Access denied.';
                                }
                            }
                        ?>
                        <h6 class="text-danger text-center"><?= $error_message; ?></h6>
                        
                    </form>
                </div>
            </div>
        </div>
    </section>



    <!-- js section -->
    <!-- bootstrap js popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        // $('.sidebar ul li').on('click', function(){
        //     $('.sidebar ul li.active').removeClass('active');
        //     $(this).addClass('active');
        // });

        $('.open-btn').on('click', function(){
            $('.sidebar').addClass('active');
        });

        $('.close-btn').on('click', function(){
            $('.sidebar').removeClass('active');
        });
    </script>
</body>
</html>