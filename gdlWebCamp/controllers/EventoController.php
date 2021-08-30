<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Evento;
    use Model\Invitado;
    use Model\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    class EventoController {

        public static function crear( Router $router ){
            
            // Instanciamos un nuevo objeto de la clase Evento.
            $evento = new Evento;

            // Conseguimos todas las categorías disponibles y todos los invitados disponibles para los select en el formulario de alta.

            $categorias = Categoria::getAll();
            $invitados = Invitado::getAll();

            // Incializamos algunas variables para que estén en toda la función.
            $resultado = "";
            $id ="";
            $titulo_pagina = 'Crear Evento';

            // Revisamos que no haya en la url, un get. No lo estoy usando, por los Sweet alert y ajax.
            // if(isset($_GET['resultado'])){
            //     $resultado = $_GET['resultado'];
            // }
            
            // Revisamos si hay un GET con el id. Si esto existe, se trata de una edición no de un alta.
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $titulo_pagina = 'Editar Evento';

                // utilizamos el método de la clase para obtener todos los campos de la tabla evento para ese id.
                $evento = Evento::getRegistro($id);
            }
            // obtenemos el arreglo de errores utilizando el método de la clase ActiveRecords.
            $errores = Evento::getErrores();

            // Revisamos si estamos recibiendo un POST
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
                // revisamos la accion    
                if($_POST['accion'] === 'crear'){

                    //Instanciamos una usuario de la clase Admin con los resultados del post
                    $evento = new Evento($_POST['evento']);

                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $evento -> validar();
                    
                    // Revisar que el array de errores esté vacío
                    if(empty($errores)){

                        // invocamos el método para guardar (solo sabe si crea o actualiza en funcion de si existe id o no)
                        $evento -> guardar();
                        // obtenemos el resultado del query
                        $resultado = Evento::getResultado();

                        // preparamos la respuesta para el AJAX
                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'evento creado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'El evento ya existe'
                            );
                        }
                        
                        echo json_encode($respuesta);

                    }
                    
                } else if($_POST['accion'] === 'actualizar'){

                    $evento = Evento::getRegistro($_POST['id']);
                    
                    // Asignar los atributos
                    $args = $_POST['evento']; // En los name se les da formato de array entonces todo queda agrupado  

                    $evento -> sincronizar($args);
            
                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $evento -> validar();

                    if(empty($errores)){

                        $evento -> guardar();
                        $resultado = Evento::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'evento actualizado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'El Evento no pudo actualizarse'
                            );
                        }
                        
                        echo json_encode($respuesta);
                    }               
                } else {
                    $evento = Evento::getRegistro($_POST['id']);
                    $evento ->eliminar();

                    $resultado = Evento::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'evento eliminado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'El Evento no pudo eliminarse'
                            );
                        }
                        
                        echo json_encode($respuesta);

                }

            } else {
                $router -> render('admin/eventos/crear', [
                    'errores' => $errores,
                    'titulo_pagina' => $titulo_pagina,
                    'resultado' => $resultado,
                    'evento' => $evento,
                    'id' => $id,
                    'categorias' => $categorias,
                    'invitados' => $invitados

                ]);
            }
        }
        public static function listar( Router $router ){
            
            $eventos = Evento::getAll();
        
            //debuguear($eventos);
            
            $titulo_pagina = 'Listado de Eventos';

            
            $router -> render('admin/eventos/listar', [
                'eventos' => $eventos,
                'titulo_pagina' => $titulo_pagina   

            ]);
            
        }
    }
?>