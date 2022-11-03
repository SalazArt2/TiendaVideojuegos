<?php
    require '../php/database.php';
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Agregar Juego</title>
  <link rel="stylesheet" href="../admin/estiloC.css">
</head>
<body>
    <div class="signupFrm">
        <form method="post"action="../php/loginregister.php" class="formulario" id="formulario">            
            <h1 class="title">Crear</h1>
             <div class="formulario_grupo" id="grupo_nombre">
                 <input type="text" name="nombre"class="input" placeholder="a" required>
                 <label for="" class="label">Titulo Original</label>
             </div>
             <div class="formulario_grupo" id="grupo_edad">
                <input type="number" name="edad"class="input" placeholder="a"required>
                <label for="" class="label">Titulo Traducido</label>
            </div>
             <div class="formulario_grupo" id="grupo_email">
                <input type="file" name="cara" class="inputc" placeholder="" required>
                <label for="" class="label">Caratula</label>
            </div>
            <div class="formulario_grupo" id="grupo_usuario">
                 <input type="number" name="precio" class="input" placeholder="a"required>
                 <label for="" class="label">Precio</label>
            </div>
            
            <div class="formulario_grupo" id="grupo_password">
                 <textarea name="contrasena"class="inputb" placeholder="a" id="pass1"></textarea>
                 <label for="" class="label">Descripcion</label>
            </div>
            
            <div class="formulario_grupo"id="grupo_password2">
                 <input type="text" class="input" placeholder="a" id="pass2">
                 <label for="" class="label">Saga</label>
            </div>
            <script src="../javascript/multi-select1.js"></script>
            <div class="wrapper">
                <div class="container" id="dropdownSelected">
                    <span>Selected</span>
                </div>
                <div class="formulario_grupo container"id="grupo_passworda">
                    <select class="inputd" multiple>                    
                        <?php                    
                        $query = $connect->prepare("SELECT * FROM idiomas");
                        $query->execute();
                        $data = $query->fetchAll();

                        foreach ($data as $valores):
                        echo '<option value="'.$valores["idIdioma"].'">'.$valores["idioma"].'</option>';
                        endforeach;
                        ?>
                    </select>                             
                </div>
            </div>            
            <div class="formulario_grupo"id="grupo_passworda">
                <select class="inputd" multiple>                    
                    <?php                    
                    $query = $connect->prepare("SELECT * FROM generos");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                    echo '<option value="'.$valores["idGen"].'">'.$valores["genero"].'</option>';
                    endforeach;
                    ?>
                </select>                                                                    
            </div>
            <div class="formulario_grupo"id="grupo_passworda">
                <select class="inputd" multiple>                    
                    <?php                    
                    $query = $connect->prepare("SELECT * FROM plataformas");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                    echo '<option value="'.$valores["idPlataforma"].'">'.$valores["Plataforma"].'</option>';
                    endforeach;
                    ?>
                </select>                         
            </div>
            <div class="formulario_grupo">
                <input type="submit" name="boton" class="submitBtn" value="Sign up">
           </div>
        </form>
      </div>
</body>
</html>