<?php 

    $accion = "crear";
    $texto = "Crear";
    if($id !== ''){
        $accion = "actualizar";
        $texto = "Actualizar";
    }
?>

<!-- Horizontal Form -->
<div class="card card-info col-10">
    <div class="card-header">
    <h3 class="card-title">Crear Registrado</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" id="form-crear-registrado" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label for="nombre_registrado" class="col-sm-2 col-form-label">Nombre del registrado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_registrado" name="registrado[nombre_registrado]" placeholder="Nombre Registrado" value="<?php echo sanitizar($registrado -> nombre_registrado); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellido_registrado" class="col-sm-2 col-form-label">Apellido del registrado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="apellido_registrado" name="registrado[apellido_registrado]" placeholder="Apellido Registrado" value="<?php echo sanitizar($registrado -> apellido_registrado); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email_registrado" class="col-sm-2 col-form-label">Email del registrado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email_registrado" name="registrado[email_registrado]" placeholder="Email Registrado" value="<?php echo sanitizar($registrado -> email_registrado); ?>">
                </div>
            </div>
            <h3>Elige tus boletos</h3>
            <div id="paquetes" class="contenedor contenido-precios paquetes">
                <?php 
                    foreach($pases as $pase):?>
                    <div class="info-precios">
                        <p class="pase"><?php echo $pase -> nombre_pase?></p>
                        <p class="precio"><?php echo $pase -> precio?></p>
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
                        <label class="col-form-label" for="camisa_evento">Camisa del Evento $500 <small>(descuento 7%)</small></label>
                        <input type="number" name="registrado[pases_articulos][camisas][camisas-cantidad]" id="camisa_evento" min="0" placeholder="0">
                        <input type="hidden" name="registrado[pases_articulos][camisas][camisas-precio]" id="precio_camisa_evento" value="500">
                    </div>
                    <div class="orden">
                        <label class="col-form-label" for="etiquetas">Paquete de 10 etiquetas $200 <small>(HTML5, CSS3, JS, CHROME, REACT)</small></label>
                        <input type="number" name="registrado[pases_articulos][etiquetas][etiquetas-cantidad]" id="etiquetas" min="0" placeholder="0">
                        <input type="hidden" name="registrado[pases_articulos][etiquetas][etiquetas-precio]" id="precio_etiquetas" value="200">
                    </div>
                    <div class="orden">
                        <label class="col-form-label" for="regalo">Seleccione un Regalo</label>
                        <select id="regalo" name="registrado[regalo_id]">
                            <option value="" selected disabled>--seleccione--</option>
                            <?php foreach($regalos as $regalo):?>
                            <option value="<?php echo $regalo -> id;?>"><?php echo $regalo -> nombre_regalo;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
        </div> 
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="hidden" id="accion" name="registrado[accion]" value="<?php echo $accion;?>">
            <input type="hidden" id="registrado-id" value="<?php echo $registrado -> id;?>">
            <button type="submit" class="btn btn-info"><?php echo $texto;?></button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->