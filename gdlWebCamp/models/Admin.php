<?php
    namespace Model;

    class Admin extends ActiveRecord {
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id','usuario','password','imagen','nombre','nivel'];    

        // definimos los atributos de la clase
        public $id;
        public $usuario;
        public $password;
        public $imagen;
        public $nombre;
        public $nivel;

        // Constructor de la clase Vendedor
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> usuario = $args['usuario'] ?? '';
            $this -> password = $args['password'] ?? '';            
            $this -> imagen = $args['nombreImagen'] ?? '';            
            $this -> nombre = $args['nombre'] ?? '';
            $this -> nivel = $args['nivel'] ?? '';
            
        }

        public function validar(){
                
            if(!$this -> usuario){
                self::$errores[] = 'Debes colocar un Usuario';
            }
            if(!$this -> nombre){
                self::$errores[] = 'Debes colocar un Nombre';
            }

            if(!$this-> password){
                self::$errores[] = 'Debes colocar un password con al menos 1 mayúscula y 1 número';
            }

            return self::$errores;     
        }

        public function validarAutenticar(){
                
            if(!$this -> usuario){
                self::$errores[] = 'Debes colocar un Usuario';
            }
            
            if(!$this-> password){
                self::$errores[] = 'Debes colocar un password con al menos 1 mayúscula y 1 número';
            }

            if($this -> usuario && $this-> password){
                $usuario = self::getRegistroValor('usuario',$this -> usuario);
                if(!$usuario){
                    self::$errores[] = 'El Usuario es inexistente';
                } else {
                    $auth = password_verify($this -> password , $usuario -> password);
                    if(!$auth){
                        self::$errores[] = 'La Contraseña es incorrecta';
                    }
                }
            }
            return self::$errores;     
        }

        public function autenticar(){

            $usuario = self::getRegistroValor('usuario',$this -> usuario);

            session_destroy();

            session_start();

            // llenamos la sesion de datos. Podés poner lo que quieras
            $_SESSION['usuario'] = $this -> usuario;
            $_SESSION['login'] = true;
            $_SESSION['nivel'] = $usuario -> nivel;
            $_SESSION['id'] = $usuario -> id;

            header('Location: /admin');

        }
    }

?>