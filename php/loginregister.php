<?php
    include "usuarios.php";
    $tipo=$_POST["boton"];
    echo $tipo;
    $ejecucion=new sql();
    if($tipo=="Ingresar"){
        
        $email=$_POST["log"];
        $username=$_POST["log"];
        $password=$_POST["contrasena"];
        $ejecucion->setUser($username);
        $ejecucion->setCorreo($email);
        $ejecucion->setContrasena($password);
        $ejecucion->validar();
    }else{        
        $email=$_POST["email"];
        $username=$_POST["user"];
        $password=$_POST["contrasena"];
        $edad=$_POST["edad"];
        $nombre=$_POST["nombre"];        
        $ejecucion->setNombre($nombre);
        $ejecucion->setUser($username);
        $ejecucion->setCorreo($email);
        $ejecucion->setEdad($edad);
        $ejecucion->setContrasena($password);
        $ejecucion->subir();        
    }
?>