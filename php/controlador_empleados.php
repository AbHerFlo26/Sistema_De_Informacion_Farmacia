<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tu Página con Bootstrap</title>

    <!-- Incluir Bootstrap desde un CDN (Content Delivery Network) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php
session_start();
// Tu lógica PHP aquí

if (!empty($_POST["btningresar"])) {
    if (empty($_POST["username"]) and empty($_POST["clave"])) {
        echo '<div class="alert alert-danger">LOS CAMPOS ESTÁN VACÍOS</div>';
    } else {
        $username=$_POST["username"];
        $clave=$_POST["clave"];
        $sql =$conexion->query("select * from usuario where username ='$username' and clave= '$clave'");
        
        if ($datos=$sql->fetch_object()) {
            $_SESSION["id"]=$datos->id_usuario;
            $_SESSION["nombre"]=$datos->Nombre;
            $_SESSION["Apellidos"]=$datos->Apellidos;

            // Agregar la validación del rol aquí
            if ($datos->rol_id == 1) {
                header("location: ../html/Empleado.html");
                exit(); // Asegura que se detenga la ejecución después de la redirección
            } else {
                echo '<div class="alert alert-danger">ACCESO DENEGADO</div>';
            }
        }
    }
}
?>

<!-- Contenido de tu página aquí -->

<!-- Agregar el botón de regreso -->


<!-- Incluir los scripts de Bootstrap (al final del body para un rendimiento óptimo) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
