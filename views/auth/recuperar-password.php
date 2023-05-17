<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php include_once __DIR__ . "/../templates/alertas.php"; ?>


<?php
    // $error es un boolean que viene del controlador
    // la idea es que si es true se corte la ejecucion y no se renderize el resto del contenido HTML del archivo (<form> y <a><a>($componentEnlacesForm)) 
    if ($error) return; 
?>

<!-- omito el action="xxx" para que al submitear el form no se pierda de la URL el token, ya que lo necesito (VIDEO 485) -->
<form class="formulario" method="POST" novalidate>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            name="password"     
            placeholder="Tu Nuevo Password"
        >
    </div>
    <input type="submit" value="Guardar Nuevo Password" class="boton">
</form>

<?php 
    echo $componenteEnlacesForm;
?>