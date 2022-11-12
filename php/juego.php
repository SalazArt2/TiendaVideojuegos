<?php

class game{
    
        
        public function existeUser(){
            require 'database.php';
            $records=$connect->prepare("SELECT nombre from usuarios where usuario=:usuario");

            $records->bindParam(':usuario',$this->user);

            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            if(is_countable($results))
            {
                return true;
            }
            else{
                return false;
            }
        }
        public function subir($To,$Tt,$nombreImagen,$nombreImagenc,$precio,$desc,$saga,$dis,$año,$fecha,$lan,$gen,$plat,$compania){
            require 'database.php';
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
            foreach ($lan as $a){
                $records=$connect->prepare("INSERT into juegosidiomas values(:juego,:lang)");
                $records->bindParam(":juego",$id);
                $records->bindParam(":lang",$a);
                $records->execute();     
            }            
            foreach ($gen as $a){
                $records=$connect->prepare("INSERT into juegosgeneros values(:juego,:gen)");
                $records->bindParam(":juego",$id);
                $records->bindParam(":gen",$a);
                $records->execute();     
            }            
            foreach ($plat as $a){
                $records=$connect->prepare("INSERT into juegosplataformas values(:juego,:plat)");
                $records->bindParam(":juego",$id);
                $records->bindParam(":plat",$a);
                $records->execute();     
            }
        }
    }
?>