<?php

    require 'funciones.php';
    require 'config/database.php';
    require __DIR__.'/../vendor/autoload.php';

    $db = conectarDB('localhost','root','','atenea');

    use Model\ActiveRecord;
    ActiveRecord::setDB($db);
?>