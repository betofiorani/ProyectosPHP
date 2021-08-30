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
    <h3 class="card-title">Crear Categoria</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" id="form-crear-categoria" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group row">
                <label for="cat_evento" class="col-sm-2 col-form-label">Nombre de la Categoría:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cat_evento" name="categoria[cat_evento]" placeholder="Nombre Categoría" value="<?php echo sanitizar($categoria -> cat_evento); ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="icono" class="col-sm-2 col-form-label">Codigo del icono:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="icono" name="categoria[icono]" placeholder="código del icono en font awesome" value="<?php echo sanitizar($categoria -> icono); ?>">
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <input type="hidden" id="accion" name="evento[accion]" value="<?php echo $accion;?>">
            <input type="hidden" id="categoria-id" value="<?php echo $categoria -> id;?>">
            <button type="submit" class="btn btn-info"><?php echo $texto;?></button>
        </div>
        <!-- /.card-footer -->
    </form>
</div>
<!-- /.card -->