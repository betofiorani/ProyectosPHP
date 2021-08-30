<?php  

    use Model\Categoria;
    use Model\Invitado;

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
                    <th>Evento</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Clave</th>
                    <th>Categoria</th>
                    <th>Invitado</th>
                    <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($eventos as $evento):
                            $categoria = Categoria::getRegistro($evento ->categoria_id);
                            $invitado = Invitado::getRegistro($evento ->invitado_id);

                    ?>
                    <tr id="registro-<?php echo $evento -> id;?>">
                        <td><?php echo $evento -> nombre_evento;?></td>
                        <td><?php echo $evento -> fecha_evento;?></td>
                        <td><?php echo $evento -> hora_evento;?></td>
                        <td><?php echo $evento -> clave;?></td>
                        <td><?php echo $categoria -> cat_evento;?></td>
                        <td><?php echo $invitado -> nombre_invitado." ".$invitado -> apellido_invitado;?></td>
                        <td>
                            <a class="btn bg-orange btn-flat margin" href="crear?id=<?php echo $evento -> id;?>"><i class="fa fa-pencil-alt"></i></a>
                            <a class="btn bg-maroon btn-flat margin borrar-evento" href="#" data-id="<?php echo $evento -> id;?>" data-accion="eliminar"><i class="fa fa-trash"></i></a>
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