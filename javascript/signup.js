const formulario=document.getElementById('formulario');
 
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

formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	if(verificarPasswords()){
        document.getElementById('formulario').submit();
	} else {
		alert("Las contraseñas no coinciden");
	}
});