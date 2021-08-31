<?php 
    namespace Model;

    class Vendedor extends ActiveRecord {
        protected static $tabla = 'vendedores';
        protected static $columnasDB = ['id','nombre','apellido','telefono'];    

        // definimos los atributos de la clase
        public $id;
        public $nombre;
        public $apellido;
        public $telefono;

        // Constructor de la clase Vendedor
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> nombre = $args['nombre'] ?? '';
            $this -> apellido = $args['apellido'] ?? '';            
            $this -> telefono = $args['telefono'] ?? '';
        }

        public function validar(){
                
            if(!$this -> nombre){
                self::$errores[] = 'Debes colocar un nombre';
            }
            if(!$this-> apellido){
                self::$errores[] = 'Debes colocar un apellido';
            }
            if(!$this-> telefono){
                self::$errores[] = 'Debes colocar un teléfono';
            } 
            if(!preg_match('/[0-9]{10}/',$this -> telefono)){
                self::$errores[] = 'Formato de teléfono NO válido';
            }

            return self::$errores;     
        }

    }
?>