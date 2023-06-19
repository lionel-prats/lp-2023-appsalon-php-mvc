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
        window.location = `?fecha=${fechaSeleccionada}`;







        /* const dia = new Date(e.target.value).getUTCDay(); // obtengo el nro de dia de la semana que nos ofrece el objeto Date (0 Domingo ... 3 Miércoles ... 6 Sábado)
        if([0,6].includes(dia)) {
            mostrarAlerta(document.querySelector(`#paso-2 p`), 'afterEnd', 'Turnos disponibles de Lunes a Viernes.', 'fecha', ['alerta', 'error']); 
            cita.fecha = '';
        } else {
            const alertaPrevia = document.querySelector('[data-tipo="fecha"]');
            if(alertaPrevia) removerAlerta(alertaPrevia);
            cita.fecha = e.target.value; // si el dia ingresado para la cita es valido, lo agregamos al objeto cita
        } */
    })
}