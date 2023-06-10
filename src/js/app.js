let paso = 1;
const pasoInicial = 1;
const pasoFinal = 3;

// objeto de la cita, que vamos a guardar en la base de datos (VIDEO 502)
const cita = {
    nombre: '',
    fecha: '',
    hora: '',
    servicios: []
};

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
    
    consultarAPI(); // consulta la API en el backend de PHP (VIDEO 499)

}

function mostrarSeccion(){
    
    // oculta la seccion renderizada antes de un nuevo click
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior) {
        seccionAnterior.classList.remove('mostrar');
    }

    // renderiza la seccion que corresponda segun un nuevo click
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    // quita la clase "actual" al tab anterior
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior) {
        tabAnterior.classList.remove('actual');
    }
    // resalta el tab actual (agregando la clase "actual")
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
            console.clear();
            console.log(`linea 51, paso == ${paso}`);

            mostrarSeccion(); // muestra u oculta las secciones segun corresponda, segun el valor de la variable paso
            botonesPaginador(); // muestra u oculta los botones del paginador segun corresponda, segun el valor de la variable paso
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
        console.clear();
        console.log(`linea 84, paso == ${paso}`);
        mostrarSeccion(); // muestra u oculta las secciones segun corresponda, segun el valor de la variable paso
        botonesPaginador(); // muestra u oculta los botones del paginador segun corresponda, segun el valor de la variable paso
    })
}

function paginaSiguiente() {
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', () => {
        // el return de este if corta la ejecucion de todo el Listener (VIDEO 496)
        // lo uso para que paso no siga incrementando cuando su valor es === 3
        if(paso === pasoFinal) return; 
        paso ++;
        console.clear();
        console.log(`linea 99, paso == ${paso}`);
        mostrarSeccion(); // muestra u oculta las secciones segun corresponda, segun el valor de la variable paso
        botonesPaginador(); // muestra u oculta los botones del paginador segun corresponda, segun el valor de la variable paso
    })
}

// haciendo esta funcion asincrona, se sigue ejecutando el codigo de debajo sin importar que no haya terminado de ejecutarse el codigo de esta funcion (VIDEO 499)
// hacemos esta funcion asincrona ya que estamos consultando a una API y no sabemos cuanto va a demorar en traer los resultados (VIDEO 499)
async function consultarAPI(){ 
    try {
        //const url = '/api/servicios';
        const url = 'http://localhost:3000/api/servicios'; 
        const resultado = await fetch(url); // fetch nos va a permitir consumir servicios
        const servicios = await resultado.json();
        mostrarServicios(servicios);
        // de esta manera, estamos consultando la base de datos (appsalon_mvc) desde JS front, no directamente, si no que por medio de una capa de abstraccion que es nuestra API (VIDEO 499)
    } catch (error) {
        console.log(error);
    }
    /* setTimeout(() => {
        fetch('/api/servicios')
        .then(function (res) {
            return res.json();
        })
        .then(function(data){
            console.log(data);
        })
        .catch(function (e) {
            console.log(e);
        });  
    }, 5000); */
}

function mostrarServicios(servicios){ // VIDEO 500

    //console.log(servicios);

    const fragment = document.createDocumentFragment();
    servicios.forEach( (servicio, index, arrayCompleto) => {
        const {id, nombre, precio} = servicio;

        // lo vamos a hacer con scripting (VIDEO 500)
        // el scripting es mas tardado para nosotros, los que desarrollamos las aplicaciones, pero en performance es mas rapido, ademas de que es mas seguro (VIDEO 500) 
        const nombreServicio = document.createElement('P');
        nombreServicio.classList.add('nombre-servicio');
        nombreServicio.textContent = nombre;

        const precioServicio = document.createElement('P');
        precioServicio.classList.add('precio-servicio');
        precioServicio.textContent = `$${precio}`;
        
        const servicioDiv = document.createElement('DIV');
        servicioDiv.classList.add('servicio');
        servicioDiv.dataset.idServicio = id;

        // agrego un "listener" sobre cada uno de los <div>, que va a ejecutar la funcion seleccionarServicio (VIDEO 502)
        // al evento onclick le asocio un callback que ejecutara selecionarServicio cada vez que se ejecute el click sobre un <div>
        // lo hacemos de esta manera para que funcione como esperamos (explicado en el VIDEO 502)
        servicioDiv.onclick = function(){
            seleccionarServicio(servicio); 
        } 

        servicioDiv.appendChild(nombreServicio);
        servicioDiv.appendChild(precioServicio);

        fragment.appendChild(servicioDiv);
    })
    document.querySelector('#servicios').appendChild(fragment);
}

// ver explicacion en z.notas.txt -> VIDEO 502
function seleccionarServicio(servicio) {
    
    //console.clear();
    
    const {id} = servicio; // id (en la base) del servicio (des)seleccionado por el usuario desde la pantalla
    
    let {servicios} = cita; // estado de cita.usuarios, anterior al click

    const divServicio = document.querySelector([`[data-id-servicio="${id}"]`]); // <div data-id-servicio="`${id}`"> (des)clickeado por el usuario
    
    // verificar si un servicio ya fue seleccionado (VIDEO 504) 
    if( servicios.some( agregado => agregado.id === id) ) {

        // el servicio clickeado existe en cita.servicios, lo que significa que ya estaba seleccionado, entonces reescribimos cita.servicios filtrando de servicios el servicio clickeado
        cita.servicios = servicios.filter( servicio => servicio.id !== id); 
        
        // como eliminamos de cita.servicios el servicio clickeado, entonces le quitamos al <div> correspondiente la clase "seleccionado"
        divServicio.classList.remove('seleccionado');
    
    } else {

        // como el servicio clickeado no existe en cita.servicios, entonces lo agregamos
        cita.servicios = [...servicios, servicio];

        // como lo agregamos, le agregamos la clase "seleccionado" al <div> correspondiente
        divServicio.classList.add('seleccionado');
    }

    console.clear();
    console.log(cita.servicios);

}

