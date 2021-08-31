<main class="contenedor seccion">
    <h1 data-cy="titulo-nosotros">Acerca de Nosotros</h1>
    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="sobre nosotros">
            </picture>
        </div>
        <div class="texto-nosotros">
            <blockquote>25 años de experiencia</blockquote>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fuga ut ab quaerat dicta quibusdam ipsa quis libero accusamus, vitae, accusantium numquam optio maiores unde nostrum aperiam maxime deserunt repellat similique!</p>
            <p>Pernatur aut omnis autem voluptatem iusto repudiandae sequi porro eos delectus. Excepturi reprehenderit quibusdam corrupti error enim?</p>
        </div>
    </div>
</main>
<section class="contenedor seccion">
    <?php
        include __DIR__ .'/queOfrecemos.php';
    ?>
</section>