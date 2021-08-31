<main class="contenedor seccion">
    <?php 
        include __DIR__ . '/queOfrecemos.php';
    ?>
</main>
<section class="contenedor seccion">
    <h2>Casas y Departamentos en Venta</h2>
    <?php
        $limit = 3;
        //incluirTemplate('anuncios');
        include __DIR__ . '/propiedades.php';
    ?>
    <div class="alinear-derecha">
        <a data-cy="ver-propiedades" class="boton-verde" href="/venta">ver todas</a>
    </div>
</section>
<section data-cy="contacto-homepage" class="imagen-contactar">
    <h2>Encuentra tu Hogar</h2>
    <p>Llena los campos del formulario y un asesor se pondrá en contacto contigo a la brevedad</p>
    <a href="/contacto" class="boton-morado">Contáctanos</a>
</section>
<div class="contenedor seccion blog-opiniones">
    <section data-cy="acceso-blog" class="acceso-blog">
        <h3>Nuestro Blog</h3>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="imagen blog 1">
                </picture>
            </div>
            <div class="entrada-texto">
                <a href="/entrada">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el <span>10/03/2021</span> por: <span>@hernangarcia</span></p>
                    <p>Consejos para construir una terraza en el techo de tu casa con los mejores
                        materiales, eco friendly y ahorrando dinero.
                    </p>
                </a>
            </div>
        </article>
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="imagen blog 2">
                </picture>
            </div>
            <div class="entrada-texto">
                <a href="/entrada">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="informacion-meta">Escrito el <span>08/03/2021</span> por: <span>@sofigigena</span></p>
                    <p>Maximiza los espacios de tu hogar con esta guía práctica. Aprende a combinar
                        muebles y colores para darle vida a tus espacios.
                    </p>
                </a>
            </div>
        </article>
    </section>
    <section data-cy="opiniones" class="opiniones">
        <h3>Opiniones</h3>
        <div class="opinion">
            <blockquote>
                Me transmitieron confianza desde el primer momento y su amor por lo que hacen.
                Me sentí respaldado y tranquilo al dejar mi casa en sus manos.
                Actuaron con mucha rapidez para realizar todo lo necesario para dejar la Propiedad
                en condiciones.
            </blockquote>
            <p>- Beto Fiorani</p>
        </div>
    </section>
</div>