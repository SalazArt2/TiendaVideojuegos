<?php 
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Registrar</title>
  <link rel="stylesheet" href="../css/register.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

</head>
<body>
    <div class="signupFrm">        
        <img src="../img/Game.png" class="avatar" alt="Avatar Image"> 
        <form method="post"action="../php/loginregister.php" class="formulario" id="formulario">            
            <h1 class="title">Sign up</h1>
             <div class="formulario_grupo" id="grupo_nombre">
                 <input type="text" name="nombre"class="input" placeholder="a">
                 <label for="" class="label">Nombre</label>
             </div>
             <div class="formulario_grupo" id="grupo_edad">
                <input type="number" name="edad"class="input" placeholder="a" id="edad">
                <label for="" class="label">Edad</label>
            </div>
             <div class="formulario_grupo" id="grupo_email">
                <input type="email" name="email" class="input" placeholder="a" id="correo">
                <label for="" class="label">Email</label>
            </div>
            <div class="formulario_grupo" id="grupo_usuario">
                 <input type="text" name="user" class="input" placeholder="a" id="user">
                 <label for="" class="label">Username</label>
            </div>
            
            <div class="formulario_grupo" id="grupo_password">
                 <input type="password" name="contrasena"class="input" placeholder="a" id="pass1">
                 <label for="" class="label">Password</label>
            </div>
            
            <div class="formulario_grupo"id="grupo_password2">
                 <input type="password" class="input" placeholder="a" id="pass2">
                 <label for="" class="label">Confirm Password</label>
            </div>
            <div class="formulario_grupo">
                <input type="submit" name="boton" class="submitBtn" value="Sign up">
           </div>            
            <script>
                                
                const formulario=document.getElementById('formulario');

                const expresiones = {
                    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
                    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
                    password: /^.{4,12}$/, // 4 a 12 digitos.
                    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
                }

                const campos = {
                    usuario: false,
                    nombre: false,
                    password: false,
                    correo: false
                } 
                function verificarPasswords() {
                
                    // Ontenemos los valores de los campos de contraseñas 
                    pass1 = document.getElementById('pass1').value;
                    pass2 = document.getElementById('pass2').value;
                
                    // Verificamos si las constraseñas no coinciden 
                    if (pass1.value != pass2.value) {
                
                        return false;
                    } else {
                
                        return true;
                    } 
                }
                function correoExiste(){
                    
                }
                function validarCampo(expresion, valor){
                    return (expresion.test(valor));
                }
                function validarEdad(){
                    edad = document.getElementById('edad').value;                    
                    return(edad>=18);
                }
                formulario.addEventListener('submit', (e) => {
                    e.preventDefault();  
                    let campos=[];
                    if(!validarCampo(expresiones.nombre,document.querySelectorAll('input')[0].value)){
                        campos.push('<b style="color:white;">El nombre no puede llevar numeros ni quedar vacío<br></b>');
                    }
                    if(!validarCampo(expresiones.correo,document.querySelectorAll('input')[2].value)){
                        campos.push('<b style="color:white;">Correo vacío o no admitido<br></b>');
                    }
                    if(!validarCampo(expresiones.usuario, document.querySelectorAll('input')[3].value)){
                        campos.push('<b style="color:white;">Usuario no admitido<br></b>');
                    }
                    if(!validarCampo(expresiones.password, document.querySelectorAll('input')[4].value))
                    {
                        campos.push('<b style="color:white;">La contraseña no es segura<br></b>');
                    }
                    if(!verificarPasswords()){
                        campos.push('<b style="color:white;">Las contraseñas no son iguales<br></b>');
                    }
                    if(!validarEdad()){
                        campos.push('<b style="color:white;">Debes ser mayor de edad para registrarte<br></b>');
                    }
                    if(campos.length==0){                     
                        document.getElementById('formulario').submit();
                    }else{   
                        campos.unshift('<b style="color:red;">REGISTRO FALLIDO</b><br>');
                        let timerInterval;
                        Swal.fire({
                        title: 'Error al Registrar',
                        html: '<br><span class=\'border\'>'+campos.join("\n")+' </span>',
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                            timerInterval = setInterval(() => {
                            }, 100)
                        },
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                        })
                    }
                });
            </script>            
	        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
        </form>
      </div>
</body>
</html>