<?php
    
    $dbhost="localhost";
    $dbname="gameparadise";
    $dbuser="root";
    $dbpass="";
    try{
        $connect=new PDO("mysql:host=$dbhost;dbname=$dbname;",$dbuser,$dbpass);
    }catch(PDOException $e){
        die('Conexión fallida'.$e->getMessage());
    }
?>