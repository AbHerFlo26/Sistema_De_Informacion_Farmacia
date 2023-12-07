<?php
require_once('conexion_bd.php');
$id = $_POST['id'];
$new_password = $_POST['new_password'];

$query = "UPDATE usuario SET password = '$new_password' WHERE id = $id" ;
$result = $conexion->query($query);

header("Location: Login.php?message=succes_password");

?>