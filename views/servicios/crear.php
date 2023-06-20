<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir un nuevo servicio</p>
<?php 
    include_once __DIR__ . "/../templates/barra.php"; 
    include_once __DIR__ . "/../templates/alertas.php";
?>
<form action="/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    <input type="hidden" id="servicioCreado" value="<?php echo $servicioCreado; ?>">
    <input type="submit" value="Guardar Servicio" class="boton">
</form>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src=\"/build/js/admin.js\"></script>
    "; 
?>