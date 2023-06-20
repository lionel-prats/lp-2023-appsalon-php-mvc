document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});
function iniciarApp(){
    servicioCreado();
}

function servicioCreado() {
    const nombreServicio = document.querySelector("#nombre");
    const servicioCreado = document.querySelector("#servicioCreado");
    if(servicioCreado.value == 1) {
        Swal.fire( { // Sweet Alert
            icon: 'success',
            title: `${nombreServicio.value}`,
            text: `Servicio actualizado correctamente`,
            button: 'OK'
        } ).then( () => { // callback 
            // setTimeout(() => {
                window.location.href = '/servicios';
            // }, 1000);
        } )
    } 
}
