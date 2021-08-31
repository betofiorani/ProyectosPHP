<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo de la Propiedad" value="<?php echo sanitizar($propiedad -> titulo); ?>">
    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio de la Propiedad" value="<?php echo sanitizar($propiedad -> precio); ?>">
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg,image/png">
    <?php if($propiedad -> imagen):?>
        <img class="imagen-small" src="/imagenes/<?php echo $propiedad -> imagen;?>" alt="imagen propiedad" loading="lazy">
    <?php endif;?>
    <label for="descripcion">Descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad -> descripcion); ?></textarea>
</fieldset>
<fieldset>
    <legend>Información de la Propiedad</legend>
    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Cantidad de Habitaciones" min="1" max="9"  value="<?php echo sanitizar($propiedad -> habitaciones); ?>">
    <label for="wc">Baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Cantidad de Baños" min="1" max="9" value="<?php echo sanitizar($propiedad -> wc); ?>">
    <label for="cocheras">Cocheras:</label>
    <input type="number" id="cocheras" name="propiedad[cocheras]" placeholder="Cantidad de Cocheras" min="0" max="9" value="<?php echo sanitizar($propiedad -> cocheras); ?>">
</fieldset>
<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select id="vendedor" name="propiedad[vendedorId]">
        <option selected disabled>Seleccione un Vendedor</option>
        <?php 
            foreach($vendedores as $vendedor) :
        ?>
        <option <?php echo $vendedor -> id === $propiedad -> vendedorId ? 'selected' : ''; ?> value="<?php echo sanitizar($vendedor -> id);?>"><?php echo sanitizar($vendedor -> nombre ." ". $vendedor -> apellido);?></option>

        <?php endforeach; ?>
    </select>
</fieldset>