<?php
    require '../php/database.php';  
    
    if(isset($_POST['To'])&&isset($_POST['Tt'])&&isset($_POST['precio'])&&isset($_POST['desc'])&&isset($_POST['saga'])
    &&isset($_POST['dispo'])&&isset($_FILES['cara'])&&isset($_FILES['porta'])){
        $To=$_POST["To"];        
        $Tt=$_POST["Tt"];          
        $precio=$_POST["precio"];        
        $desc=$_POST["desc"];        
        $saga=$_POST["saga"];
        $dis=$_POST["dispo"];
        $imagen=$_FILES['cara'];       
        $medida = 1000*1000;
        if($imagen['size']>$medida){
        }
             
            $carpeta='../imagen/';
            $nombreImagen=md5 ( uniqid ( rand (),true ) ).".jpg";
            if(!is_dir($carpeta)){
                mkdir($carpeta);
            }            
            move_uploaded_file($imagen['tmp_name'],$carpeta .$nombreImagen);                                    
        
            $records=$connect->prepare("INSERT into juegos values('',:titO,:titT,:cara,:precio,:descr,:saga,:dispo)");
            $records->bindParam(":titO",$To);
            $records->bindParam(":titT",$Tt);
            $records->bindParam(":cara",$nombreImagen);
            $records->bindParam(":precio",$precio);
            $records->bindParam(":descr",$desc);
            $records->bindParam(":saga",$saga);
            $records->bindParam(":dispo",$dis);
            $records->execute();     
            $id = $connect->lastInsertId();
            $values = $_POST['Lang'];
            foreach ($values as $a){
                $records=$connect->prepare("INSERT into juegosidiomas values(:juego,:lang)");
                $records->bindParam(":juego",$id);
                $records->bindParam(":lang",$a);
                $records->execute();     
            }
            $values = $_POST['Gen'];
            foreach ($values as $a){
                $records=$connect->prepare("INSERT into juegosgeneros values(:juego,:gen)");
                $records->bindParam(":juego",$id);
                $records->bindParam(":gen",$a);
                $records->execute();     
            }
            $values = $_POST['Plat'];
            foreach ($values as $a){
                $records=$connect->prepare("INSERT into juegosplataformas values(:juego,:plat)");
                $records->bindParam(":juego",$id);
                $records->bindParam(":plat",$a);
                $records->execute();     
            }
    }  
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Añadir Juego</title>
  <link rel="stylesheet" href="../admin/estiloC.css">
  <script src="js/jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

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
                <input type="file" name="porta" class="inputc" accept="image/jpeg, image/png" >
                <label for="" class="label">Portada</label>
            </div>
            <div class="formulario_grupo">
                 <input type="number" name="precio"id="precio" class="input" placeholder="a" value="0">
                 <label for="" class="label">Precio</label>
            </div>
            
            <div class="formulario_grupo">
                 <textarea name="desc"class="inputb" placeholder="a" id="desc"></textarea>
                 <label for="" class="label">Descripcion</label>
            </div>
            
            <div class="formulario_grupo">
                 <input type="text" name="saga" class="input" placeholder="a" id="pass2">
                 <label for="" class="label">Saga</label>
            </div>
            <div class="formulario_grupo">
                 <input type="number" name="dispo"id="dispo" class="input" value="1" min="1">
                 <label for="" class="label">Disponibles</label>
            </div>
            <script src="../javascript/multi-select2.js"></script>
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
                <script>
                    const formulario=document.getElementById('formulario');

                    const campos = {
                        usuario: false,
                        nombre: false,
                        password: false,
                        correo: false
                    } 
                    function verificarPasswords() {

                        // Ontenemos los valores de los campos de contraseñas 
                        pass1 = document.getElementById('pass1');    
                    }

                    function validarCampo(valor){
                        return valor!="";
                    }
                    function validarTexto(valor){
                        return (valor.length>200);
                    }
                    function validarPrecio(){
                        prize = document.getElementById('precio').value;
                        return(prize>=175);
                    }
                    function validarCantidad(){
                        canti = document.getElementById('dispo').value;
                        return(canti>=0);
                    }
                    formulario.addEventListener('submit', (e) => {
                        e.preventDefault();        
                        let campos=[];                        
                        if(!validarCampo(document.querySelectorAll('input')[0].value)){
                            campos.push('<b style="color:white;">Ingrese Título Original</b><br>');
                        }
                        if(!validarCampo(document.querySelectorAll('input')[1].value)){
                            campos.push('<b style="color:white;">Ingrese Título de distribución</b><br>');
                        }
                        if(!validarCampo(document.querySelectorAll('input')[2].value)){
                            campos.push('<b style="color:white;">Ingrese Título Original</b><br>');
                        }
                        if(!validarCampo(document.querySelectorAll('input')[3].value)){
                            campos.push('<b style="color:white;">Ingrese Título Original</b><br>');
                        }
                        if(!validarTexto(document.getElementById('desc').value)){
                            campos.push('<b style="color:white;">Ingrese Título Original</b><br>');
                        }                                                
                        if(!validarCantidad()){
                            campos.push('<b style="color:white;">Ingrese Título Original</b><br>');
                        }
                        if(!validarPrecio()){
                            campos.push('<b style="color:white;">Ingrese Título Original</b><br>');
                        }                        
                        if(campos.length==0){
                            document.getElementById('formulario').submit();
                            swal.fier({
                                position:'top',
                                type:'succes',
                                html:'<b style="color:green;">Inserción de datos lograda</b>',
                                title:'Exito'
                            })
                        }else{
                            campos.push('<b style="color:white;">La insersión de datos ha </b><b style ="color:red;">FALLADO</b>');   
                            Swal.fire({
                                title: 'Error al crear',
                                html: '<br><span class=\'border\'>'+campos.join("\n")+' </span>',
                                timer: 2000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()                                    
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            })
                                }
                    });
                </script>
           </div>
        </form>
      </div>
</body>
</html>