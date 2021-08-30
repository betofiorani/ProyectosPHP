<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Evento;
    use Model\Invitado;
    use Model\Registrado;
    use Model\Admin;
    use Intervention\Image\ImageManagerStatic as Image;

    class AdminController {

        public static function index( Router $router ){ // Router $router es una manera de pasarle a este método la instancia de router ya generada. Si tuvieramos que instanciar de nuevo, se perdería la info de la url

            $ordenes = Registrado::contarRegistros();
            $invitados = Invitado::contarRegistros();
            $eventos = Evento::contarRegistros();
            $pagados = Registrado::contarRegistrosCondicion(' pagado=1 ');
            $titulo_pagina = 'Tablero de Control';

            $router -> render('admin/dashboard', [
                'ordenes' => $ordenes,
                'pagados' => $pagados,
                'invitados' => $invitados,
                'eventos' => $eventos,
                'titulo_pagina' => $titulo_pagina
                      
            ]);
        }
        public static function crear( Router $router ){
            
            $administrador = new Admin;

            $resultado = "";
            $id ="";
            $titulo_pagina = 'Crear Usuario';

            if(isset($_GET['resultado'])){
                $resultado = $_GET['resultado'];
            }
            
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $titulo_pagina = 'Editar Usuario';
                $administrador = Admin::getRegistro($id);
            }
            // obtenemos el arreglo de errores
            $errores = Admin::getErrores();

            

            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
                // revisamos la accion    
                if($_POST['accion'] === 'crear'){

                    //Instanciamos una usuario de la clase Admin con los resultados del post
                    $usuario = new Admin($_POST['usuario']);

                    // Generar Nombre Unico para la imagen
                    $nombreImagen = md5( uniqid( rand(),true )).'.jpg';
                        
                    // Realiza un resize de la imagen con intervention
                    // if($_FILES['usuario']['tmp_name']['imagen']){
                    //     $image = Image::make($_FILES['usuario']['tmp_name']['imagen'])->fit(800,600);
                        
                    //     // guarda el nombre de la imagen en el objeto
                    //     $usuario -> setImagen($nombreImagen);
                    
                    // }

                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $usuario -> validar();
                    
                    // Revisar que el array de errores esté vacío
                    if(empty($errores)){

                        // ** SUBIDA DE IMAGENES **
                        // Subir la imagen al servidor con intervention. metodo Save
                        // if(!is_dir(CARPETA_IMAGENES)){
                        //     mkdir(CARPETA_IMAGENES);
                        // }
                        // $image -> save(CARPETA_IMAGENES.$nombreImagen);
                        
                        // invocamos el método para guardar (solo sabe si crea o actualiza en funcion de si existe id o no)
                        $usuario -> guardar();
                        $resultado = Admin::getResultado();
                        // preparamos la respuesta para el AJAX
                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'Administrador creado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'El usuario ya existe'
                            );
                        }
                        
                        echo json_encode($respuesta);

                    }

                    
                } else if($_POST['accion'] === 'actualizar'){

                    $administrador = Admin::getRegistro($_POST['id']);
                    
                    // Asignar los atributos
                    $args = $_POST['usuario']; // En los name se les da formato de array entonces todo queda agrupado  

                    
                    if(empty($_POST['password'])){
                        $args['password'] = $administrador -> password;      
                    }
                    
                    $administrador -> sincronizar($args);
            
                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $administrador -> validar();

                    if(empty($errores)){

                        $administrador -> guardar();
                        $resultado = Admin::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'Administrador actualizado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'El Usuario no pudo actualizarse'
                            );
                        }
                        
                        echo json_encode($respuesta);
                    }               
                } else {
                    $administrador = Admin::getRegistro($_POST['id']);
                    $administrador ->eliminar();

                    $resultado = Admin::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'Administrador eliminado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'El Usuario no pudo eliminarse'
                            );
                        }
                        
                        echo json_encode($respuesta);

                }

            } else {
                $router -> render('admin/usuarios/crear', [
                    'errores' => $errores,
                    'titulo_pagina' => $titulo_pagina,
                    'resultado' => $resultado,
                    'administrador' => $administrador,
                    'id' => $id

                ]);
            }
        }
        public static function listar( Router $router ){
            
            $administradores = Admin::getAll();

            //debuguear($administradores);
            
            $titulo_pagina = 'Listado de Administradores';

            
            $router -> render('admin/usuarios/listar', [
                'administradores' => $administradores,
                'titulo_pagina' => $titulo_pagina   

            ]);
            
        }
           
    }

?>