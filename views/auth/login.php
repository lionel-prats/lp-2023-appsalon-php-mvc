<h1 class="nombre-pagina">Login</h1>

<p class="descripcion-pagina">Inicia sesión con tus datos</p>

<form action="/" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input 
            type="email"
            id="email"
            placeholder="tucorreo@correo.com"
            name="email"     
        >
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input 
            type="password"
            id="password"
            placeholder="Ingresa tu contraseña"
            name="password"     
        >
    </div>
    <input type="submit" value="Iniciar Sesión" class="boton">
</form>
<!-- <div class="acciones">
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div> -->
<?php 
    echo $componenteEnlacesForm;
?>