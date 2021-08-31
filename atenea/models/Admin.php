<?php
    namespace Model;

    class Admin extends ActiveRecord {
        protected static $tabla = 'usuarios';
        protected static $columnasDB = ['id','email','password'];    

        // definimos los atributos de la clase
        public $id;
        public $email;
        public $password;

        // Constructor de la clase Vendedor
        public function __construct($args = [])
        {
            $this -> id = $args['id'] ?? null;
            $this -> email = $args['email'] ?? '';
            $this -> password = $args['password'] ?? '';            
        }

        public function validar(){
                
            if(!$this -> email){
                self::$errores[] = 'Debes colocar un email válido';
            }
            if(!$this-> password){
                self::$errores[] = 'Debes colocar un password con al menos 1 mayúscula y 1 número';
            }
            
            
            if($this -> email && $this-> password){
                $usuario = self::getRegistroValor('email',$this -> email);
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

            session_start();

            // llenamos la sesion de datos. Podés poner lo que quieras
            $_SESSION['usuario'] = $this -> email;
            $_SESSION['login'] = true;

            header('Location: /admin');

        }
    }

?>