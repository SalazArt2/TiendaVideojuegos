<?php 
    session_start();
?><!DOCTYPE html>
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
        
        <form method="post" class="form" action="../php/loginregister.php">            
            <h1 class="title">Log-in</h1>
    
           <div class="formu">  
            <img src="../img/Game.png" class="avatar" alt="Avatar Image"> 
             <div class="inputContainer">
                 <input type="text"name="log" class="input" placeholder="a" value="<?php if(isset($_SESSION['log'])){ echo $_SESSION['log'] ; }?>">
                 <label for="" class="label">Nombre Usuario o Correo</label>
             </div>
            
             <div class="inputContainer">
                 <input type="password" name="contrasena"class="input" placeholder="a"required>
                 <label for="" class="label">Password</label>
             </div>
            
            
           </div>
            <input type="submit" class="submitBtn" name="boton" value="Ingresar">
            <?php
                if(isset($_SESSION['adv'])){
                    ?>
                    <a class="adv"><?php echo $_SESSION['adv']; ?></a>
                    <?php
                }
            ?>
        </form>
      </div>
</body>
</html>