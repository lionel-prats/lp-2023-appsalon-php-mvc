let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

// 'DOMContentLoaded' es un evento en JavaScript que se dispara cuando el árbol DOM (Documento Object Model) de una página web ha sido completamente cargado y parseado. El evento 'DOMContentLoaded' ocurre después de que el navegador ha construido el árbol DOM a partir del código HTML de la página, pero antes de que se hayan descargado todos los recursos externos, como imágenes o scripts adicionales.
document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp(){
    mostrarSeccion(); // ejecutamos esta funcion al principio para que se arranque mostrando la seccion servicios (paso === 1)
    tabs(); // muestra y oculta las secciones de /cita segun los clicks en <div class="tabs">
    botonesPaginador() // ejecutamos esta funcion al principio para que se arranque ocultando la el boton "anterior" (paso === 1)
    paginaAnterior(); // ejecutamos esta funcion al principio para que escuche permanentemente por clicks en el boton "anterior" del paginador
    paginaSiguiente(); // ejecutamos esta funcion al principio para que escuche permanentemente por clicks en el boton "anterior" del paginador
}

function mostrarSeccion(){
    
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // quita la clase "actual" al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }
    // resalta el tab actual
    // este selector es un "selector de atributo"; captura cualquier <element data-paso="${paso}">
    // apenas se carga el documento, paso == 1 (asi lo definimos en la 1era. linea de este script), entonces va a capturar el tab "servicios"
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');
}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');
    // con la sintaxis '.tabs button' selecciono todos los <button> hijos de un <element class="tabs">

    botones.forEach( boton => {
        boton.addEventListener('click', function(e){
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion(); // muestra u oculta las secciones segun corresponda, segun los clicks en los tabs
            botonesPaginador(); // muestra u oculta los botones del paginador segun corresponda, segun los clicks en los tabs
        })
    });
}

function botonesPaginador(){
    const paginaAnterior = document.querySelector('#anterior');
    const paginaSiguiente = document.querySelector('#siguiente');

    if(paso === 1) {
        paginaAnterior.classList.add('ocultar');    
        paginaSiguiente.classList.remove('ocultar');
    } else if(paso === 3) {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.add('ocultar');    
    } else {
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }
}

function paginaAnterior() {
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', () => {
        // el return de este if corta la ejecucion de todo el Listener (VIDEO 496)
        // lo uso para que paso no siga decrementando cuando su valor es === 1
        if(paso === pasoInicial) {
            return;
        }
        paso --;
        mostrarSeccion(); // muestra u oculta las secciones segun corresponda, segun los clicks en los botones del paginador
        botonesPaginador(); // muestra u oculta los botones del paginador segun corresponda, segun los clicks en los botones del paginador
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () => {
        // el return de este if corta la ejecucion de todo el Listener (VIDEO 496)
        // lo uso para que paso no siga decrementando cuando su valor es === 1
        if(paso === pasoFinal) return; 
        paso ++;
        mostrarSeccion(); // muestra u oculta las secciones segun corresponda, segun los clicks en los botones del paginador
        botonesPaginador(); // muestra u oculta los botones del paginador segun corresponda, segun los clicks en los botones del paginador
    })
}