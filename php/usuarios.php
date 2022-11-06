<?php

class sql{
    
        private $metodo;
        
        private $correo;        
        
        private $nombre;

        private $user;

        private $edad;

        private $contrasena;
        public function setCorreo($corr){
            $this->correo=$corr;
        }
        public function getCorreo(){
            return $this->correo;
        }
        public function setNombre($corr){
            $this->nombre=$corr;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setUser($corr){
            $this->user=$corr;
        }
        public function getUser(){
            return $this->user;
        }
        public function setEdad($corr){
            $this->edad=$corr;
        }
        public function getEdad(){
            return $this->edad;
        }
        
        public function setContrasena($corr){
            $this->contrasena=$corr;
        }
        public function getContrasena(){
            return $this->contrasena;
        }
        public function existeCorr(){
            require 'database.php';
            $records=$connect->prepare("SELECT usuario from usuarios where correo=:correo");

            $records->bindParam(':correo',$this->correo);

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
        public function subir(){
            require 'database.php';
            $contra =password_hash($this->contrasena,PASSWORD_BCRYPT);
            $sql="INSERT INTO usuarios values (:nombre,:usuario,:correo,:edad,:contrasena);";
            $stmt=$connect->prepare($sql);
            $stmt->bindParam(':nombre',$this->nombre);
            $stmt->bindParam(':usuario',$this->user);
            $stmt->bindParam(':correo',$this->correo);
            $stmt->bindParam(':edad',$this->edad);
            $stmt->bindParam(':contrasena',$contra);
            
            if (!$stmt->execute()) {
                echo "fallo";
            }
            else{
                
                header('Location: ../php/login.php');

            }
        }

        public function validar(){
            require 'database.php';
            session_start();
            $records=$connect->prepare("SELECT usuario,correo,contrasena from usuarios where correo=:correo or usuario=:usuario");
            
            $records->bindParam(':usuario',$this->user);
            $records->bindParam(':correo',$this->correo);

            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            if(is_countable($results)&&password_verify($this->contrasena,$results['contrasena'])){
                $_SESSION['user']=$results['usuario'];
                $_SESSION['login']=true;
                header('Location: ../php/index.php');
                return true;
            }else{
                return false;                
            }

        }
    }
?>