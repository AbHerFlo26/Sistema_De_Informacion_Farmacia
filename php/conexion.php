<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'sistema_farmacia';

    $conexion = new mysqli($host,$user,$pass,$db);

    if ($conexion->connect_errno){
        die ("Conexion fallida".$conexion->connect_errno);
    }else{
        echo "base de datos conectada";
    }
?>