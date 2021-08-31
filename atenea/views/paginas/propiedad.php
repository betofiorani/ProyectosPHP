<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="titulo-propiedad"><?php echo $propiedad -> titulo; ?></h1>
    <picture>
        <!-- <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg"> -->
        <img loading="lazy" src="imagenes/<?php echo $propiedad -> imagen; ?>" alt="anuncio 1 destacado">
    </picture>
    <div class="resumen-propiedad contenido-anuncio">
        <p class="precio">u$s <?php echo $propiedad -> precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img loading="lazy" src="build/img/icono_wc.svg" alt="icono-wc">
                <p><?php echo $propiedad -> wc; ?></p>
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
        <p><?php echo $propiedad -> descripcion; ?></p>
    </div>
</main>