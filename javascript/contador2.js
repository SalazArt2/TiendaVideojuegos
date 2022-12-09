document.querySelector("#btnsumar").addEventListener("click", sumarUno);
document.querySelector("#btnrestar").addEventListener("click", restarUno);

var cont=document.getElementById('contador').value;
function sumarUno(){    
    
    var x=document.getElementById("contador").max;
    if(cont<x){
        cont = parseInt(cont)+1;
        document.getElementById("contador").value=cont;
    }
}

function restarUno(){
    console.log(cont);
    if(cont>=2){   
        cont = cont-1;
        document.getElementById("contador").value=cont;
    }
}