<?php
    session_start();
    require_once 'db.inc.php';
    if(isset($_SESSION['admin_id'])){
        $admin_id_session = $_SESSION['admin_id'];
        $level_session = $_SESSION['level'];
        $email_session = $_SESSION['email'];

        if(($level_session == 'new_trend')){
            // header('location: login.php?error=accessdenied');
            // die();
        }elseif(($level_session == 'admin')){
            // header('location: login.php?error=accessdenied');
            // die();
        }else{
            header('location: login.php?error=accessdenied');
            die();
        }
    }else{
        header('location: login.php');
        die();
    }