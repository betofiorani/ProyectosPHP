
    <?php 
        include_once __DIR__ .'/header.php';
        
        $clase ="";
        
        if($resultado === ''){
            $mensaje = '';
            $clase = 'ocultar';
        }
        else if($resultado === '1'){
            $mensaje = 'Administrador creado Exitosamente';
        } else {
            $mensaje = 'Algo salió mal';
        }

        // mostrar errores
        foreach($errores as $error){ ?>
        <div class="alerta error">        
            <?php echo $error; ?>
        </div>
    <?php } ?>
     <!-- Main content -->
     <section class="content">
         <p class="alerta <?php echo $clase; ?>"><?php echo $mensaje; ?></p>
         <?php include __DIR__ .'/formulario.php'; ?>
    </section>
    <!-- /.content -->