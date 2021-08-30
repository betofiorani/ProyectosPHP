<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {

    public static function login (Router $router){

        if(isset($_GET['cerrar-sesion'])){
            session_destroy();
        }
        
        $usuario = new Admin();
        $errores = Admin::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario = new Admin($_POST['login']);
            
            // invocamos el método para validar y lo guardamos en el array errores
            $errores = $usuario -> validarAutenticar();
                
            if(empty($errores)){

                $usuario -> autenticar();
            }
        }

        $router -> render('auth/login',[
            'errores' => $errores,
            'usuario' => $usuario    
        ]);
    }

    public static function logout (Router $router){
        
        session_start();

        $_SESSION = [];

        header('Location: /');
    }
}




?>