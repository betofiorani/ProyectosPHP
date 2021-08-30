<?php 
    namespace Model;

    class Regalo extends ActiveRecord {
        protected static $tabla = 'regalos';
        protected static $columnasDB = ['id','nombre_regalo'];    

        // definimos los atributos de la clase
        public $id;
        public $nombre_regalo;

        // Constructor de la clase Vendedor
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> nombre_regalo = $args['nombre_regalo'] ?? '';      
         
        }

        public function validar(){
                
            if(!$this -> nombre_regalo){
                self::$errores[] = 'Debes colocar un nombre al regalo';
            }

            // if(!preg_match('/[0-9]{10}/',$this -> telefono)){
            //     self::$errores[] = 'Formato de teléfono NO válido';
            // }

            return self::$errores;     
        }

    }
?>