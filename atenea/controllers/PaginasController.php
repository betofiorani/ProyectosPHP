<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Propiedad;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class PaginasController {

        public static function index(Router $router){
            
            $inicio = true;
            $limit = 3;

            $propiedades = Propiedad::getLimit($limit);

            $router -> render('paginas/index',[
                'inicio' => $inicio,
                'propiedades' => $propiedades
            ]);

        }
        public static function nosotros(Router $router){
            $router -> render('paginas/nosotros',[
                
            ]);
 
        }
        public static function venta(Router $router){
            $propiedades = Propiedad::getAll();

            $router -> render('paginas/venta',[
                'propiedades' => $propiedades
            ]);
        }
        public static function propiedad(Router $router){
            
            $id = validarORedireccionar('/');

            $propiedad = Propiedad::getRegistro($id);

            $router -> render('paginas/propiedad',[
                'propiedad' => $propiedad
            ]);
        }
        public static function blog(Router $router){
            $router -> render('paginas/blog',[
                
            ]);
        }
        public static function entrada(Router $router){
            $router -> render('paginas/entrada',[
                
            ]);
        }
        public static function contacto(Router $router){
            
            $mensaje = null;
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                
                $respuestas = $_POST['contacto'];
                
                //debuguear($respuestas);
                // Crear una instancia de PHPMAILER
                $mail = new PHPMailer(true);

                try {
                    // Configurar SMTP
                    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // te muestra si todo está correcto
                    $mail -> isSMTP();
                    $mail -> Host = 'smtp.mailtrap.io';
                    $mail -> SMTPAuth = true;
                    $mail -> Username = 'b6e130b673a5ca';
                    $mail -> Password = '41dc32b3fd34c2';
                    $mail -> SMTPSecure = 'tls';
                    $mail -> Port = 2525;

                    // Configurar el contenido del Mail
                    $mail -> setFrom('admin@atenea.com.ar');
                    $mail -> addAddress('admin@atenea.com.ar','Atenea');
                    $mail -> Subject = 'Tienes una nueva Consulta';

                    // Configurar el HTML del mail
                    $mail -> isHTML(true);
                    $mail -> CharSet = 'UTF-8';

                    // Configurar el Contenido del Mail
                    $contenido  = '<html>';
                    $contenido .= '<p>Tienes una nueva consulta</p>';
                    $contenido .= '<p>Nombre: '.$respuestas['nombre'].'</p>';
                    $contenido .= '<p>Consulta: '.$respuestas['mensaje'].'</p>';
                    $contenido .= '<p>Tipo de Operación: '.$respuestas['operacion'].'</p>';
                    $contenido .= '<p>Presupuesto: $'.$respuestas['precio'].'</p>';
                    $contenido .= '<p>Forma de Contacto: '.$respuestas['tipo-contacto'].'</p>';
                    if($respuestas['tipo-contacto'] === 'telefono'){
                        $contenido .= '<p>Teléfono: '.$respuestas['telefono'].'</p>';
                        $contenido .= '<p>Fecha: '.$respuestas['fecha'].'</p>';
                        $contenido .= '<p>Hora: '.$respuestas['hora'].'</p>';
                    }
                    else if($respuestas['tipo-contacto'] === 'whatsapp'){
                        $contenido .= '<p>Teléfono: '.$respuestas['telefono'].'</p>';
                        $contenido .= '<p>Fecha: '.$respuestas['fecha'].'</p>';
                        $contenido .= '<p>Hora: '.$respuestas['hora'].'</p>';

                    } else
                    
                    {
                        $contenido .= '<p>Mail: '.$respuestas['email'].'</p>';
                    }
                    $contenido .= '</html>';
                    
                    //debuguear($contenido);
                    $mail -> Body = $contenido;
                    $mail -> AltBody = 'Texto alternativo sin html';

                    $mail -> send();
                    $mensaje = 'Mensaje Enviado Correctamente';
                    
                } catch (Exception $e) {
                    $mensaje = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                
            }   
            $router -> render('paginas/contacto',[
                'mensaje' => $mensaje    
            ]);
        }
    }

?>
