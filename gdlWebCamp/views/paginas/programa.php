<div class="contenedor-video">
    <video autoplay muted="muted" loop poster="build/img/bg-talleres.webp">
        <source src="build/video/video.mp4" type="video/mp4">
        <source src="build/video/video.webm" type="video/webm">
        <source src="build/video/video.ogv" type="video/ogg">
    </video>
</div>
<div class="contenido-programa">
    <div class="contenedor">
        <div class="programa-evento">
            <h2>Programa del Evento</h2>
            <nav class="programa-menu">
                <?php 
                    use Model\Invitado;
                    use Model\Evento;
                    $tipoCategoria = [];

                    foreach($categorias as $categoria):
                        $activo = "";
                        $eventos = Evento::getRegistroValorLimit('categoria_id',$categoria -> id, 2);
                        foreach($eventos as $evento){
                            $tipoCategoria[$categoria -> cat_evento][] = $evento;
                        }
                        if($categoria -> id == 1){
                            $activo = 'activo';
                        }
                ?>
                    <a href="#<?php echo strtolower($categoria -> cat_evento);?>" class="<?php echo $activo;?>">
                        <i class="fa <?php echo $categoria -> icono;?>"></i>
                        <?php echo $categoria -> cat_evento;?>
                    </a>
                <?php endforeach;?>
            </nav>
            <?php 
            foreach($tipoCategoria as $nombre_cat => $listaEventos):
                $ocultar = "";
                if($nombre_cat !=='Seminarios'){
                    $ocultar = "ocultar";
                }
            ?>
            <div id="<?php echo strtolower($nombre_cat);?>" class="info-curso <?php echo $ocultar;?>">
                <?php
                    setlocale(LC_TIME,'spanish');
                    foreach($listaEventos as $evento):  
                    $invitado = Invitado::getRegistro($evento -> invitado_id);
                ?>
                <div class="detalle-evento">
                    <h3><?php echo $evento -> nombre_evento;?></h3>
                    <p><i class="far fa-clock"></i><?php echo $evento -> hora_evento;?></p>
                    <p><i class="far fa-calendar-check"></i><?php echo strftime("%A, %d de %B",strtotime($evento -> fecha_evento));?></p>
                    <p><i class="fa fa-user"></i><?php echo $invitado -> nombre_invitado." ".$invitado -> apellido_invitado;?></p>
                </div>
                <?php endforeach;?>
                <div class="alinear-derecha">
                    <a class="boton" href="#">Ver Todos</a>
                </div>
            </div>
            <?php endforeach;?>            
        </div>
    </div>
</div>