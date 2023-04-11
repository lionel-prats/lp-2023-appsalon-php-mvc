<h1 class="nombre-pagina">Olvidé Pasword</h1>

<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuación</p>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="Tu Email"
            name="email"     
        >
    </div>
    <input type="submit" value="Enviar Instrucciones" class="boton">
</form>
<!-- <div class="acciones">
    <a href="/">Login</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div> -->
<?php 
    echo $componenteEnlacesForm;
?>