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

        public static function crear( Router $router ){
            
            // Instanciamos un nuevo objeto de la clase Evento.
            $registrado = new Registrado;

            $regalos = Regalo::getAll();
            $pases = Pase::getAll();
            $categorias = Categoria::getAll();
            $dias['Viernes'][] = '2016-12-09'; 
            $dias['Sabado'][] = '2016-12-10';
            $dias['Domingo'][] = '2016-12-11';

            // Incializamos algunas variables para que estén en toda la función.
            $resultado = "";
            $id ="";
            $titulo_pagina = 'Crear Registrado';

            // Revisamos que no haya en la url, un get. No lo estoy usando, por los Sweet alert y ajax.
            // if(isset($_GET['resultado'])){
            //     $resultado = $_GET['resultado'];
            // }
            
            // Revisamos si hay un GET con el id. Si esto existe, se trata de una edición no de un alta.
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $titulo_pagina = 'Editar Registrado';

                // utilizamos el método de la clase para obtener todos los campos de la tabla categoria para ese id.
                $registrado = Registrado::getRegistro($id);
            }
            // obtenemos el arreglo de errores utilizando el método de la clase ActiveRecords.
            $errores = Registrado::getErrores();

            // Revisamos si estamos recibiendo un POST
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
                // revisamos la accion    
                if($_POST['accion'] === 'crear'){

                    //Instanciamos una usuario de la clase Admin con los resultados del post
                    $registrado = new Registrado($_POST['registrado']);

                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $registrado -> validar();
                    
                    // Revisar que el array de errores esté vacío
                    if(empty($errores)){

                        // invocamos el método para guardar (solo sabe si crea o actualiza en funcion de si existe id o no)
                        $registrado -> guardar();
                        // obtenemos el resultado del query
                        $resultado = Registrado::getResultado();

                        // preparamos la respuesta para el AJAX
                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'Registrado creado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'crear',
                                'texto' => 'El Registrado ya existe'
                            );
                        }
                        
                        echo json_encode($respuesta);

                    }
                    
                } else if($_POST['accion'] === 'actualizar'){

                    $registrado = Registrado::getRegistro($_POST['id']);
                    
                    // Asignar los atributos
                    $args = $_POST['registrado']; // En los name se les da formato de array entonces todo queda agrupado  

                    $registrado -> sincronizar($args);
            
                    // invocamos el método para validar y lo guardamos en el array errores
                    $errores = $registrado -> validar();

                    if(empty($errores)){

                        $registrado -> guardar();
                        $resultado = Registrado::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'Registrado actualizado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'actualizar',
                                'texto' => 'El registrado no pudo actualizarse'
                            );
                        }
                        
                        echo json_encode($respuesta);
                    }               
                } else {
                    $registrado = Registrado::getRegistro($_POST['id']);
                    $registrado ->eliminar();

                    $resultado = Registrado::getResultado();

                        if($resultado === 'exito'){
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'Registrado eliminado Exitosamente'
                            );
                        } else {
                            $respuesta = array(
                                'respuesta' => $resultado,
                                'tipo' => 'eliminar',
                                'texto' => 'El Registrado no pudo eliminarse'
                            );
                        }
                        
                        echo json_encode($respuesta);

                }

            } else {
                $router -> render('admin/registrados/crear', [
                    'errores' => $errores,
                    'titulo_pagina' => $titulo_pagina,
                    'resultado' => $resultado,
                    'registrado' => $registrado,
                    'id' => $id,
                    'dias' => $dias,
                    'pases' => $pases,
                    'regalos' => $regalos,
                    'categorias' => $categorias

                ]);
            }
        }
        public static function listar( Router $router ){
            
            $registrados = Registrado::getAll();
        
            //debuguear($eventos);
            
            $titulo_pagina = 'Listado de Registrados';

            
            $router -> render('admin/registrados/listar', [
                'registrados' => $registrados,
                'titulo_pagina' => $titulo_pagina   

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
        
                //Instanciamos una propiedad de la clase Propiedad con los resultados del post
                $registrado = new Registrado($_POST['registrado']);

                // invocamos el método para validar y lo guardamos en el array errores
                $errores = $registrado -> validar();
        
                // Revisar que el array de errores esté vacío
                if(empty($errores)){

                    // pagar con Paypal
        
                    // invocamos el método para guardar
                    $registrado -> guardar();

                    $registrado -> pagarPaypal();

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
        
        public static function resumenRegistro(Router $router){
            
            $id_pago = $_GET['id_pago'] ?? null; // se podría usar isset($_GET['resultado']) pero ?? es lo ultimo en PHP
            $paymentId = $_GET['paymentId'] ?? null; // este paymentId lo genera paypal
            $payerId = $_GET['PayerID'] ?? null; // este paymentId lo genera paypal
            
            // aca podriamos ejecutar el actualizar tabla. Tenemos el id.
            
            $registrado = new Registrado();

            $resultado = $registrado ->consultarPaypal($paymentId,$payerId);
            //debuguear($resultado);
            if($resultado === 'completed'){
                $registrado ->actualizarValor('pagado',1,$id_pago);
            };
            

            $router -> render('paginas/resumenRegistro',[
                'resultado'=> $resultado,
                'id_pago' => $id_pago,
                'paymentId' => $paymentId
            ]);
        }
    }

?>