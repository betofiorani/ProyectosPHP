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
    <form class="form-horizontal" method="POST" id="form-crear-admin" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="usuario" name="usuario[usuario]" placeholder="usuario" value="<?php echo sanitizar($administrador -> usuario); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombre" name="usuario[nombre]" placeholder="Nombre" value="<?php echo sanitizar($administrador -> nombre); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="usuario[password]" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="repetir-password" class="col-sm-2 col-form-label">Repetir Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="repetir-password" placeholder="Repetir Password" value="">
                    <span id="resultado-password" class="help-block"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="imagen" class="col-sm-2 col-form-label">imagen:</label>
                <div class="col-sm-10">
                    <input type="file" id="imagen" name="usuario[imagen]" accept="image/jpeg,image/png">
                    <?php if($administrador -> imagen):?>
                        <img class="imagen-small" src="/build/img/<?php echo $administrador -> imagen;?>" alt="imagen usuario" loading="lazy">
                    <?php endif;?>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="hidden" id="accion" name="usuario[accion]" value="<?php echo $accion;?>">
            <input type="hidden" id="admin-id" value="<?php echo $administrador -> id;?>">
            <button type="submit" class="btn btn-info"><?php echo $texto;?></button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->