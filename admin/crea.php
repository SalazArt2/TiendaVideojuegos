<?php
    require '../php/database.php';  
    
    if(isset($_POST['To'])&&isset($_POST['Tt'])&&isset($_POST['precio'])&&isset($_POST['desc'])&&isset($_POST['saga'])
    &&isset($_POST['dispo'])&&isset($_FILES['cara'])&&isset($_FILES['porta'])&&isset($_POST["year"])&&isset($_POST["company"])){
        $To=$_POST["To"];        
        $Tt=$_POST["Tt"];          
        $precio=$_POST["precio"];        
        $desc=$_POST["desc"];        
        $saga=$_POST["saga"];
        $dis=$_POST["dispo"];
        $imagen=$_FILES['cara'];       
        $imagenp=$_FILES['porta'];       
        $año=$_POST["year"];
        $fecha=date('Y/m/d');
        $compania=$_POST["company"];
        $medida = 1000*1000;
        if($imagen['size']<=$medida && $imagenp['size']<=$medida){
        }
             
            $carpeta='../img/';
            $nombreImagen=md5 ( uniqid ( rand (),true ) ).".jpg";
            $nombreImagenc=md5 ( uniqid ( rand (),true ) ).".jpg";
            if(!is_dir($carpeta)){
                mkdir($carpeta);
            }            
            move_uploaded_file($imagen['tmp_name'],$carpeta .$nombreImagen);                                    
            move_uploaded_file($imagenp['tmp_name'],$carpeta .$nombreImagenc);                                    
        
            $records=$connect->prepare("INSERT into juegos values('',:titO,:titT,:cara,:porta,:precio,:descr,:saga,:dispo,:yea,:fecha)");
            $records->bindParam(":titO",$To);
            $records->bindParam(":titT",$Tt);
            $records->bindParam(":cara",$nombreImagen);
            $records->bindParam(":porta",$nombreImagenc);
            $records->bindParam(":precio",$precio);
            $records->bindParam(":descr",$desc);
            $records->bindParam(":saga",$saga);
            $records->bindParam(":dispo",$dis);
            $records->bindParam(":yea",$año);
            $records->bindParam(":fecha",$fecha);
            
            $records->execute();     
            $id = $connect->lastInsertId();
            $records=$connect->prepare("INSERT into juegoscompania values(:juego,:comp)");
            $records->bindParam(":juego",$id);
            $records->bindParam(":comp",$compania);
            $records->execute();     
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
  <link rel="stylesheet" href="../admin/estiloC5.css">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>
<body>
    <div class="signupFrm">
        <form method="post" class="formulario"id="formulario" enctype="multipart/form-data">            
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
            <div class="formulario_grupo">
                 <input type="number" name="year"id="year" class="input" value="1" min="1">
                 <label for="" class="label">Año Lanzamiento</label>
            </div>        
            <script src="../javascript/multi-select3.js"></script>
            <div class="wrapper formulario_grupo">
                <div class="container" id="dropdownSelected">
                    <span>Idioma(s)</span>                    
                </div>
                <div class="container">
                    <select class="inputd" name="Lang[]" id="lan"multiple>                    
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
            <div class="container" id="dropdownSelected">
                    <span>Género(s)</span>                    
                </div>                 
                <select class="inputd" name="Gen[]" id="gen" multiple>                    
                    <?php                    
                    $query = $connect->prepare("SELECT * FROM generos");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores){
                    echo '<option value="'.$valores["idGen"].'">'.$valores["genero"].'</option>';
                    }
                    ?>
                </select>                                                                    
            </div>
            <div class="formulario_grupo">
            <div class="container" id="dropdownSelected">
                    <span>Plataforma(s)</span>                    
                </div>
                <select class="inputd"name="Plat[]" id="plat"multiple>                    
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
            <label for="" class="label">Compania</label>
                 <select class="inputd" name="company" id="company">
                    <option class="option">--Selecciona una--</option>
                    <?php                    
                        $query = $connect->prepare("SELECT * FROM compania");
                        $query->execute();
                        $data = $query->fetchAll();

                        foreach ($data as $valores):
                        echo '<option class="option" value="'.$valores["idCompania"].'">'.$valores["Compania"].'</option>';
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
                    function validarSelect(indice){
                        return (indice === -1);
                    }
                    function validarCampo(valor){
                        return valor!="";
                    }
                    function validarTexto(valor){
                        return (valor.length>=100)&&(valor.length<=600);
                    }
                    function validarPrecio(){
                        prize = document.getElementById('precio').value;
                        return(prize>=0);
                    }
                    function validarCantidad(){
                        canti = document.getElementById('dispo').value;
                        return(canti>=10);
                    }
                    function validarAño(){
                        var today = new Date();
                        var year = today.getFullYear();
                        año = document.getElementById('year').value;
                        return(año>=1952)&&(año<=year);
                    }
                    function validarGeneros(){
                        let options = document.getElementById('gen').options;
                        let cant = 0;
                        for (let i=0; i < options.length; i++) {
                            if (options[i].selected) cant++;
                        }
                        return(cant>0);                        
                    }
                    function validarIdiomas(){
                        let options = document.getElementById('lan').options;
                        let cant = 0;
                        for (let i=0; i < options.length; i++) {
                            if (options[i].selected) cant++;
                        }
                        return(cant>0);                        
                    }
                    function validarPlataformas(){
                        let options = document.getElementById('plat').options;
                        let cant = 0;
                        for (let i=0; i < options.length; i++) {
                            if (options[i].selected) cant++;
                        }
                        return(cant>0);                        
                    }
                    function validarCompania(){
                        return (document.getElementById('company').selectedIndex>=1);
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
                            campos.push('<b style="color:white;">Ingrese Imagen de Caratula</b><br>');
                        }
                        if(!validarCampo(document.querySelectorAll('input')[3].value)){
                            campos.push('<b style="color:white;">Ingrese Imagen de Portada</b><br>');
                        }
                        if(!validarTexto(document.getElementById('desc').value)){
                            campos.push('<b style="color:white;">La descripción debe ser mayor de 200</b><br>');
                        }                                                
                        if(!validarCantidad()){
                            campos.push('<b style="color:white;">Se debe disponer de al menos 10</b><br>');
                        }
                        if(!validarPrecio()){
                            campos.push('<b style="color:white;">El valor mínimo del precio es 0</b><br>');
                        }
                        if(!validarIdiomas()){   
                            campos.push('<b style="color:white;">Seleccione al menos un idioma</b><br>');
                        }
                        if(!validarGeneros()){   
                            campos.push('<b style="color:white;">Seleccione al menos un género</b><br>');
                        }
                        if(!validarPlataformas()){   
                            campos.push('<b style="color:white;">Seleccione al menos una plataforma</b><br>');
                        }
                        if(!validarAño()){
                            var today = new Date();
                            var year = today.getFullYear();
                            campos.push('<b style="color:white;">El año debe ser entre 1952 y '+year+'</b><br>');
                        }    
                        if(!validarCompania()){
                            campos.push('<b style="color:white;">Seleccione una compañía</b><br>');
                        }              
                        if(campos.length==0){
                            document.getElementById('formulario').submit();
                            swal.fire({
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
                                type:'error'
                            })
                                }
                    });
                </script>
           </div>
        </form>
      </div>
</body>
</html>