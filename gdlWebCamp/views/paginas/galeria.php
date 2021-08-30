<main class="contenedor seccion descripcion-evento">
    <h2>La Mejor Conferencia de Diseño WEB en Español</h2>
    <p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed repellendus, quod maiores tempora commodi tenetur, nobis similique eligendi accusantium enim, sunt dolor praesentium vitae magnam impedit. Cum impedit cumque vitae.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed repellendus, quod maiores tempora commodi tenetur, nobis similique eligendi accusantium enim, sunt dolor praesentium vitae magnam impedit. Cum impedit cumque vitae.
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed repellendus, quod maiores tempora commodi tenetur, nobis similique eligendi accusantium enim, sunt dolor praesentium vitae magnam impedit. Cum impedit cumque vitae.
    </p>
</main>
<section class="contenedor seccion">
    <h2 class="<?php echo $clase; ?>">Galeria de Fotos</h2>
    <div class="galeria">
        <?php 
            for($i = 1; $i<=21 ; $i++):
        ?>
            <a href="build/img/galeria/<?php if($i<10){echo "0{$i}";} else {echo $i;};?>.jpg" data-lightbox="galeria">
                <img src="build/img/galeria/thumbs/<?php if($i<10){echo "0{$i}";} else {echo $i;};?>.jpg">
            </a>
        <?php 
            endfor;
        ?>
    </div>
</section>