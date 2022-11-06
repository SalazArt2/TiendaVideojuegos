<?php
require 'app.php';
function estaAutenticado():bool{
    session_start(); 
    $auth=$_SESSION['login']??false;
    if($auth){
        return true;
    }else{
        return false;
    }

}