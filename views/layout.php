<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Salón</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <div class="contenedor-app">
        <div class="imagen"></div>
        <div class="app">
            <?php echo $contenido; ?>
        </div>
    </div>     

    <?php 
        echo $script ?? ''; 
        // VIDEO 491
        // de esta manera cargamos un archivo .js, que puede o no estar definido en el archivo correspondiente a cada vista. 
        // de esta manera estamos diciendo "imprimí $script, si no existe, no imprimí lo que haya después de ?? (en este caso, un string vacío)"
        // es una especie de if ternario
        // a "??" le llamamos placeholder
    ?>

</body>
</html>