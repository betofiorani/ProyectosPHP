<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Evento;
    use Model\Regalo;
    use Model\Registrado;
    use Model\Pase;
    use Model\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    class RegistradoController {

        public static function index( Router $router ){ // Router $router es una manera de pasarle a este método la instancia de router ya generada. Si tuvieramos que instanciar de nuevo, se perdería la info de la url
            
            $propiedades = Evento::getAll();
            $vendedores = Regalo::getAll();
            // obtengo el mensaje condicional para mostrarlo como alerta
            $resultado = $_GET['resultado'] ?? null; // se podría usar isset($_GET['resultado']) pero ?? es lo ultimo en PHP

            $router -> render('propiedades/admin', [
                'propiedades' => $propiedades,
                'resultado' => $resultado,
                'vendedores' => $vendedores        
            ]);
        }
        public static function registro ( Router $router ){
            
            $registrado = new Registrado;
            $regalos = Regalo::getAll();
            $pases = Pase::getAll();
            $categorias = Categoria::getAll();
            $dias['Viernes'][] = '2016-12-09'; 
            $dias['Sabado'][] = '2016-12-10';
            $dias['Domingo'][] = '2016-12-11';
            
            // obtenemos el arreglo de errores
            $errores = Registrado::getErrores();

            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                debuguear($_POST);
        
                //Instanciamos una propiedad de la clase Propiedad con los resultados del post
                $registrado = new Registrado($_POST['registrado']);
                    
                // Generar Nombre Unico para la imagen
                $nombreImagen = md5( uniqid( rand(),true )).'.jpg';
                    
                // Realiza un resize de la imagen con intervention
                if($_FILES['registrado']['tmp_name']['imagen']){
                    $image = Image::make($_FILES['registrado']['tmp_name']['imagen'])->fit(800,600);
                    
                    // guarda el nombre de la imagen en el objeto
                    $registrado -> setImagen($nombreImagen);
                
                }

                // invocamos el método para validar y lo guardamos en el array errores
                $errores = $registrado -> validar();
        
                // Revisar que el array de errores esté vacío
                if(empty($errores)){
        
                    // ** SUBIDA DE IMAGENES **
                    // Subir la imagen al servidor con intervention. metodo Save
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
                    $image -> save(CARPETA_IMAGENES.$nombreImagen);
                
                    // invocamos el método para guardar
                    $registrado -> guardar();
                }
            }

            $router -> render('paginas/registro', [
                'categorias' => $categorias,
                'regalos' => $regalos,
                'errores' => $errores,
                'pases' => $pases,
                'dias' => $dias
            ]);
        }
        public static function actualizar(Router $router){
            
            $vendedores = Regalo::getAll();

            // obtenemos el arreglo de errores
            $errores = Evento::getErrores();

            $id = validarORedireccionar('/admin');
            $propiedad = Evento::getRegistro($id);

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
                        $propiedad = Evento::getRegistro($id);
                        $propiedad -> eliminar();
                    }
        
                } else {
                    header('Location: /admin');
                }
            }
        
        }
    }




?>