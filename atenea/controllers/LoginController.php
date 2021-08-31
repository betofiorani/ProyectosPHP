<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {

    public static function login (Router $router){
        
        $usuario = new Admin();
        $errores = Admin::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario = new Admin($_POST['login']);
            
            //$email = mysqli_real_escape_string( $db, filter_var($_POST['email'] , FILTER_VALIDATE_EMAIL));
            //$password = mysqli_real_escape_string( $db , $_POST['password'] );
            
            // invocamos el método para validar y lo guardamos en el array errores
            $errores = $usuario -> validar();
                
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