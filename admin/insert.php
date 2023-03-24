<?php
    require_once 'includes/db.inc.php';

    $user_level = 'new_trend';
    $name = 'Andre Paul N. Sta. Clara';
    $email = 'andrepaul.staclara67@gmail.com';
    $password = 'qweqweqwe';
    $contact = '09298410728';
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO new_trend_user (user_level, name, email, password, contact) VALUES ('$user_level', '$name', '$email', '$hashed_password', '$contact');";

    if(mysqli_query($conn, $sql)){
        echo 'success';
    }else {
        echo 'failed';
    }