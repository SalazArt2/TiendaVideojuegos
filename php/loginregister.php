<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registrar</title>
  <link rel="stylesheet" href="../css/register.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>
<body>
<?php
    include "usuarios.php";    
    $ejecucion=new sql();
    if(isset($_POST["log"])){
        
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
        $errores=[];
        ?><script>let campos=[];</script><?php
        if($ejecucion->existeCorr()){            
            $errores[]="correo";
            ?>
                
                <script>                 
                    campos.push('<b style="color:white;">El correo ya existe<br></b>');                    
                </script>
            <?php                      
        }
        if($ejecucion->existeUser()){
            $errores[]="correo";
            ?>
            <script>                 
                campos.push('<b style="color:white;">El usuario ya existe<br></b>');                    
            </script>
        <?php
        }
        if(empty($errores)){
            $ejecucion->subir();        
        }else{
            ?>
            <script>
                Swal.fire({
                        title: 'Error al Registrar',
                        html: '<br><span class=\'border\'>'+campos.join("\n")+' </span>',
                        confirmButtonText: 'Regresar',
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            history.back();
                        }
                        });
            </script>
            <?php
        }
    }
?>
</body>
</html>