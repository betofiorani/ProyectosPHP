<main class="contenedor seccion">
    <h1>Modificar Vendedor</h1>
    <a class="boton-morado-inline" href="/admin">Volver</a>
    
<?php
    // Valores de las variables traidas en la consulta
    $nombre = $vendedor -> nombre;
    $apellido = $vendedor -> apellido;
    $telefono = $vendedor -> telefono;
    
    // mostrar errores
    foreach($errores as $error){ ?>
    <div class="alerta error">        
        <?php echo $error; ?>
    </div>
<?php } ?>
    <form class="formulario" method="POST" enctype="multipart/form-data"> <!-- si no le pones un action ejecuta el mismo archivo --> 
        <?php include __DIR__ . '/formulario.php';?>
        <input class="boton-morado-inline" type="submit" value="Actualizar Vendedor">
    </form>
</main>