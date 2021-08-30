<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Evento;
    use Model\Invitado;
    use Model\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    class InvitadoController {

        public static function crear( Router $router ){
            
            // Instanciamos un nuevo objeto de la clase Evento.
            $invitado = new Invitado;

            // Incializamos algunas variables para que estén en toda la función.
            $resultado = "";
            $id ="";
            $titulo_pagina = 'Crear Invitado';

            // Revisamos que no haya en la url, un get. No lo estoy usando, por los Sweet alert y ajax.
            // if(isset($_GET['resultado'])){
            //     $resultado = $_GET['resultado'];
            // }
            
            // Revisamos si hay un GET con el id. Si esto existe, se trata de una edición no de un alta.
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $titulo_pagina = 'Editar Invitado';

                // utilizamos el método de la clase para obtener todos los campos de la tabla categoria para ese id.
                $invitado = Invitado::getRegistro($id);
            }
            // obtenemos el arreglo de errores utilizando el método de la clase ActiveRecords.
            $errores = Invitado::getErrores();

            // Revisamos si estamos recibiendo un POST
            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                // revisamos la accion    
                if($_POST['accion'] === 'crear'){
            
                    //Instanciamos una usuario de la clase Admin con los resultados del post
                    $invitado = new Invitado($_POST['invitado']);

                    // Generar Nombre Unico para la imagen
                    $nombreImagen = md5( uniqid( rand(),true )).'.jpg';
                    
                    // Realiza un resize de la imagen con intervention
                    if($_FILES['invitado']['tmp_name']['imagen']){
                        $image = Image::make($_FILES['invitado']['tmp_name']['imagen'])->fit(800,600);
                        // guarda el nombre de la imagen en el objeto
                        $invitado -> setImagen($nombreImagen);

                    }

                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $invitado -> validar();
                    
                    // Revisar que el array de errores esté vacío
                    if(empty($errores)){

                        // ** SUBIDA DE IMAGENES **
                        // Subir la imagen al servidor con intervention. metodo Save
                        if(!is_dir(CARPETA_IMAGENES)){
                            mkdir(CARPETA_IMAGENES);
                        }
                        $image -> save(CARPETA_IMAGENES.$nombreImagen);
                    
                        // invocamos el método para guardar (solo sabe si crea o actualiza en funcion de si existe id o no)
                        $invitado -> guardar();
                        // obtenemos el resultado del query
                        $resultado = Invitado::getResultado();

                        // preparamos la respuesta para el AJAX
                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'Invitado creado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'El Invitado ya existe'
                            );
                        }
                        
                        echo json_encode($respuesta);

                    }
                    
                } else if($_POST['accion'] === 'actualizar'){

                    $invitado = Invitado::getRegistro($_POST['id']);
                    
                    // Asignar los atributos
                    $args = $_POST['invitado']; // En los name se les da formato de array entonces todo queda agrupado  

                    $invitado -> sincronizar($args);

                    // Generar Nombre Unico para la imagen
                    $nombreImagen = md5( uniqid( rand(),true )).'.jpg';
                    
                    // Realiza un resize de la imagen con intervention
                    if($_FILES['invitado']['tmp_name']['imagen']){
                        $image = Image::make($_FILES['invitado']['tmp_name']['imagen'])->fit(450,300);
                        // guarda el nombre de la imagen en el objeto
                        $invitado -> setImagen($nombreImagen);   
                    }
            
                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $invitado -> validar();

                    if(empty($errores)){

                        $invitado -> guardar();

                        // ** SUBIDA DE IMAGENES **
                        // Subir la imagen al servidor con intervention. metodo Save
                        if($_FILES['invitado']['tmp_name']['imagen']){
                            $image -> save(CARPETA_IMAGENES.$nombreImagen);
                        }

                        $resultado = Invitado::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'Invitado actualizado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'El Invitado no pudo actualizarse'
                            );
                        }
                        
                        echo json_encode($respuesta);
                    }               
                } else {
                    $invitado = Invitado::getRegistro($_POST['id']);
                    $invitado ->eliminar();

                    $resultado = Invitado::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'Invitado eliminado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'El Invitado no pudo eliminarse'
                            );
                        }
                        
                        echo json_encode($respuesta);

                }

            } else {
                $router -> render('admin/invitados/crear', [
                    'errores' => $errores,
                    'titulo_pagina' => $titulo_pagina,
                    'resultado' => $resultado,
                    'invitado' => $invitado,
                    'id' => $id

                ]);
            }
        }
        public static function listar( Router $router ){
            
            $invitados = Invitado::getAll();
        
            //debuguear($eventos);
            
            $titulo_pagina = 'Listado de Invitados';

            
            $router -> render('admin/invitados/listar', [
                'invitados' => $invitados,
                'titulo_pagina' => $titulo_pagina   

            ]);
            
        }
    }
?>