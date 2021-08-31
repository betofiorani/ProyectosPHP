<?php 

    use App\Propiedad;
    
    if(!$limit){
        $propiedades = Propiedad::getAll();
    } else {
        $propiedades = Propiedad::getLimit($limit);
    }
?>

<div class="contenedor-anuncios">
    <?php 
        foreach($propiedades as $propiedad):
    ?>
    <div class="anuncio">
        <picture>
            <!-- <source srcset="build/img/anuncio1.webp" type="image/webp">
            <source srcset="build/img/anuncio1.jpg" type="image/jpeg"> -->
            <img loading="lazy" src="imagenes/<?php echo $propiedad ->imagen; ?>" alt="anuncio 1">
        </picture>
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad -> titulo; ?></h3>
            <p><?php echo $propiedad -> descripcion; ?></p>
            <p class="precio">U$s <?php echo $propiedad ->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="icono-wc">
                    <p><?php echo $propiedad ->wc; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono-dormitorio">
                    <p><?php echo $propiedad -> habitaciones; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono-cochera">
                    <p><?php echo $propiedad -> cocheras; ?></p>
                </li>
            </ul>
            <a class="boton boton-morado" href="anuncio.php?id=<?php echo $propiedad -> id; ?>">Ver Propiedad</a>
        </div>
    </div> <!-- fin anuncio -->
    <?php 
        endforeach; 
    ?>
</div>