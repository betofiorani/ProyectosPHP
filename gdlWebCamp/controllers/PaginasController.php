<?php

    namespace Controllers;
    use MVC\Router;
    use Model\Evento;
    use Model\Invitado;
    use Model\Categoria;
    use Model\Registrado;
    use Model\Pase;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class PaginasController {

        // Construye la Home Page pública
        public static function index(Router $router){
            
            $invitados = Invitado::getLimit(6);
            $categorias = Categoria::getAll();
            $clase ="";
            $pases = Pase::getAll();

            $router -> render('paginas/index',[
                'invitados' => $invitados,
                'clase' => $clase,
                'categorias' => $categorias,
                'pases' => $pases
            ]);

        }
        public static function galeria(Router $router){
            
            $clase = 'conferencias';
            $router -> render('paginas/galeria',[   
                'clase' => $clase
            ]);
 
        }
        public static function calendario(Router $router){
            
            // $id = validarORedireccionar('/');

            $eventos = Evento::getAll();
            $clase = "calendarioH2";
            
            $router -> render('paginas/calendario',[
                'eventos' => $eventos,
                'clase' => $clase
            ]);
        }
        public static function invitados(Router $router){
            
            $invitados = Invitado::getAll();
            $clase = 'invitados';

            $router -> render('paginas/invitados',[
                'invitados' => $invitados,
                'clase' => $clase
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
                    $mail -> setFrom('admin@gdlwebcamp.com.ar');
                    $mail -> addAddress('admin@gdlwebcamp.com.ar','Atenea');
                    $mail -> Subject = 'GDLWEBCAMP - Nuevo Interesado en el Evento';

                    // Configurar el HTML del mail
                    $mail -> isHTML(true);
                    $mail -> CharSet = 'UTF-8';

                    // Configurar el Contenido del Mail
                    $contenido  = '<html>';
                    $contenido .= '<p>Nuevo suscripto al evento</p>';
                    $contenido .= '<p>Nombre: '.$respuestas['nombre'].'</p>';
                    $contenido .= '<p>email: '.$respuestas['email'].'</p>';
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
