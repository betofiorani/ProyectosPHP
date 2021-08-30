<?php  
    include_once 'header.php';
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Consultar, editar o eliminar administradores</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($administradores as $administrador):
                    ?>
                    <tr id="registro-<?php echo $administrador -> id;?>">
                        <td><?php echo $administrador -> usuario;?></td>
                        <td><?php echo $administrador -> nombre;?></td>
                        <td>
                            <a class="btn bg-orange btn-flat margin" href="crear?id=<?php echo $administrador -> id;?>"><i class="fa fa-pencil-alt"></i></a>
                            <a class="btn bg-maroon btn-flat margin borrar-registro" href="#" data-id="<?php echo $administrador -> id;?>" data-accion="eliminar"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Usuario</th>
                        <th>Nombre</th>
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