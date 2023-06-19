<h1 class="nombre-pagina">Panel de Administración</h1>

<?php include_once __DIR__ . "/../templates/barra.php"; ?>

<h2>Buscar Citas</h2>

<div id="busqueda">
    <form action="" class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input 
                type="date"
                id="fecha"
                name="fecha"
                value="<?php echo $fecha; ?>"
            >
        </div>
    </form>
</div>
<div id="citas-admin">
    <ul class="citas">
        <?php
            $idCita = ""; 
            foreach($citas as $key => $cita): 
                if($idCita !== $cita->id): 
                    // cuando el registro iterado se corresponda con un nuevo id de citasservicios, siempre va a entrar a este if, entonces es un lugar seguro para inicializar la variable $total (VIDEO 537)
                    $total = 0; 

                    $idCita = $cita->id;       
        ?>  
                    <li>
                        <p>ID: <span><?php echo $cita->id; ?></span></p>
                        <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                        <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                        <p>Email: <span><?php echo $cita->email; ?></span></p>
                        <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>
                        <h3>Servicios</h3>
                <?php endif; ?>
                <p class="servicio"><?php echo $cita->servicio . " $" . $cita->precio; ?></p>

                <?php 
                    $actual = $cita->id; // id del registro iterado
                    $proximo = $citas[$key + 1]->id ?? 0; // id del registro siguiente al iterado

                    // observar que no hay conflicto de SCOPE, ya que la variable $total existe en todas las iteraciones del foreach (VIDEO 537)
                    $total += $cita->precio;

                    if(esUltimo($actual, $proximo)):
                ?>
                        <p class="total">Total: <span><?php echo "$$total"; ?></span></p>
                <?php endif; ?>
            <?php endforeach; ?>
            <!-- tip HTML: observar que no estoy cerrando ninguna etiqueta <li>, pero si inspecciono desde el navegador el DOM, compruebo que HTML cerro cada uno de los <li> automaticamente (VIDEO 536) -->
    </ul>
</div>