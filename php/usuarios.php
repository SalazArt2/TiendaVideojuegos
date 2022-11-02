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
        public function subir(){
            $dbhost="localhost";
            $dbname="gameparadise";
            $dbuser="root";
            $dbpass="";
            $sql="";
            
            $sql="INSERT INTO usuarios values ('$this->nombre','$this->user','$this->correo','$this->edad','$this->contrasena');";
            
            $connect=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)or die ("Problemas con la conexión");        
            $result = mysqli_query($connect, $sql);
            if ($result == FALSE) {
                echo "fallo";
            }
            else{
                
                echo "exito";
            }
        }

        public function validar(){
            
        }
    }
?>