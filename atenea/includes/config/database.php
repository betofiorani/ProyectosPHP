<?php
    function conectarDB($host, $user, $pass, $database) : mysqli{
        $db= new mysqli($host,$user,$pass,$database);
        $db -> query("SET NAMES 'utf8' ");
        if(!$db) {
            echo 'Conexión Fallida';
            exit;
        } 
        return $db;
    }
?>