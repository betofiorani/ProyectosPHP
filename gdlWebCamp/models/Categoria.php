<?php 
    namespace Model;

    class Categoria extends ActiveRecord {
        protected static $tabla = 'categoria_evento';
        protected static $columnasDB = ['id','cat_evento','icono'];    

        // definimos los atributos de la clase
        public $id;
        public $cat_evento;
        public $icono;

        // Constructor de la clase Vendedor
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> cat_evento = $args['cat_evento'] ?? '';
            $this -> icono = $args['icono'] ?? '';            
         
        }

        public function validar(){
                
            if(!$this -> cat_evento){
                self::$errores[] = 'Debes colocar un nombre a la Categoría';
            }
    
            if(!$this-> icono){
                self::$errores[] = 'Debes colocar un icono';
            }

            // if(!preg_match('/[0-9]{10}/',$this -> telefono)){
            //     self::$errores[] = 'Formato de teléfono NO válido';
            // }

            return self::$errores;     
        }

    }
?>