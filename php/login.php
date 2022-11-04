<?php     
    include 'usuarios.php';
    $error="";
    $log="";
    if(!empty($_POST["log"])&&!empty($_POST["contrasena"]))
    {
        $ejecucion=new sql();    
        $email=$_POST["log"];
        $username=$_POST["log"];
        $password=$_POST["contrasena"];
        $ejecucion->setUser($username);
        $ejecucion->setCorreo($email);
        $ejecucion->setContrasena($password);
        if(!$ejecucion->validar());
        {
            $error="Usuario y/o Contraseña Incorectos";
            $log=$email;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ingresar</title>
  <link rel="stylesheet" href="../css/login2.css">
</head>
<body>
    <div class="signupFrm">        
        
        <form method="post" class="form">            
            <h1 class="title">Log-in</h1>
    
           <div class="formu">  
            <img src="../img/LogoV1Escalado.png" class="avatar" alt="Avatar Image"> 
             <div class="inputContainer">
                 <input type="text"name="log" class="input" placeholder="a" value="<?=$log?>">
                 <label for="" class="label">Nombre Usuario o Correo</label>
             </div>
            
             <div class="inputContainer">
                 <input type="password" name="contrasena"class="input" placeholder="a"required>
                 <label for="" class="label">Password</label>
             </div>
            
            
           </div>
            <input type="submit" class="submitBtn" name="boton" value="Ingresar">
            <?php
                if($error!=""){
                    ?>
                    <a class="adv"><?php echo $error; ?></a>
                    <?php
                }
            ?>
        </form>
      </div>
</body>
</html>
