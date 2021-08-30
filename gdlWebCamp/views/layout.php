<?php

    $auth = $_SESSION['login'] ?? false;

    if(!isset($inicio)){

        $inicio = false;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDLWebCamp</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Oswald&family=PT+Sans&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../build/css/app.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
</head>
<body>
    <header class="header">
      <div class="hero">
        <div class="contenido-header">
          <nav class="redes-sociales">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
          </nav>
          <div class="informacion-evento">
            <p class="fecha"><i class="far fa-calendar-check"></i>10-12 Dic</p>
            <p class="lugar"><i class="fas fa-map-marker-alt"></i>Córdoba, Argentina</p>
          </div><!-- fin información evento -->
          <h1 class="nombre-sitio">GdlWebCamp</h1>
          <p class="slogan">La mejor conferencia de <span>Diseño Web</span></p>
        </div>
      </div> <!-- fin hero (imagen background vía CSS) -->  
    </header>
    <div class="barra">
        <?php 
            include __DIR__ . '/paginas/navegacion.php';
        ?>
    </div>

    <?php
        echo $contenido;
    ?>

    <footer data-cy="footer" class="footer seccion">
        <div class="contenedor footer-contenido">
            <nav class="navegacion">
                <a class="navegacion-enlace" href="/nosotros">Nosotros</a>
                <a class="navegacion-enlace" href="/alquiler">En Alquiler</a>
                <a class="navegacion-enlace" href="/venta">En Venta</a>
                <a class="navegacion-enlace" href="/blog">Blog</a>
                <a class="navegacion-enlace" href="/contacto">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Atenea - Todos los derechos reservados - <?php echo date('Y'); ?></p>
    </footer>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="../build/js/bundle.min.js"></script>
</body>
</html>
