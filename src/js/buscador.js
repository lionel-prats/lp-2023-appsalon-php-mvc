// archivo creado en el VIDEO 540
document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});
function iniciarApp(){
    buscarPorFecha();
}

function buscarPorFecha(){ 
    const fechaInput = document.querySelector('#fecha');

    // listener 'input' -> ver explicacion en z.notas.txt VIDEO 506
    fechaInput.addEventListener('input', function(e){
        const fechaSeleccionada = e.target.value;
        window.location = `?fecha=${fechaSeleccionada}`; // esto recarga la pagina ( igual que window.location.reload() ), pero agregando el queryString especificado a la URL 
    })
}