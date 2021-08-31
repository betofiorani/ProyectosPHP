<?php

    namespace Model;

    class ActiveRecord {

        // Hacemos un atributo estático para la base de datos
        // evitamos una conexión cada vez que creamos un objeto
        protected static $db;

        // creamos un arreglo static con todas las columnas de la base para sanitizarlas todas.
        protected static $columnasDB = [];
        protected static $tabla = '';

        public static function setDB($database){
            self::$db = $database;
        }

        // Creamos una variable estática que se puede acceder y modificar en la clase sin necesidad de instanciarse
        protected static $errores = [];

        // metodo creado para identificar los atributos de la clase y armar un arreglo con ellos
        // uniendo con el foreach cada atributo con los datos del atributo en memoria.
        public function datos(){
            $datos = [];
            foreach (static::$columnasDB as $columna){
                if($columna === 'id') continue; // si se cumple la condicion continua... lo salta
                $datos[$columna] = $this->$columna;
            }
            return $datos;
        }

        public function sanitizarDatos(){
            $datos = $this->datos();
            $sanitizado = [];
            
            foreach ($datos as $key => $value){

                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }
        
        // Método para crear o actualizar un registro
        public function guardar(){
            if( !is_null( $this -> id)){
                $this -> actualizar();
            } else {
                $this -> crear();
            }
        }

        // método para crear
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
            
            if($resultado){
                header('Location: /admin?resultado=1');
            }           
        }

        // método para actualizar registro
        public function actualizar(){

            // Primero hay que sanitizar los datos. Evitar datos basura o inyecciones sql
            $datos = $this -> sanitizarDatos();
            $valores = [];

            foreach ($datos as $key => $value){       
                $valores[] = "{$key} = '{$value}'";
            }
            
            $query = "UPDATE ";
            $query.= static::$tabla;
            $query.= " SET ";
            $query.= join(',',$valores);
            $query.= " WHERE id ='". self::$db -> escape_string($this -> id)."'";
            $query.= " LIMIT 1";
                     
            $resultado = self::$db->query($query);

            if($resultado){
                header('Location: /admin?resultado=2');
            }
        }
        // Eliminar un registro
        public function eliminar(){
            
            // Eliminar registro
            $query = "DELETE FROM ";
            $query.= static::$tabla;
            $query.= " WHERE id='";
            $query.= self::$db -> escape_string($this -> id)."'";
            $query.= " LIMIT 1";

            $resultado = self::$db -> query($query);

            if($resultado){
                $this -> borrarImagen();
                header('location: /admin?resultado=3');
            }
        }

        // obtener array de errores
        public static function getErrores(){
            return static::$errores;
        }

        // subida de imagenes
        public function setImagen($imagen){ 
            // Eliminar imagen
            if(!is_null($this -> id)){
                $this -> borrarImagen();
            }
            
            // Asignar al atributo imagen el nombre de la imagen
            if($imagen) {
                $this -> imagen = $imagen;
            }
        }

        public function borrarImagen(){
            // Eliminar imagen
            $existeArchivo = file_exists(CARPETA_IMAGENES.$this ->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES.$this -> imagen);
            }
        }

        public function validar(){    
             
            static::$errores = [];
            return static::$errores;     
        }

        public static function consultarSQL($query){
            
            // 1ero - Consultar la base de datos
            $resultado = self::$db->query($query);
            
            // 2do - Iterar los resultados
            $array = [];

            while ($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }
            
            // 3ro - Liberar memoria
            $resultado -> free();

            // 4to - retornar resultados
            return $array;
        }

        // metodo para crear objetos
        protected static function crearObjeto($registro){
            $objeto = new static;
            foreach ($registro as $key => $value){
                if(property_exists($objeto , $key)){
                    $objeto -> $key = $value;
                }
            }
            return $objeto;
        }
        // Listar todos los registros
        public static function getAll(){

            $query = "SELECT * FROM ";
            $query .= static::$tabla; // static se usa en lugar de self para que cuando se herede, tome el valor que tenga en esa clase
            
            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        // Listar una cantidad de registros
        public static function getLimit($limit){

            $query = "SELECT * FROM ";
            $query .= static::$tabla; // static se usa en lugar de self para que cuando se herede, tome el valor que tenga en esa clase
            $query .= " LIMIT ".$limit;

            $resultado = self::consultarSQL($query);

            return $resultado;
        }

        // Listar un registro por Id
        public static function getRegistro($id){
            
            $query = "SELECT * FROM ";
            $query .= static::$tabla;
            $query .=" WHERE id='$id'"; 
            
            $resultado = self::consultarSQL($query);

            return array_shift($resultado); // Usamos Array Shift para que retorne el primer elemento del array
        }

        // buscar registro por valor de un campo determinado
        public static function getRegistroValor($campo, $valor){
            
            $query = "SELECT * FROM ";
            $query .= static::$tabla;
            $query .=" WHERE ";
            $query .= $campo;
            $query .= "='";
            $query .= $valor;
            $query .= "'"; 
            
            $resultado = self::consultarSQL($query);

            return array_shift($resultado); // Usamos Array Shift para que retorne el primer elemento del array
        }

        // sincronizar el objeto en memoria con los cambios realizados por el usuario
        public function sincronizar($args = []){
            foreach($args as $key => $value){
                if(property_exists($this,$key) && !is_null($value)){
                    $this -> $key = $value;
                }
            }
        }
    }
?>