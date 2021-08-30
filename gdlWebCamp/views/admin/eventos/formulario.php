<?php 

    $accion = "crear";
    $texto = "Crear";
    if($id !== ''){
        $accion = "actualizar";
        $texto = "Actualizar";
    }
?>

<!-- Horizontal Form -->
<div class="card card-info col-8">
    <div class="card-header">
    <h3 class="card-title">Crear Usuario</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" id="form-crear-evento" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label for="nombre_evento" class="col-sm-2 col-form-label">Nombre Evento:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_evento" name="evento[nombre_evento]" placeholder="evento" value="<?php echo sanitizar($evento -> nombre_evento); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="fecha_evento" class="col-sm-2 col-form-label">Fecha:</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="fecha_evento" name="evento[fecha_evento]" placeholder="Fecha Evento" value="<?php echo sanitizar($evento -> fecha_evento); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="hora_evento" class="col-sm-2 col-form-label">Hora:</label>
                <div class="col-sm-10">
                    <input type="time" class="form-control" id="hora_evento" placeholder="Hora Evento" name="evento[hora_evento]" value="<?php echo sanitizar($evento -> hora_evento); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="clave" class="col-sm-2 col-form-label">Código del Evento:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="clave" placeholder="Código Unico del Evento" value="<?php echo sanitizar($evento -> clave); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="categorias" class="col-sm-2 col-form-label">Categoría del Evento:</label>
                <div class="col-sm-10">
                    
                    <select class="form-control select2" id="categorias" name="evento[categoria_id]">
                    <option selected disabled>Seleccione una Categoria</option>
                        <?php 
                            foreach($categorias as $categoria) :
                        ?>
                        <option <?php echo $categoria -> id === $evento -> categoria_id ? 'selected' : ''; ?> value="<?php echo sanitizar($categoria -> id);?>"><?php echo sanitizar($categoria -> cat_evento);?></option>

                        <?php endforeach; ?>
                    </select>
                    
                </div>
            </div>
            <div class="form-group row">
                <label for="invitados" class="col-sm-2 col-form-label">Speaker Invitado:</label>
                <div class="col-sm-10">
                    
                    <select class="form-control select2" id="invitados" name="evento[invitado_id]">
                        <option selected disabled>Seleccione un Invitado</option>
                        <?php 
                            foreach($invitados as $invitado) :
                        ?>
                        <option <?php echo $invitado -> id === $evento -> invitado_id ? 'selected' : ''; ?> value="<?php echo sanitizar($invitado -> id);?>"><?php echo sanitizar($invitado -> nombre_invitado. " ".$invitado -> apellido_invitado);?></option>

                        <?php endforeach; ?>
                    </select>
                    
                </div>
            </div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="hidden" id="accion" name="evento[accion]" value="<?php echo $accion;?>">
            <input type="hidden" id="evento-id" value="<?php echo $evento -> id;?>">
            <button type="submit" class="btn btn-info"><?php echo $texto;?></button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->