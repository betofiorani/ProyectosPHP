<?php 
    namespace Model;

    class Invitado extends ActiveRecord {
        protected static $tabla = 'invitados';
        protected static $columnasDB = ['id','nombre_invitado','apellido_invitado','descripcion','imagen'];    

        // definimos los atributos de la clase
        public $id;
        public $nombre_invitado;
        public $apellido_invitado;
        public $descripcion;
        public $imagen;

        // Constructor de la clase Vendedor
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> nombre_invitado = $args['nombre_invitado'] ?? '';
            $this -> apellido_invitado = $args['apellido_invitado'] ?? '';            
            $this -> descripcion = $args['descripcion'] ?? '';
            $this -> imagen = $args['imagen'] ?? '';
        }

        public function validar(){
                
            if(!$this -> nombre_invitado){
                self::$errores[] = 'Debes colocar un nombre';
            }
            if(!$this-> apellido_invitado){
                self::$errores[] = 'Debes colocar un apellido';
            }
            if(!$this-> descripcion){
                self::$errores[] = 'Debes colocar una descripcion';
            } 
            if(!$this-> imagen){
                self::$errores[] = 'Debes colocar una imagen';
            }

            // if(!preg_match('/[0-9]{10}/',$this -> telefono)){
            //     self::$errores[] = 'Formato de teléfono NO válido';
            // }

            return self::$errores;     
        }

    }
?>