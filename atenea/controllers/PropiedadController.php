<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use Model\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;

    class PropiedadController {

        public static function index( Router $router ){ // Router $router es una manera de pasarle a este método la instancia de router ya generada. Si tuvieramos que instanciar de nuevo, se perdería la info de la url
            
            $propiedades = Propiedad::getAll();
            $vendedores = Vendedor::getAll();
            // obtengo el mensaje condicional para mostrarlo como alerta
            $resultado = $_GET['resultado'] ?? null; // se podría usar isset($_GET['resultado']) pero ?? es lo ultimo en PHP

            $router -> render('propiedades/admin', [
                'propiedades' => $propiedades,
                'resultado' => $resultado,
                'vendedores' => $vendedores        
            ]);
        }
        public static function crear( Router $router ){
            
            $propiedad = new Propiedad;
            $vendedores = Vendedor::getAll();
            
            // obtenemos el arreglo de errores
            $errores = Propiedad::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
                //Instanciamos una propiedad de la clase Propiedad con los resultados del post
                $propiedad = new Propiedad($_POST['propiedad']);
                    
                // Generar Nombre Unico para la imagen
                $nombreImagen = md5( uniqid( rand(),true )).'.jpg';
                    
                // Realiza un resize de la imagen con intervention
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    
                    // guarda el nombre de la imagen en el objeto
                    $propiedad -> setImagen($nombreImagen);
                
                }

                // invocamos el método para validar y lo guardamos en el array errores
                $errores = $propiedad -> validar();
        
                // Revisar que el array de errores esté vacío
                if(empty($errores)){
        
                    // ** SUBIDA DE IMAGENES **
                    // Subir la imagen al servidor con intervention. metodo Save
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
                    $image -> save(CARPETA_IMAGENES.$nombreImagen);
                
                    // invocamos el método para guardar
                    $propiedad -> guardar();
                }
            }
            $router -> render('propiedades/crear', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores

            ]);
        }
        public static function actualizar(Router $router){
            
            $vendedores = Vendedor::getAll();

            // obtenemos el arreglo de errores
            $errores = Propiedad::getErrores();

            $id = validarORedireccionar('/admin');
            $propiedad = Propiedad::getRegistro($id);

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
        
                // Asignar los atributos
                $args = $_POST['propiedad']; // En los name se les da formato de array entonces todo queda agrupado
                
                $propiedad -> sincronizar($args);
        
                // invocamos el método para validar y lo guardamos en el array errores
                $errores = $propiedad -> validar();
                
                // Generar Nombre Unico para la imagen
                $nombreImagen = md5( uniqid( rand(),true )).'.jpg';
                    
                // Realiza un resize de la imagen con intervention
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    
                    // guarda el nombre de la imagen en el objeto
                    $propiedad -> setImagen($nombreImagen);
                }
                
                // Revisar que el array de errores esté vacío
                if(empty($errores)){
        
                    // invocamos el método para guardar
                    $propiedad -> guardar();
        
                    // ** SUBIDA DE IMAGENES **
                    // Subir la imagen al servidor con intervention. metodo Save
                    if($_FILES['propiedad']['tmp_name']['imagen']){
                        $image -> save(CARPETA_IMAGENES.$nombreImagen);
                    }
                }
            }

            $router -> render('propiedades/actualizar', [
                'propiedad' => $propiedad,
                'vendedores' => $vendedores,
                'errores' => $errores
            ]);
        }
        public static function eliminar(){
            
            if($_SERVER['REQUEST_METHOD'] === 'POST' ){
                //obtengo por POST el valor del input oculto en cada fomulario eliminar.
                $tipo = $_POST['tipo'];
                $id = $_POST['id'];
                $id = filter_var($id, FILTER_VALIDATE_INT);
        
                // Elimino la propiedad de la base
                if($id){
                    // revisamos que el tipo sea válido.
                    if(validarTipoContenido($tipo)){
                        $propiedad = Propiedad::getRegistro($id);
                        $propiedad -> eliminar();
                    }
        
                } else {
                    header('Location: /admin');
                }
            }
        
        }
    }




?>