<main class="contenedor seccion">
    <h2 class="<?php echo $clase; ?>" data-cy="calendario">Calendario</h2>
    <div class="calendario">
        <?php 
            use Model\Invitado;
            use Model\Categoria;

            $calendario= [];

            foreach($eventos as $evento){

                $fecha = $evento -> fecha_evento;
                $calendario[$fecha][] = $evento;
            }

            foreach($calendario as $dia => $lista_eventos):?>
            
            <h3 data-cy="dia-evento">
                <i class="fa fa-calendar"></i>
                <?php 
                    setlocale(LC_TIME,'spanish');
                    echo strftime("%A, %d de %B del %Y",strtotime($dia)); 
                ?>
            </h3>
            <div class="dia">
            <?php foreach($lista_eventos as $evento):
                $invitado = Invitado::getRegistro($evento -> invitado_id);
                $categoria = Categoria::getRegistro($evento -> categoria_id);
                ?>
                    <div class="evento" id="<?php echo $evento -> clave; ?>">
                        <p class="titulo"><?php echo $evento -> nombre_evento; ?></p>
                        <p class="hora"><i class="far fa-clock"></i><?php echo date("d-m-Y",strtotime($evento -> fecha_evento))." ".$evento -> hora_evento?></p>
                        <p><i class="fa <?php echo $categoria -> icono; ?>"></i><?php echo $categoria -> cat_evento; ?></p>
                        <p><i class="fa fa-user"></i><?php echo $invitado -> nombre_invitado . " " .$invitado -> apellido_invitado ; ?></p>
                    </div>
            <?php endforeach;?>   
            </div> 
        <?php endforeach;?>
    </div>
</main>