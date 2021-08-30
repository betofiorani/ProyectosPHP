<h2>Precios</h2>
<div class="contenedor contenido-precios">
<?php foreach($pases as $pase):?>
    <div class="info-precios">
        <p class="pase"><?php echo $pase -> nombre_pase?></p>
        <p class="precio"><?php echo $pase -> precio?></p>
        <p class="detalle"><i class="fas fa-check"></i>Bocadillos Gratis</p>
        <p class="detalle"><i class="fas fa-check"></i>Todas las Conferencias</p>
        <p class="detalle"><i class="fas fa-check"></i>Todos los Talleres</p>
        <div class="alinear-centro"><a class="boton hollow" href="registro">Comprar</a></div>
    </div>
<?php endforeach;?>
</div>