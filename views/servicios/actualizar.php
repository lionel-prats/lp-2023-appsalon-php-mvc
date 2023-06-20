<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Modifica los valores del formulario</p>
<?php 
    include_once __DIR__ . "/../templates/barra.php"; 
    include_once __DIR__ . "/../templates/alertas.php";
?>
<form action="/servicios/actualizar" method="POST" class="formulario">
    <input type="hidden" name="id" value="<?php echo s($servicio->id); ?>">
    <?php include_once __DIR__ . "/formulario.php"; ?>
    <input type="hidden" id="servicioCreado" value="<?php echo $servicioCreado; ?>">
    <input type="submit" value="Actualizar Servicio" class="boton">
</form>

<?php 
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src=\"/build/js/admin.js\"></script>
    "; 
?>