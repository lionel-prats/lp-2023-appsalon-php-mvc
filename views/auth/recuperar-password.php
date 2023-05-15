<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

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