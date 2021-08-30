<h2 class="<?php echo $clase; ?>">Nuestros Invitados</h2>
<div class="contenedor galeria-invitados">
<?php foreach($invitados as $invitado):?>
    <div class="invitado">
        <a class="invitado-info" href="#invitado<?php echo $invitado -> id; ?>">
            <img src="build/img/<?php echo $invitado -> imagen?>" alt="invitado">
        </a>
        <p><?php echo $invitado -> nombre_invitado." ".$invitado -> apellido_invitado?></p>
    </div>
    <div class="ocultar">
        <div class="invitado invitado-info" id="invitado<?php echo $invitado -> id; ?>">
            <h2><?php echo $invitado -> nombre_invitado." ".$invitado -> apellido_invitado?></h2>
            <img src="build/img/<?php echo $invitado -> imagen?>" alt="invitado">
            <p><?php echo $invitado -> descripcion?></p>
        </div>
    </div>
<?php endforeach;?>
</div>




















