<h1 class="nombre-pagina">Crear Nueva Cita</h1>

<p class="descripcion-pagina">Elige tus servicios y coloca tus datos</p>

<div id="app">

    <!-- VIDEO 489 -->
    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Información Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elige tus servicios a continuación</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <!-- VIDEO 488 - por defecto le da un display:none en _citas.scss -->
    <div id="paso-2" class="seccion">
        <h2>Tus Datos y Cita</h2>
        <p class="text-center">Coloca tus datos y fecha de tu cita</p>
        
        <div id="contenedor-alertas"><!-- contenedor de alertas si el usuario ingresa datos invalidos en fecha u hora --></div>
        
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input 
                    id="nombre"
                    type="text"
                    placeholder="Tu nombre"
                    value="<?php echo $nombre?>"
                    disabled
                >
            </div>
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input 
                    id="fecha"
                    type="date"
                    min="<?php echo date('Y-m-d', strtotime('-1 day'));  /* VIDEO 508 */ ?>"
                    max="<?php echo date('Y-m-d', strtotime('+12 days')); /* VIDEO 508 */ ?>"
                >
            </div>
            <div class="campo">
                <label for="hora">Hora</label>
                <input 
                    id="hora"
                    type="time"
                >
            </div>  
        </form>
    </div>

    <!-- VIDEO 488 - por defecto le da un display:none en _citas.scss -->
    <div id="paso-3" class="seccion">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la información sea correcta</p>
    </div>

    <div class="paginacion">
        <button 
            id="anterior" 
            class="boton"
        >&laquo; Anterior</button>
        <button 
            id="siguiente" 
            class="boton"
        >Siguiente &raquo;</button>
    </div>

</div>

<?php 
    $script = "
        <script src=\"build/js/app.js\"></script>
    "; 
?>