<?php

    namespace MVC;

    class Router {

        public $rutasGET = [];
        public $rutasPOST = [];
        
        public function get($url , $funcion){
            // con este método, se va a llenar el array
            // con las rutas get que le pasemos. Uniendo $url con función asociada
            $this -> rutasGET[$url] = $funcion;
        }
        public function post($url , $funcion){
            // con este método, se va a llenar el array
            // con las rutas get que le pasemos. Uniendo $url con función asociada
            $this -> rutasPOST[$url] = $funcion;
        }

        public function comprobarRutas(){
            session_start();
            
            $auth = $_SESSION['login'] ?? false;

            // Array con rutas protegidas

            $rutas_protegidas = [
                '/admin',
                '/propiedades/crear',
                '/propiedades/actualizar',
                '/propiedades/eliminar',
                '/vendedores/crear',
                '/vendedores/actualizar',
                '/vendedores/eliminar'
            ];

            $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
            //debuguear($urlActual);
            //debuguear($_SERVER);
            if(strpos($urlActual, '?')){ // tuve que crear este if para que cuando sea un get, tome el redirect y no el request
                $urlActual = $_SERVER['REDIRECT_URL'];
            }
            
            $metodo = $_SERVER['REQUEST_METHOD'];

            if($metodo === 'GET'){
                $funcion = $this -> rutasGET[$urlActual] ?? null;
            } else { // las POST
                $funcion = $this -> rutasPOST[$urlActual] ?? null;
            }

            // Proteger rutas

            if(in_array($urlActual , $rutas_protegidas) && !$auth){
                header('Location : /');
            }

            // si la $url existe
            if($funcion){
               call_user_func($funcion , $this);
            }
            else {
                echo 'Página NO encontrada';
            }
        }

        // muestra una vista
        public function render($view , $datos = []){

            foreach ( $datos as $key => $value){
                $$key = $value; // Doble $ es variable de variable. 


            }

            ob_start();
            include __DIR__ ."/views/$view.php";
            
            $contenido = ob_get_clean();

            include __DIR__ ."/views/layout.php";
        
        }
    }


?>