<?php

    namespace MVC; // Namespace para que el autoload de las clases funcione

    // Esta clase agrupa todas las variables y métodos del ruteo del sitio. 
    class Router {

        public $rutasGET = []; // Inicializamos con acceso público un arreglo de rutas con GET
        public $rutasPOST = []; // Inicializamos con acceso público un arreglo de rutas con POST
        
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

        // Método para comprobar las rutas y bloquear las protegidas
        public function comprobarRutas(){

            session_start();
            
            // Obtenemos la variable auth del arreglo de sesión en su key login. Si no está la sesión iniciada le damos el valor false.
            $auth = $_SESSION['login'] ?? false;

            // Array con rutas protegidas - Agregar todas aquellas que se quieran bloquear

            $rutas_protegidas = [
                '/admin',
                '/admin/crear',
                '/admin/actualizar',
                '/admin/eliminar'
            ];
            // Obtenemos la ruta actual utilizando de la superglobal $_SERVER el valor de request_uri - Si no tenemos ese valor, tomamos como que estuvieramos en la raiz.
            $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
            //debuguear($urlActual);
            //debuguear($_SERVER);
            if(strpos($urlActual, '?')){ // tuve que crear este if para que cuando sea un get, tome el redirect y no el request
                $urlActual = $_SERVER['REDIRECT_URL'];
            }
            
            // Tomamos el método que viene en la URL accediendo a la super global con request method.
            $metodo = $_SERVER['REQUEST_METHOD'];

            // Revisamos si es GET o POST y le asignamos a la variable funcion el valor de rutasGET con la url actual.
            if($metodo === 'GET'){
                $funcion = $this -> rutasGET[$urlActual] ?? null;
            } else { // las POST
                $funcion = $this -> rutasPOST[$urlActual] ?? null;
            }

            // Proteger rutas - si en el array de rutas protegidas está la url actual y no está autorizado, manda a inicio.

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

            if(strpos($view, "admin")=== false){
                
                include __DIR__ ."/views/layout.php";

            } else {
                include __DIR__ ."/views/layoutAdmin.php";
            }
        }
    }
?>