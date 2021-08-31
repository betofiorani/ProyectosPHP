<main class="contenedor seccion">
    <h1>Modificar Propiedad</h1>
    <a class="boton-morado-inline" href="/admin">Volver</a>
    <?php 
        // Valores de las variables traidas en la consulta
        $titulo = $propiedad -> titulo;
        $precio = $propiedad -> precio;
        $nombreImagen = $propiedad -> imagen;
        $descripcion = $propiedad -> descripcion;
        $habitaciones = $propiedad -> habitaciones;
        $wc = $propiedad -> wc;
        $cocheras = $propiedad -> cocheras;
        $vendedorId = $propiedad -> vendedorId;

        // mostrar errores
        foreach($errores as $error){ ?>
        <div class="alerta error">        
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ .'/formulario.php'; ?>
        <input class="boton-morado-inline" type="submit" value="Actualizar Propiedad">
    </form>    