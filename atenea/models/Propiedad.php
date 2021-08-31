<?php 
    namespace Model;

    class Propiedad extends ActiveRecord {

        protected static $tabla = 'propiedades';
        protected static $columnasDB = ['id','titulo','precio','imagen','descripcion','habitaciones','wc','cocheras','vendedorId','creado'];    
        
        // definimos los atributos de la clase
        public $id;
        public $titulo;
        public $precio;
        public $imagen;
        public $descripcion;
        public $habitaciones;
        public $wc;
        public $cocheras;
        public $creado;
        public $vendedorId;

        // Constructor de la clase Propiedades
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> titulo = $args['titulo'] ?? '';
            $this -> precio = $args['precio'] ?? '';            
            $this -> imagen = $args['imagen'] ?? '';
            $this -> descripcion = $args['descripcion'] ?? '';
            $this -> habitaciones = $args['habitaciones'] ?? '';
            $this -> wc = $args['wc'] ?? '';
            $this -> cocheras = $args['cocheras'] ?? '';
            $this -> creado = date('Y-m-d') ?? '';
            $this -> vendedorId = $args['vendedorId'] ?? '';  
        
        }

        public function validar(){
                
            if(!$this -> titulo){
                self::$errores[] = 'Debes colocar un título a la propiedad';
            }
            if(!$this-> precio){
                self::$errores[] = 'Debes colocar un precio a la propiedad';
            }
            if(strlen($this->descripcion) <50){
                self::$errores[] = 'Debes colocar una descripción de la propiedad de al menos 50 caracteres';
            }
    
            if(!$this-> imagen){
                 self::$errores[] = 'Debes cargar una imagen a la propiedad';
             }
    
            if(!$this-> habitaciones){
                self::$errores[] = 'Debes colocar la cantidad de habitaciones de la propiedad';
            }
            if(!$this-> wc){
                self::$errores[] = 'Debes colocar la cantidad de baños de la propiedad';
            }
            if(!$this-> cocheras){
                self::$errores[] = 'Debes colocar la cantidad de cocheras de la propiedad';
            }
            if(!$this-> vendedorId){
                self::$errores[] = 'Debes asignar un vendedor a la propiedad';
            } 
            return self::$errores;     
        }

    
    }
?>