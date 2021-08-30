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
    <h3 class="card-title">Crear Invitado</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" id="form-crear-invitado" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label for="nombre_invitado" class="col-sm-2 col-form-label">Nombre del Invitado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre_invitado" name="invitado[nombre_invitado]" placeholder="Nombre Invitado" value="<?php echo sanitizar($invitado -> nombre_invitado); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="apellido_invitado" class="col-sm-2 col-form-label">Apellido del Invitado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="apellido_invitado" name="invitado[apellido_invitado]" placeholder="Apellido Invitado" value="<?php echo sanitizar($invitado -> apellido_invitado); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="descripcion" class="col-sm-2 col-form-label">Descripción del Invitado:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="descripcion" name="invitado[descripcion]" row="8" placeholder="quien es nuestro invitado"><?php echo sanitizar($invitado -> descripcion); ?></textarea> 
                </div>
            </div>
            <?php
                if($accion === 'actualizar'):
            ?>
            <div class="form-group row">
                <label for="imagen Actual" class="col-sm-2 col-form-label">Imagen cargada:</label>
                <div class="col-sm-10">
                    <img src="../build/img/<?php echo sanitizar($invitado -> imagen);?>" width="450">
                </div>
            </div>    

            <?php endif; ?>
            <div class="form-group row">
                <label for="url_imagen" class="col-sm-2 col-form-label">Foto del Invitado:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="imagen" name="invitado[imagen]" value="<?php echo sanitizar($invitado -> imagen); ?>">
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="hidden" id="accion" name="accion" value="<?php echo $accion;?>">
            <input type="hidden" id="invitado-id" value="<?php echo $invitado -> id;?>">
            <button type="submit" class="btn btn-info"><?php echo $texto;?></button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->