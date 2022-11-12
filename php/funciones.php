<?php
require 'app.php';
session_start(); 
function estaAutenticado():bool{    
    $auth=$_SESSION['login']??false;
    if($auth){
        return true;
    }else{
        return false;
    }

}
function juegoEnCarrito($juego):bool{    
    require 'database.php';        
    $result=$connect->prepare("SELECT * FROM carro where user=:usua and email=:corr and juego=:game");    
    $result->bindParam(':game',$juego);
    $result->bindParam(':usua',$_SESSION['user']);
    $result->bindParam(':corr',$_SESSION['correo']);
    $result->execute();
    $results = $result->fetch(PDO::FETCH_ASSOC);
    if(is_countable($results))
    {
        return true;
    }
    else{
        return false;
    }
}

function carroVacio():bool{
    require 'database.php';        
    $result=$connect->prepare("SELECT * FROM carro where user=:usua and email=:corr");    
    $result->bindParam(':usua',$_SESSION['user']);
    $result->bindParam(':corr',$_SESSION['correo']);
    $result->execute();
    $results = $result->fetch(PDO::FETCH_ASSOC);
    if(!is_countable($results))
    {
        return true;
    }
    else{
        return false;
    }
}