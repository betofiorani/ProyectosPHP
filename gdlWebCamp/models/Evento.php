<?php 
    namespace Model;

    class Evento extends ActiveRecord {

        protected static $tabla = 'eventos';
        protected static $columnasDB = ['id','nombre_evento','fecha_evento','hora_evento','clave','categoria_id','invitado_id'];    
        
        // definimos los atributos de la clase
        public $id;
        public $nombre_evento;
        public $fecha_evento;
        public $hora_evento;
        public $clave;
        public $categoria_id;
        public $invitado_id;

        // Constructor de la clase Propiedades
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> nombre_evento = $args['nombre_evento'] ?? '';
            $this -> fecha_evento = $args['fecha_evento'] ?? '';            
            $this -> hora_evento = $args['hora_evento'] ?? '';
            $this -> clave = $args['clave'] ?? '';
            $this -> categoria_id = $args['categoria_id'] ?? '';
            $this -> invitado_id = $args['invitado_id'] ?? '';
        
        }

        public function validar(){
                
            if(!$this -> nombre_evento){
                self::$errores[] = 'Debes colocar un nombre al Evento';
            }
            if(!$this-> fecha_evento){
                self::$errores[] = 'Debes colocar una fecha al Evento';
            }
    
            if(!$this-> hora_evento){
                 self::$errores[] = 'Debes cargar una hora al Evento';
             }
    
            if(!$this-> clave){
                self::$errores[] = 'Debes colocar la clave del Evento';
            }
            if(!$this-> categoria_id){
                self::$errores[] = 'Debes elegir una categoría para el Evento';
            }
            if(!$this-> invitado_id){
                self::$errores[] = 'Debes elegir un Invitado para el Evento';
            }
            
            return self::$errores;     
        }

    
    }
?>