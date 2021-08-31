<?php

    require_once __DIR__ .'/../includes/app.php';
    
    use MVC\Router;
    use Controllers\PropiedadController;
    use Controllers\VendedorController;
    use Controllers\PaginasController;
    use Controllers\LoginController;

    // Instanciamos un objeto Router de la clase ROUTER
    $router = new Router();


    $router -> get('/admin' , [PropiedadController::class , 'index']);
    
    // Rutas Propiedades
    $router -> get('/propiedades/crear' , [PropiedadController::class , 'crear']);
    $router -> get('/propiedades/actualizar' , [PropiedadController::class , 'actualizar']);
    $router -> post('/propiedades/crear' , [PropiedadController::class , 'crear']);
    $router -> post('/propiedades/actualizar' , [PropiedadController::class , 'actualizar']);
    $router -> post('/propiedades/eliminar' , [PropiedadController::class , 'eliminar']);

    // Rutas Vendedores
    $router -> get('/vendedores/crear' , [VendedorController::class , 'crear']);
    $router -> get('/vendedores/actualizar' , [VendedorController::class , 'actualizar']); 
    $router -> post('/vendedores/crear' , [VendedorController::class , 'crear']);
    $router -> post('/vendedores/actualizar' , [VendedorController::class , 'actualizar']);
    $router -> post('/vendedores/eliminar' , [VendedorController::class , 'eliminar']);

    // Paginas estáticas sin autenticación
    $router -> get('/', [PaginasController::class , 'index']);
    $router -> get('/nosotros', [PaginasController::class , 'nosotros']);
    $router -> get('/venta', [PaginasController::class , 'venta']);
    $router -> get('/propiedad', [PaginasController::class , 'propiedad']);
    $router -> get('/blog', [PaginasController::class , 'blog']);
    $router -> get('/entrada', [PaginasController::class , 'entrada']);
    $router -> get('/contacto', [PaginasController::class , 'contacto']);
    $router -> post('/contacto', [PaginasController::class , 'contacto']);

    //LOGIN y Autenticación

    $router -> get('/login', [LoginController::class , 'login']);
    $router -> post('/login', [LoginController::class , 'login']);
    $router -> get('/logout', [LoginController::class , 'logout']);

    $router -> comprobarRutas();

?>