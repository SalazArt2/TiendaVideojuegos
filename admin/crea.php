<?php
    require '../php/database.php';    
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Añadir Juego</title>
  <link rel="stylesheet" href="../admin/estiloC.css">
</head>
<body>
    <div class="signupFrm">
        <form method="post" class="formulario"id="formulario"action=../admin/mostrar.php enctype="multipart/form-data">            
            <h1 class="title">Crear</h1>
             <div class="formulario_grupo">
                 <input type="text" name="To"class="input" placeholder="a" >
                 <label for="" class="label">Titulo Original</label>
             </div>
             <div class="formulario_grupo">
                <input type="text" name="Tt"class="input" placeholder="a">
                <label for="" class="label">Titulo Traducido</label>
            </div>
             <div class="formulario_grupo">
                <input type="file" name="cara" class="inputc" accept="image/jpeg, image/png" >
                <label for="" class="label">Caratula</label>
            </div>
            <div class="formulario_grupo">
                 <input type="number" name="precio" class="input" placeholder="a">
                 <label for="" class="label">Precio</label>
            </div>
            
            <div class="formulario_grupo">
                 <textarea name="desc"class="inputb" placeholder="a" id="pass1"></textarea>
                 <label for="" class="label">Descripcion</label>
            </div>
            
            <div class="formulario_grupo">
                 <input type="text" name="saga" class="input" placeholder="a" id="pass2">
                 <label for="" class="label">Saga</label>
            </div>
            <div class="formulario_grupo">
                 <input type="number" name="dispo" class="input" placeholder="10" min="10">
                 <label for="" class="label">Disponibles</label>
            </div>
            <script src="../javascript/multi-select1.js"></script>
            <div class="wrapper">
                <div class="container" id="dropdownSelected">
                    <span>Selected</span>
                </div>
                <div class="formulario_grupo container">
                    <select class="inputd" name="Lang[]"multiple>                    
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
            <div class="formulario_grupo">
                <select class="inputd" name="Gen[]" multiple>                    
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
            <div class="formulario_grupo">
                <select class="inputd"name="Plat[]" multiple>                    
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
                <input type="submit" name="boton" class="submitBtn" value="Crear">
           </div>
        </form>
      </div>
</body>
</html>