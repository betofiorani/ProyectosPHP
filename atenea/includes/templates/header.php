<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? false;
?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atenea Soluciones Inmobiliarias</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">

</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''?>">
        <div class="contenedor header-contenido">
            <div class="barra">
                <a href="index.php">
                    <img src="/build/img/logo-atenea5.webp" alt="logo Atenea">
                </a>
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="dark mode">
                    <nav class="navegacion">
                        <a class="navegacion-enlace" href="nosotros.php">Nosotros</a>
                        <a class="navegacion-enlace" href="alquiler.php">Alquiler</a>
                        <a class="navegacion-enlace" href="venta.php">Venta</a>
                        <a class="navegacion-enlace" href="blog.php">Blog</a>
                        <a class="navegacion-enlace" href="contacto.php">contacto</a>
                        <?php if ($auth):?>
                            <a class="navegacion-enlace" href="/cerrar-sesion.php">cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div>
            <?php echo $inicio ? '<h1>Venta, Alquiler de Casas y Departamentos</h1>' : ''?>
        </div>
    </header>
