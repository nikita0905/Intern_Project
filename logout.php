<?php
include 'config.php';
if(isset($_SESSION['ID']) && $_SESSION['ID']!=''){
    $_SESSION['ID']='';
    unset($_SESSION['ID']);
    //unset($_COOKIE['email']);
    //unset($_COOKIE['password']);
    //session_destroy();
    $_SESSION['msg']="logout successfully";
    header("Location:login.php");
    exit();
}