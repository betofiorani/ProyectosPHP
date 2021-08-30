<?php 
    namespace Model;

    class Pase extends ActiveRecord {
        protected static $tabla = 'pases';
        protected static $columnasDB = ['id','nombre_pase','precio'];    

        // definimos los atributos de la clase
        public $id;
        public $nombre_pase;
        public $precio;

        // Constructor de la clase Vendedor
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> cat_evento = $args['nombre_pase'] ?? '';
            $this -> icono = $args['precio'] ?? '';            
         
        }

        public function validar(){
                
            if(!$this -> nombre_pase){
                self::$errores[] = 'Debes colocar un nombre al pase';
            }
    
            if(!$this-> precio){
                self::$errores[] = 'Debes colocar un precio al pase';
            }

            // if(!preg_match('/[0-9]{10}/',$this -> telefono)){
            //     self::$errores[] = 'Formato de teléfono NO válido';
            // }

            return self::$errores;     
        }

    }
?>