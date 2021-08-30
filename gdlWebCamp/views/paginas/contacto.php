<main class="contenedor seccion contenido-centrado">
    <h2 data-cy="titulo-contacto" >Suscribite a nuestro Newsletter</h2>
    
    <?php if($mensaje): ?>
    <p data-cy="alerta-envio" class="alerta exito"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    
    <h4 data-cy="titulo-formulario">Llene el formulario de contacto</h4>
    <form data-cy="formulario-contacto" class="formulario" action="/contacto" method ="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input data-cy="input-nombre" id="nombre" name="contacto[nombre]" type="text" placeholder="Tu Nombre es...">                
            <label for="email">Email:</label>
            <input data-cy="input-mail" id="email" name="contacto[email]" type="text" placeholder="Tu mail es...">                
        </fieldset>
        <input type="submit" class="boton" value="Enviar">
    </form>
</main>