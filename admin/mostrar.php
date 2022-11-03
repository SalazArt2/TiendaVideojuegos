<?php
    require '../php/database.php';    
    if(isset($_POST['To'])){
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
            $nombreImagen=md5 ( uniqid ( rand (),true ) )."jpg";
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
            header('Location: ../admin/crea.php');
    }
?>