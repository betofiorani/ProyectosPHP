<section class="seccion contenedor">
    <h2>Registro de Usuarios</h2>
    <form id="registro" class="registro formulario" method="POST" action="">
        <div id="datos_usuario" class="registro caja">
            <div>
                <div class="campo">
                    <label for="nombre" >Nombre:</label>
                    <input class="input-datos" id="nombre" name="registrado[nombre_registrado]" type="text" placeholder="Tu nombre...">
                </div>
                <div class="campo">
                    <label for="apellido" >Apellido:</label>
                    <input class="input-datos" id="apellido" name="registrado[apellido_registrado]" type="text" placeholder="Tu apellido...">
                </div>
                <div class="campo">
                    <label for="email" >Email:</label>
                    <input class="input-datos" id="email" name="registrado[email_registrado]" type="email" placeholder="Tu Email...">
                </div>
            </div>
            <?php foreach($errores as $error): ?>
                <div id="error">
                <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <h3>Elige tus boletos</h3>
        <div id="paquetes" class="contenedor contenido-precios paquetes">
            <?php 
                foreach($pases as $pase):?>
                <div class="info-precios">
                    <p class="pase"><?php echo $pase -> nombre_pase?></p>
                    <p class="precio"><?php echo $pase -> precio?></p>
                    <p class="detalle"><i class="fas fa-check"></i>Bocadillos Gratis</p>
                    <p class="detalle"><i class="fas fa-check"></i>Todas las Conferencias</p>
                    <p class="detalle"><i class="fas fa-check"></i>Todos los Talleres</p>
                    <div class="alinear-centro orden">
                        <label for="pase_dia">Boletos Deseados:</label>
                        <input class="cantidadPase" id="pase<?php echo $pase -> id?>" type="number" name="registrado[pases_articulos][pase-<?php echo $pase -> id?>][pase-cantidad-<?php echo $pase -> id?>]" min="0" placeholder="0">
                        <input type="hidden" name="registrado[pases_articulos][pase-<?php echo $pase -> id?>][pase-precio-<?php echo $pase -> id?>]" value="<?php echo $pase -> precio?>">
                    </div>
                </div>
            <?php endforeach;?>
        </div>
        <!-- AQUI DEBERIA TRAER LOS EVENTOS DESDE LA BASE DE DATOS -->
        <div id="eventos" class="eventos">
            <h3>Elige a que evento asistirás</h3>
            <div class="caja"> 
                <?php 
                    use Model\Evento;
                foreach($dias as $dia => $fecha):?>
                <div id="<?php echo strtolower($dia);?>">
                    <h4><?php echo $dia;?></h4>
                    <div class="contenido-dia">
                        <?php foreach($categorias as $categoria):
                            $eventos = Evento::getAllCondicion("fecha_evento ='{$fecha[0]}' AND categoria_id ='{$categoria -> id}'");
                        ?>
                        <div>
                            <p><?php echo $categoria -> cat_evento;?></p>
                            <?php foreach($eventos as $evento):?>
                            <div class="flex">
                                <input type="checkbox" name="registrado[talleres_registrados][eventos][]" id="<?php echo $evento -> clave; ?>" value="<?php echo $evento -> clave; ?>">    
                                <time><?php echo $evento -> hora_evento; ?></time>
                                <label><?php echo $evento -> nombre_evento; ?></label>
                            </div>    
                            <?php endforeach; // fin del foreach que trae eventos según categoría para el día en cuestión?>    
                        </div>
                        <?php endforeach; // fin del foreach que trae las categoría?>    
                    </div>
                </div>
                <?php endforeach; // fin del foreach que trae los días?>    
                </div>
            </div><!--.caja-->
        </div> <!--#eventos-->
        <div id="resumen" class="resumen">
            <h3>Pagos y Extras</h3>
            <div class="caja flex">
                <div class="extras">
                    <div class="orden">
                        <label for="camisa_evento">Camisa del Evento $500 <small>(descuento 7%)</small></label>
                        <input type="number" name="registrado[pases_articulos][camisas][camisas-cantidad]" id="camisa_evento" min="0" placeholder="0">
                        <input type="hidden" name="registrado[pases_articulos][camisas][camisas-precio]" id="precio_camisa_evento" value="500">
                    </div>
                    <div class="orden">
                        <label for="etiquetas">Paquete de 10 etiquetas $200 <small>(HTML5, CSS3, JS, CHROME, REACT)</small></label>
                        <input type="number" name="registrado[pases_articulos][etiquetas][etiquetas-cantidad]" id="etiquetas" min="0" placeholder="0">
                        <input type="hidden" name="registrado[pases_articulos][etiquetas][etiquetas-precio]" id="precio_etiquetas" value="200">
                    </div>
                    <div class="orden">
                        <label for="regalo">Seleccione un Regalo</label>
                        <select id="regalo" name="registrado[regalo_id]">
                            <option value="" selected disabled>--seleccione--</option>
                            <?php foreach($regalos as $regalo):?>
                            <option value="<?php echo $regalo -> id;?>"><?php echo $regalo -> nombre_regalo;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <input type="button" id="calcular" class="boton" value="Calcular">
                </div>
                <div class="total">
                    <p class="titulos">Resumen:</p>
                    <div id="lista-productos">
                    </div>
                    <p class="titulos">Total:</p>
                    <div id="suma-total">
                    </div>
                    <input type="hidden" name="registrado[total_pagado]" id="total_pagado">
                    <input type="submit" id="btnRegistro" name="submit" class="boton" value="pagar">
                </div>
            </div>
        </div> 
    </form>
</section>