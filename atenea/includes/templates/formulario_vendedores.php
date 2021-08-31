<fieldset>
    <legend>Crear Vendedor</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre del vendedor" value="<?php echo sanitizar($vendedor -> nombre); ?>">
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del vendedor" value="<?php echo sanitizar($vendedor -> apellido); ?>">
    <label for="telefono">Teléfono:</label>
    <input type="phone" id="telefono" name="vendedor[telefono]" placeholder="Teléfono formato Whats App" value="<?php echo sanitizar($vendedor -> telefono); ?>">
</fieldset>