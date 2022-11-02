<?php
    include "usuarios.php";
    $tipo=$_POST["boton"];
    echo $tipo;
    if($tipo=="login"){

    }else{
        $email=$_POST["email"];
        $username=$_POST["user"];
        $password=$_POST["contrasena"];
        $edad=$_POST["edad"];
        $nombre=$_POST["nombre"];
        $ejecución=new sql();    
        $ejecución->setNombre($nombre);
        $ejecución->setUser($username);
        $ejecución->setCorreo($email);
        $ejecución->setEdad($edad);
        $ejecución->setContrasena($password);
        $ejecución->subir();
        include "index.php";
    }
?>