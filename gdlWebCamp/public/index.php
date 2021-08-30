<?php

    require_once __DIR__ .'/../includes/app.php';
    
    use MVC\Router;
    use Controllers\PaginasController;
    use Controllers\LoginController;
    use Controllers\RegistradoController;
    use Controllers\AdminController;
    use Controllers\EventoController;
    use Controllers\CategoriaController;
    use Controllers\InvitadoController;

    // Instanciamos un objeto Router de la clase ROUTER
    $router = new Router();


    $router -> get('/admin' , [AdminController::class , 'index']);
    
    // Rutas Admin
    $router -> get('/admin/crear' , [AdminController::class , 'crear']);
    $router -> post('/admin/crear' , [AdminController::class , 'crear']);
    $router -> get('/admin/listar' , [AdminController::class , 'listar']);

    // Rutas Admin eventos
    $router -> get('/evento/crear' , [EventoController::class , 'crear']);
    $router -> post('/evento/crear' , [EventoController::class , 'crear']);
    $router -> get('/evento/listar' , [EventoController::class , 'listar']);
    
    // Rutas Admin Categorias
    $router -> get('/categoria/crear' , [CategoriaController::class , 'crear']);
    $router -> post('/categoria/crear' , [CategoriaController::class , 'crear']);
    $router -> get('/categoria/listar' , [CategoriaController::class , 'listar']);

    // Rutas Admin Invitado
    $router -> get('/invitado/crear' , [InvitadoController::class , 'crear']);
    $router -> post('/invitado/crear' , [InvitadoController::class , 'crear']);
    $router -> get('/invitado/listar' , [InvitadoController::class , 'listar']);


    // Rutas Registrado
    $router -> get('/registrado/crear' , [RegistradoController::class , 'crear']);
    $router -> post('/registrado/crear' , [RegistradoController::class , 'crear']);
    $router -> get('/registrado/listar' , [RegistradoController::class , 'listar']);
    

    // Paginas estáticas sin autenticación
    $router -> get('/', [PaginasController::class , 'index']);
    $router -> get('/galeria', [PaginasController::class , 'galeria']);
    $router -> get('/registro', [RegistradoController::class , 'registro']);
    $router -> post('/registro', [RegistradoController::class , 'registro']);
    $router -> get('/resumenRegistro' , [RegistradoController::class , 'resumenRegistro']);
    $router -> get('/calendario', [PaginasController::class , 'calendario']);
    $router -> get('/invitados', [PaginasController::class , 'invitados']);
    $router -> get('/contacto', [PaginasController::class , 'contacto']);
    $router -> post('/contacto', [PaginasController::class , 'contacto']);

    //LOGIN y Autenticación

    $router -> get('/login', [LoginController::class , 'login']);
    $router -> post('/login', [LoginController::class , 'login']);
    $router -> get('/logout', [LoginController::class , 'logout']);

    $router -> comprobarRutas();

?>