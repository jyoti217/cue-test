<?php

if($_POST['action'] == 'login'){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        if($_POST['username'] == 'cueblocks' && $_POST['password'] == 'cueblocks'){
            session_start();
            $_SESSION["username"] = "cueblocks";
            echo "success";
        }else{
            echo "false";
        }
    }
} else if($_POST['action'] == 'logout'){
    session_unset();
    session_destroy();
    header("Location: /admin-login.php");
    exit();
} else {
    header("Location: /admin-login.php");
    exit();
}
