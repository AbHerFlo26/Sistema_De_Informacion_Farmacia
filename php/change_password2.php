<?php
require_once('conexion_bd.php');
$id_usuario = $_POST['id_usuario'];
$new_clave = $_POST['new_clave'];

$query = "UPDATE usuario SET clave = '$new_clave' WHERE id_usuario = '$id_usuario'" ;
$result = $conexion->query($query);

header("Location: Login.php?message=succes_password");

?>