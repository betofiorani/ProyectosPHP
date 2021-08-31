<?php
    
    define('TEMPLATES_URL',__DIR__.'/templates');
    define('FUNCIONES_URL',__DIR__.'funciones.php');
    define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'] . '/build/img/');

function incluirTemplate(string $nombreTemplate, bool $inicio = false){
    $inicio;
    include TEMPLATES_URL."/${nombreTemplate}.php"; // Si o si comillas dobles para poder usar las sintaxis {}
}

function usuarioAutenticado() {
    // Verificar sesion
    session_start();
    if(!$_SESSION['login']){
        header('Location: /');
    } 
}

function debuguear($variable){
    echo '<pre>';
    var_dump($variable);
    echo '<pre>';
    exit;
}

// escapar el HTML - evitar que coloquen codigo malicioso

function sanitizar($html) : string {
    $sanitizar = htmlspecialchars($html);
    return $sanitizar;
}

// Validar tipo de contenido
function validarTipoContenido($tipo){
    $tipos= ['propiedad','vendedor'];
    return in_array($tipo,$tipos);
}

function mostrarNotificacion($codigo){
    $mensaje = '';
    
    switch($codigo) :
        case 1: 
            $mensaje = 'Te registraste Exitosamente';
            break;
        case 2: 
            $mensaje = 'Actualizado Exitosamente';
            break;
        case 3: 
            $mensaje = 'Eliminado Exitosamente';
            break;
        default: 
            $mensaje = null;
            break;    
    endswitch;

    return $mensaje;
}

function validarORedireccionar(string $url){

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id){
        header("Location: ${url}");
    }
    return $id;
}