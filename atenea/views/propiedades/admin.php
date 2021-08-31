<main class="contenedor seccion admin">
    <h1>Administrador de Propiedades</h1>
    <?php
        if($resultado){ 
            $mensaje = mostrarNotificacion(intval($resultado));    
            if($mensaje){
    ?>
                <p class="alerta exito"><?php echo sanitizar($mensaje); ?></p>            
    <?php
            }
        }
    ?>
    
    <a class="boton-morado-inline" href="/propiedades/crear">Crear Propiedad</a>
    <a class="boton-morado-inline" href="/vendedores/crear">Crear Vendedor</a>
    
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los resultados de la consulta de propiedades en DB -->
        <?php foreach($propiedades as $propiedad):?>
            <tr>
                <td><?php echo $propiedad -> id;?></td>
                <td><?php echo $propiedad -> titulo;?></td>
                <td class="td-imagen"><img class="imagen-tabla" src="/imagenes/<?php echo $propiedad -> imagen;?>" alt="imagen 1"></td>
                <td>$ <?php echo $propiedad -> precio;?></td>
                <td>
                    <a class="boton-admin boton-verde-block" href="propiedades/actualizar?id=<?php echo $propiedad -> id; ?>">Actualizar</a>
                    <form class="w-100" method="post" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value="<?php echo $propiedad -> id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-admin boton-rojo-block" value="Eliminar">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- Mostrar los resultados de la consulta de propiedades en DB -->
            <?php foreach($vendedores as $vendedor):?>
                <tr>
                    <td><?php echo $vendedor -> id;?></td>
                    <td><?php echo $vendedor -> nombre ." ".$vendedor -> apellido;?></td>
                    <td><?php echo $vendedor -> telefono;?></td>
                    <td>
                        <a class="boton-admin boton-verde-block" href="vendedores/actualizar?id=<?php echo $vendedor -> id; ?>">Actualizar</a>
                        <form class="w-100" method="post" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor -> id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-admin boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
</main>
