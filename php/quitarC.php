<?php
    require '../php/funciones.php';
    if(carroVacio()){        
    }else{
        $juego=0;        
        $juego+=$_GET['id'];  
        var_dump($juego);      
        $records=$connect->prepare("DELETE from carro where user=:usua and juego=:game;");   
        $records->bindParam(":usua",$_SESSION['user']);      
        $records->bindParam(":game",$juego);      
        $records->execute();
    }
    header('location: ../php/index.php');
?>