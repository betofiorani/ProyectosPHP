<?php  
    use Model\Regalo;
    use Model\Evento;
    include_once __DIR__ .'/../usuarios/header.php';
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Consultar, editar o eliminar Registrados</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="registros" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Nombre y Apellido</th>
                            <th>Email</th>
                            <th>Fecha de Alta</th>
                            <th class="width-300">Pases</th>
                            <th class="width-300">Talleres</th>
                            <th>Regalo Elegido</th>
                            <th>Total a Pagar</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach ($registrados as $registrado):

                            $regalo = Regalo::getRegistro($registrado -> regalo_id);
                    ?>
                    <tr id="registro-<?php echo $registrado -> id;?>">
                        <td><?php echo $registrado -> id;?></td>
                        <td><?php echo $registrado -> nombre_registrado." ".$registrado -> apellido_registrado;
                                echo $registrado -> pagado === '1' ? '<span class="badge bg-green">Pagado</span>' : '<span class="badge bg-red">Pendiente</span>';
                            ?>
                        
                        </td>
                        <td><?php echo $registrado -> email_registrado;?></td>
                        <td><?php echo $registrado -> fecha_registro;?></td>
                        <td class="width-300"><?php 
                                $articulos = json_decode($registrado -> pases_articulos,true);

                                $llaves = array(
                                    'pase-1' => 'Pase 1 Día',
                                    'pase-2' => 'Pase 2 Días',
                                    'pase-3' => 'Pase 3 Días',
                                    'camisas' => 'Camisas',
                                    'etiquetas' => 'Etiquetas',
                                    'pase-cant-1' => 'cantidad',
                                    'pase-cant-2' => 'cantidad',
                                    'pase-cant-3' => 'cantidad',
                                    'pase-precio-1' => 'precio',
                                    'pase-precio-2' => 'precio',
                                    'pase-precio-3' => 'precio',
                                    'camisas-precio' => 'precio',
                                    'camisas-cantidad' => 'cantidad',
                                    'etiquetas-precio' => 'precio',
                                    'etiquetas-cantidad' => 'cantidad',
                                    'pase-cantidad-1' => 'cantidad',
                                    'pase-cantidad-2' => 'cantidad',
                                    'pase-cantidad-3' => 'cantidad'

                                );
                                
                                foreach ($articulos as $producto => $precioCantidad){
                                    
                                    echo "<div class='articulo'><p>$llaves[$producto]</p><div class='precioCantidad'>";
                                    foreach ($precioCantidad as $atributo => $valor){
                                        if($valor === ''){
                                            echo "<p>{$llaves[$atributo]} : 0</p>";
                                        } else {
                                            echo "<p>{$llaves[$atributo]} : {$valor}</p>";
                                        }
                                        
                                    }
                                    echo "</div></div>";
                                
                                }
                            ?>
                        </td>
                        <td class="width-300">
                            <?php 
                                $talleres=  json_decode($registrado -> talleres_registrados,true);
                                
                                foreach ($talleres['eventos'] as $evento){
                                    $eventoElegido = Evento::getRegistroValorLimit('clave',$evento,1);
                                    echo $eventoElegido -> nombre_evento." | ".$eventoElegido -> fecha_evento." | ".$eventoElegido -> hora_evento."</br>";
                                }
                            ?>
                        </td>
                        <td><?php echo $regalo -> nombre_regalo;?></td>
                        <td><?php echo $registrado -> total_pagado;?></td>
                        <td>
                            <a class="btn bg-orange btn-flat margin" href="crear?id=<?php echo $registrado -> id;?>"><i class="fa fa-pencil-alt"></i></a>
                            <a class="btn bg-maroon btn-flat margin borrar-registrado" href="#" data-id="<?php echo $registrado -> id;?>" data-accion="eliminar"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        endforeach;
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Nombre y Apellido</th>
                        <th>Email</th>
                        <th>Fecha de Alta</th>
                        <th>Pases</th>
                        <th>Talleres</th>
                        <th>Regalo Elegido</th>
                        <th>Total a Pagar</th>
                        <th>Estado del Pago</th>
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