<?php  

    include_once __DIR__ .'/../usuarios/header.php';
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Consultar, editar o eliminar Invitados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Descripción</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($invitados as $invitado):
                    ?>
                    <tr id="registro-<?php echo $invitado -> id;?>">
                        <td><?php echo $invitado -> nombre_invitado;?></td>
                        <td><?php echo $invitado -> apellido_invitado;?></td>
                        <td><?php echo $invitado -> descripcion;?></td>
                        <td><img src="../build/img/<?php echo sanitizar($invitado -> imagen);?>" width="200"></td>
                        <td>
                            <a class="btn bg-orange btn-flat margin" href="crear?id=<?php echo $invitado -> id;?>"><i class="fa fa-pencil-alt"></i></a>
                            <a class="btn bg-maroon btn-flat margin borrar-invitado" href="#" data-id="<?php echo $invitado -> id;?>" data-accion="eliminar"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Descripción</th>
                            <th>Imagen</th>
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