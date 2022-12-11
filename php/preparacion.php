<?php
require 'database.php';
require '../php/funciones.php';
$records=$connect->prepare("SELECT carro.juego,juegos.caratula,juegos.tituloTr,juegos.precio,carro.cant from juegos,carro WHERE juegos.id in 
(SELECT carro.juego from carro where carro.user=:user)
GROUP BY juegos.tituloTr");   
$records->bindParam(":user",$_SESSION['user']);      
$records->execute();
$productos = $records->fetchAll();
$juegos=[];
$precio=[];
$cant=[];
foreach($productos as $pro){
    $juegos[]=$pro["tituloTr"];  
    $precio[]=$pro["precio"];  
    $cant[]=$pro["cant"];  
    }
echo "<pre>";
var_dump($juegos);
echo "<pre>";
var_dump($precio);
echo "<pre>";
var_dump($cant);
echo "<pre>";
$juegos = serialize($juegos);
$precio = serialize($precio);
$cant = serialize($cant);
header('Location: ../php/convertirPDF.php?nombre='.$juegos.'&cant='.$cant.'&precio='.$precio);
?>