<?php  

    include_once __DIR__ .'/../usuarios/header.php';
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Consultar, editar o eliminar Eventos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Categoria</th>
                    <th>$icono</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($categorias as $categoria):
                    ?>
                    <tr id="registro-<?php echo $categoria -> id;?>">
                        <td><?php echo $categoria -> cat_evento;?></td>
                        <td><?php echo $categoria -> icono;?></td>
                        <td>
                            <a class="btn bg-orange btn-flat margin" href="crear?id=<?php echo $categoria -> id;?>"><i class="fa fa-pencil-alt"></i></a>
                            <a class="btn bg-maroon btn-flat margin borrar-categoria" href="#" data-id="<?php echo $categoria -> id;?>" data-accion="eliminar"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Categoria</th>
                        <th>Icono</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->