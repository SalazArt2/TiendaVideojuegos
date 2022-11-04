
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
    pass1 = document.getElementById('pass1');
    pass2 = document.getElementById('pass2');
 
    // Verificamos si las constraseñas no coinciden 
    if (pass1.value != pass2.value) {
 
        return false;
    } else {
 
        return true;
    } 
}

function validarCampo(expresion, valor){
	return (expresion.test(valor));
}
function validarEdad(){
    edad = document.getElementById('edad');
    return(edad>=18);
}
formulario.addEventListener('submit', (e) => {
	e.preventDefault();        
    let campos=[];
    if(!validarCampo(expresiones.nombre,document.querySelectorAll('input')[0].value)){
        campos.push("El nombre no puede llevar numeros");
    }
    if(!validarCampo(expresiones.correo,document.querySelectorAll('input')[2].value)){
        campos.push("El correo no es válido");
    }
    if(!validarCampo(expresiones.usuario, document.querySelectorAll('input')[3].value)){
        campos.push("El nombre de usuario no es válido");
    }
	if(!validarCampo(expresiones.password, document.querySelectorAll('input')[4].value))
    {
        campos.push("La contraseña debe de tener entre 4 a 12 caracteres");
    }
    if(!verificarPasswords()){
        campos.push("Las contraseñas no coinciden");
	}
    if(!validarEdad()){
        campos.push("Debes ser mayor de edad para registrarte");
	}
    if(campos.length==0){
        document.getElementById('formulario').submit();
    }else{   
    }
});