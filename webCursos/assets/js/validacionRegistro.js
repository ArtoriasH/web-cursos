const nombre = document.getElementById('nombre'); 
const form = document.getElementById('registro');
var error = document.getElementById('error');
error.style.color = 'red';


form.addEventListener('submit', function(event){
  
    var mensajesError = [];

    if(nombre.value === null || nombre.value === ''){
        mensajesError.push('Ingresa tu nombre');
    }

    error.innerHTML = mensajesError.join(', ');
});