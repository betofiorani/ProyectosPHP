<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Vendedor;
    
    class VendedorController {

        public static function crear( Router $router ){
            
            $vendedor = new Vendedor;
            $vendedores = Vendedor::getAll();
            
            // obtenemos el arreglo de errores
            $errores = Vendedor::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
                //Instanciamos una propiedad de la clase Propiedad con los resultados del post
                $vendedor = new Vendedor($_POST['vendedor']);
                    
                // invocamos el método para validar y lo guardamos en el array errores
                $errores = $vendedor -> validar();
        
                // Revisar que el array de errores esté vacío
                if(empty($errores)){
        
                    // invocamos el método para guardar
                    $vendedor -> guardar();
                }
            }

            $router -> render('vendedores/crear', [
                'vendedor' => $vendedor,
                'vendedores' => $vendedores,
                'errores' => $errores

            ]);
        }
        public static function actualizar(Router $router){
            
            // obtenemos el arreglo de errores
            $errores = Vendedor::getErrores();

            $id = validarORedireccionar('/admin');
            $vendedor = Vendedor::getRegistro($id);

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
                // Asignar los atributos
                $args = $_POST['vendedor']; // En los name se les da formato de array entonces todo queda agrupado
                
                $vendedor -> sincronizar($args);
        
                // invocamos el método para validar y lo guardamos en el array errores
                $errores = $vendedor -> validar();
                       
                // Revisar que el array de errores esté vacío
                if(empty($errores)){
        
                    // invocamos el método para guardar
                    $vendedor -> guardar();
                }
            }

            $router -> render('vendedores/actualizar', [
                'vendedor' => $vendedor,
                'errores' => $errores
            ]);
        }
        public static function eliminar(){
            
            if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                //obtengo por POST el valor del input oculto en cada fomulario eliminar.
                $tipo = $_POST['tipo'];
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
        
                // Elimino el vendedor de la base
                if($id){
                    // revisamos que el tipo sea válido.
                    if(validarTipoContenido($tipo)){
                        $vendedor = Vendedor::getRegistro($id);
                        $vendedor -> eliminar();
                    }
        
                } else {
                    header('Location: /admin');
                }
            }      
        }
    }
?>