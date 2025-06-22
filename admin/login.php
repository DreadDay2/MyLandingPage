<?php
    session_start();

    $user = array(
        "login" => "admin",
        "password" => "admin",
    );

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $login = $_POST['login'];
        $password = $_POST['password'];

        //echo $login." ".$password;
    }

    if($user["login"] == $login && $user["password"] == $password){
        //echo "SIEMA ADMIN";
        header('Location: admin.php');
        $_SESSION['user_yes'] = true;
        $_SESSION['admin'] = true;
    }
    else{
        $_SESSION['error'] = true;
        header('Location: index.php');
    }
?>