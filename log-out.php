<?php
    session_start();
    if(
        isset($_SESSION['logged_in'])
        &&
        isset($_SESSION['user_id'])
        &&
        isset($_SESSION['email'])){

        unset($_SESSION['email'], $_SESSION["user_id"], $_SESSION["logged_in"]);
        header("location: login.php");
        exit();

    }else{

        header("location: login.php");
        exit();

    }
?>