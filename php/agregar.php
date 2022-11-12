<?php
    require '../php/funciones.php';
    $juego = $_GET['id'];    
    if(!juegoEnCarrito($juego))
    {
        $canti=$_POST['canti'];
        $records=$connect->prepare("INSERT into carro values (:user,:email,:juego,:canti);");
        $records->bindParam(':user',$_SESSION['user']);
        $records->bindParam(':email',$_SESSION['correo']);
        $records->bindParam(':juego',$_GET['id']);
        $records->bindParam(':canti',$canti);
        $records->execute();
        
        
    }
    else{        
    }
    header('Location: ../php/carrito.php');
?>