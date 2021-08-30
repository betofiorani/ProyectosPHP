<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Evento;
    use Model\Invitado;
    use Model\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    class CategoriaController {

        public static function crear( Router $router ){
            
            // Instanciamos un nuevo objeto de la clase Evento.
            $categoria = new Categoria;

            // Incializamos algunas variables para que estén en toda la función.
            $resultado = "";
            $id ="";
            $titulo_pagina = 'Crear Categoria';

            // Revisamos que no haya en la url, un get. No lo estoy usando, por los Sweet alert y ajax.
            // if(isset($_GET['resultado'])){
            //     $resultado = $_GET['resultado'];
            // }
            
            // Revisamos si hay un GET con el id. Si esto existe, se trata de una edición no de un alta.
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $titulo_pagina = 'Editar Categoria';

                // utilizamos el método de la clase para obtener todos los campos de la tabla categoria para ese id.
                $categoria = Categoria::getRegistro($id);
            }
            // obtenemos el arreglo de errores utilizando el método de la clase ActiveRecords.
            $errores = Categoria::getErrores();

            // Revisamos si estamos recibiendo un POST
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
                // revisamos la accion    
                if($_POST['accion'] === 'crear'){

                    //Instanciamos una usuario de la clase Admin con los resultados del post
                    $categoria = new Categoria($_POST['categoria']);

                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $categoria -> validar();
                    
                    // Revisar que el array de errores esté vacío
                    if(empty($errores)){

                        // invocamos el método para guardar (solo sabe si crea o actualiza en funcion de si existe id o no)
                        $categoria -> guardar();
                        // obtenemos el resultado del query
                        $resultado = Categoria::getResultado();

                        // preparamos la respuesta para el AJAX
                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'Categoria creada Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'La categoria ya existe'
                            );
                        }
                        
                        echo json_encode($respuesta);

                    }
                    
                } else if($_POST['accion'] === 'actualizar'){

                    $categoria = Categoria::getRegistro($_POST['id']);
                    
                    // Asignar los atributos
                    $args = $_POST['categoria']; // En los name se les da formato de array entonces todo queda agrupado  

                    $categoria -> sincronizar($args);
            
                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $categoria -> validar();

                    if(empty($errores)){

                        $categoria -> guardar();
                        $resultado = Categoria::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'Categoria actualizada Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'La Categoría no pudo actualizarse'
                            );
                        }
                        
                        echo json_encode($respuesta);
                    }               
                } else {
                    $categoria = Categoria::getRegistro($_POST['id']);
                    $categoria ->eliminar();

                    $resultado = Categoria::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'Categoría eliminada Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'La Categoría no pudo eliminarse'
                            );
                        }
                        
                        echo json_encode($respuesta);

                }

            } else {
                $router -> render('admin/categorias/crear', [
                    'errores' => $errores,
                    'titulo_pagina' => $titulo_pagina,
                    'resultado' => $resultado,
                    'categoria' => $categoria,
                    'id' => $id

                ]);
            }
        }
        public static function listar( Router $router ){
            
            $categorias = Categoria::getAll();
        
            //debuguear($eventos);
            
            $titulo_pagina = 'Listado de Categorias';

            
            $router -> render('admin/categorias/listar', [
                'categorias' => $categorias,
                'titulo_pagina' => $titulo_pagina   

            ]);
            
        }
    }
?>