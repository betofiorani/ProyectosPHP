<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="titulo-contacto" >Contacto</h1>
    
    <?php if($mensaje): ?>
    <p data-cy="alerta-envio" class="alerta exito"><?php echo $mensaje; ?></p>
    <?php endif; ?>
    
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
    </picture>
    
    <h2 data-cy="titulo-formulario">Llene el formulario de contacto</h2>
    <form data-cy="formulario-contacto" class="formulario" action="/contacto" method ="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre:</label>
            <input data-cy="input-nombre" id="nombre" name="contacto[nombre]" type="text" placeholder="Tu Nombre es...">                
            <label for="mensaje">Mensaje:</label>
            <textarea data-cy="input-mensaje" id="mensaje" name="contacto[mensaje]"></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la Propiedad</legend>
            <label for="operacion">Tipo de operación</label>
            <select data-cy="select-operacion" id="operacion" name="contacto[operacion]">
                <option value="" disabled selected>-- Seleccione...--</option>
                <option value="alquiler">Alquiler</option>
                <option value="Compra">Compra</option>
                <option value="Venta">Venta</option>
            </select>
            <label for="precio">Precio o Presupuesto:</label>
            <input data-cy="input-precio" id="precio" name="contacto[precio]" type="number" placeholder="Cual es tu presupuesto o precio pretendido">                
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>
            <p>¿Cómo desea ser contactado?</p>
            <div class="forma-contacto">
                <label for="contacto-telefono">Teléfono</label>
                <input data-cy="input-forma-contacto" id="contacto-telefono" name="contacto[tipo-contacto]" type="radio" value="telefono">
                <label for="contacto-mail">Mail</label>
                <input data-cy="input-forma-contacto" id="contacto-mail" name="contacto[tipo-contacto]" type="radio" value="mail">
                <label for="contacto-whatsapp">WhatsApp</label>
                <input data-cy="input-forma-contacto" id="contacto-whatsapp" name="contacto[tipo-contacto]" type="radio" value="whatsapp">
            </div>
            <div id="contacto"></div>
        </fieldset>
        <input type="submit" class="boton-morado" value="Enviar">
    </form>
</main>