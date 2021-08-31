<main class="contenedor seccion">
    <h1>Crear Nueva Propiedad</h1>
    <a class="boton-morado-inline" href="/admin">Volver</a>
    
    <?php 
        // mostrar errores
        foreach($errores as $error){ ?>
        <div class="alerta error">        
            <?php echo $error; ?>
        </div>
    <?php } ?>
    
    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ .'/formulario.php'; ?>
        <input class="boton-morado-inline" type="submit" value="Crear Propiedad">
    </form>
</main>