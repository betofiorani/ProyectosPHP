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
    <title>Atenea Soluciones Inmobiliarias</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../build/css/app.css">

</head>
<body>
    <header data-cy="header" class="header <?php echo $inicio ? 'inicio' : ''?>">
        <div class="contenedor header-contenido">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo-atenea5.webp" alt="logo Atenea">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="dark mode">
                    <nav class="navegacion">
                        <a class="navegacion-enlace" href="/nosotros">Nosotros</a>
                        <a class="navegacion-enlace" href="/alquiler">Alquiler</a>
                        <a class="navegacion-enlace" href="/venta">Venta</a>
                        <a class="navegacion-enlace" href="/blog">Blog</a>
                        <a class="navegacion-enlace" href="/contacto">Contacto</a>
                        <?php if ($auth):?>
                            <a class="navegacion-enlace" href="/logout">cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php echo $inicio ? '<h1 data-cy="heading-sitio">Venta, Alquiler de Casas y Departamentos</h1>' : ''?>
        </div>
    </header>

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

    <script src="../build/js/bundle.min.js"></script>
</body>
</html>
