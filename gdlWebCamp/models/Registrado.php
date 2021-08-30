<?php 
    namespace Model; // siempre arriba
    
    require '../includes/paypal_config.php';
    use PayPal\Api\Amount;
    use PayPal\Api\Payer;
    use PayPal\Api\Item;
    use PayPal\Api\ItemList;
    use PayPal\Api\Details;
    use PayPal\Api\Payment;
    use PayPal\Api\RedirectUrls;
    use PayPal\Api\Transaction;
    use Paypal\Exception\PayPalConnectionException;
    use PayPal\Rest\ApiContext;
    use PayPal\Api\PaymentExecution;
   
    class Registrado extends ActiveRecord {

        protected static $id_insertado;
        
        public static function setIdInsertado($id){
            self::$id_insertado = $id;
        }

        protected static $tabla = 'registrados';
        protected static $columnasDB = ['id','nombre_registrado','apellido_registrado','email_registrado','fecha_registro','pases_articulos','talleres_registrados','regalo_id','total_pagado','pagado'];    
        
        // definimos los atributos de la clase
        public $id;
        public $nombre_registrado;
        public $apellido_registrado;
        public $email_registrado;
        public $fecha_registro;
        public $pases_articulos;
        public $talleres_registrados;
        public $regalo_id;
        public $total_pagado;
        public $pagado;

        // Constructor de la clase Propiedades
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> nombre_registrado = $args['nombre_registrado'] ?? '';
            $this -> apellido_registrado = $args['apellido_registrado'] ?? '';            
            $this -> email_registrado = $args['email_registrado'] ?? '';
            $this -> fecha_registro = date("Y-m-d H:i:s");
            $this -> pases_articulos = self::convertirJSON($args['pases_articulos'] ?? '');
            $this -> talleres_registrados = self::convertirJSON($args['talleres_registrados'] ?? '');
            $this -> regalo_id = $args['regalo_id'] ?? '';
            $this -> total_pagado = $args['total_pagado'] ?? '';
            $this -> pagado = $args['pagado'] ?? '';

        }

        public function validar(){
                
            if(!$this -> nombre_registrado){
                self::$errores[] = 'Debes colocar un nombre';
            }
            if(!$this-> apellido_registrado){
                self::$errores[] = 'Debes colocar una apellido';
            }
    
            if(!$this-> email_registrado){
                 self::$errores[] = 'Debes ingresar un mail válido';
             }
    
            if(!$this-> talleres_registrados){
                self::$errores[] = 'Debes elegir al menos 1 taller/conferencia/seminario';
            }
            if(!$this-> regalo_id){
                self::$errores[] = 'Debes elegir un Regalo';
            }
            
            return self::$errores;     
        }  

        public function crear(){
        
            // Primero hay que sanitizar los datos. Evitar datos basura o inyecciones sql
            $datos = $this -> sanitizarDatos();

            // insertar datos a la Base de datos
            $query = "INSERT INTO ";
            $query.= static::$tabla;
            $query.= " ( ";
            $query.= join(', ',array_keys($datos)); 
            $query.= " ) VALUES ('";
            $query.= join("','",array_values($datos));
            $query.= "') ";
            
            // llamamos la conexión que almacenamos en forma estática con self.
            // Al ser mysqli query en su forma orientada a objetos
            $resultado = self::$db->query($query);

            // obtenemos el id insertado
            $id_insertado = self::$db->insert_id;

            // lo mando a la variable estática.
            self::setIdInsertado($id_insertado);
                   
        }

        public function pagarPaypal(){

            $id = self::$id_insertado;

            $compra = new Payer();
            $compra -> setPaymentMethod('paypal'); // configuramos la forma de pago.
    
            // armamos la lista da articulos a pagar. Se pasa un array con los articulos creados.
            $listaArticulos = new ItemList();

            // iniciamos el array que contendrá los articulos a cobrar
            $articulos = [];

            // Como no trabajamos con envío, y se le puede pasar a Paypal, la iniciamos en cero.
            $envio = 0;

            //$productos = $datos[['pases_articulos']];
            $pases_articulos = json_decode($this->pases_articulos);
            
            // Obtenemos el total a pagar sin envío.
            $totalSinEnvio = (int) $this ->total_pagado;

            foreach($pases_articulos as $producto => $atributos){

                $articulo = new Item();

                // hacemos un explode del name del input y obtenemos el nombre del producto.
                $inputName = explode('-',$producto);
                $nombre = $inputName[0];

                if($inputName[0] === 'pase'){
                    $nombre = $inputName[0].$inputName[1];
                }
                

                $agregar = 0;

                // agrego el nombre del producto.
                $articulo -> setName($nombre)
                          -> setCurrency('USD');

                foreach($atributos as $atributo => $valor){


                    if(explode("-",$atributo)[1] === "cantidad"){
                        if($valor === ''){
                            $agregar = 0;
                        }
                        else {
                            $agregar = 1;
                            $articulo -> setQuantity($valor);

                        }
                    } else {

                        if($inputName[0] === 'camisas'){
                            $descuento = 0.07; // definimos el descuento. Esto debería ser en otro lugar en un proyecto final.
                            $articulo -> setPrice($valor*(1-$descuento));
                        } else {
                        $articulo -> setPrice($valor);
                        }
                    }
                }

                if($agregar === 1){
                        $articulos[] = $articulo;
                }

            }
            
            $listaArticulos -> setItems($articulos);

            //debuguear($listaArticulos);

            // Agregamos los Detalles
            $detalles = new Details();
            $detalles ->setShipping($envio)
                      ->setSubtotal($totalSinEnvio);

            // Cantidad a pagar sería el total sin  envío mas los extras de detalles como es el envio por ejemplo.
            $cantidad = new Amount();
            $cantidad ->setCurrency('USD')
                    ->setTotal($totalSinEnvio + $envio)
                    ->setDetails($detalles);

            // instanciamos la transaccion
            $transaccion = new Transaction();
            $transaccion -> setAmount($cantidad)
                         -> setItemList($listaArticulos)
                         -> setDescription('Pago GDLWEBCAMP')
                         -> setInvoiceNumber($id); // Pasamos el id de la inserción de la base que traemos como parámetro en esta función

            //debuguear($transaccion);
            
            // redireccionamos al usuario

            $redireccionar = new RedirectUrls();
            $redireccionar -> setReturnUrl(URL_SITIO."/resumenRegistro?id_pago={$id}")
                           -> setCancelUrl(URL_SITIO."/resumenRegistro?id_pago={$id}");


            // enviar la info a Pay pal para efectuar el pago

            $pago = new Payment();
            $pago -> setIntent('sale')
                ->setPayer($compra)
                ->setRedirectUrls($redireccionar)
                ->setTransactions(array($transaccion));

            try {
                $pago -> create(self::$apiContext);
            } catch (PayPalConnectionException $pce) {
                echo "<pre>";
                print_r(json_decode($pce->getData()));
                exit;
                echo "</pre>";
            }

            $aprobado = $pago ->getApprovalLink();

            header("Location: {$aprobado}");

        }

        public function consultarPaypal($paymentId,$payerId){
            
            $pago = Payment::get($paymentId,self::$apiContext);
            $execution = new PaymentExecution();
            $execution -> setPayerId($payerId);

            // resultado tiene toda la información de la transacción solicitada
            $resultado = $pago -> execute($execution,self::$apiContext);

            $respuesta = $resultado -> transactions[0]->related_resources[0]->sale->state;

            return $respuesta;

        }
    }
?>