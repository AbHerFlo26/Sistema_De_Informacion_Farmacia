<?php
// Establecer una conexión a la base de datos MySQL (PhpMyAdmin)
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'sistema_farmacia';

$conexion = new mysqli($host, $user, $pass, $db);

// Procesar las operaciones del formulario
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'Registrarse':
            // Realizar operación de alta en la base de datos
            $Nombre = $_POST['Nombre'];
            $Apellidos = $_POST['Apellidos'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Ejecutar consulta de inserción
            $query = "INSERT INTO usuario (id_usuario, Nombre, Apellidos, username, password) 
                      VALUES (?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("issss", $id_cliente, $nombre_cliente, $ap_P_C, $ap_M_C, $NUM_TELEFONO);

            try {
                if ($stmt->execute()) {
                    // Operación de alta exitosa
                    header("Location: Registro_exito.html");
                    exit;
                } else {
                    throw new Exception("Error en la operación de alta: " . $stmt->error);
                }
            } catch (Exception $e) {
                // Manejar la excepción (registro duplicado u otro error)
                header("Location: Registro_fallo.html");
            }

            $stmt->close();
            break;

        // Agregar casos para las operaciones de búsqueda, modificación y baja

        case 'buscar':
            // Realizar operación de búsqueda en la base de datos
            break;

        case 'modificar':
            // Realizar operación de modificación en la base de datos
            $id_cliente = $_POST['id_cliente'];
            $nombre_cliente = $_POST['nombre_cliente'];
            $ap_P_C = $_POST['ap_P_C'];
            $ap_M_C = $_POST['ap_M_C'];
            $NUM_TELEFONO = $_POST['NUM_TELEFONO'];

            $query = "UPDATE CLIENTE_F 
                      SET nombre_cliente = ?, ap_P_C = ?, ap_M_C = ?, NUM_TELEFONO = ?
                      WHERE id_cliente = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("ssssi", $nombre_cliente, $ap_P_C, $ap_M_C, $NUM_TELEFONO, $id_cliente);

            try {
                if ($stmt->execute()) {
                    // Operación de actualizacion exitosa
                    header("Location: Update_exito.html");
                    exit;
                } else {
                    throw new Exception("Error en la operación de update: " . $stmt->error);
                }
            } catch (Exception $e) {
                // Manejar la excepción 
                header("Location: Update_fallo.html");
            }

            $stmt->close();
            break;

        case 'baja':
            // Realizar operación de baja en la base de datos
            $id_cliente = $_POST['id_cliente'];
            $query = "DELETE FROM CLIENTE_F WHERE id_cliente = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("i", $id_cliente);

            try {
                if ($stmt->execute()) {
                    // Operación de  Eliminacion exitosa
                    header("Location: Eliminacion_exito.html");
                    exit;
                } else {
                    throw new Exception("Error en la operación de update: " . $stmt->error);
                }
            } catch (Exception $e) {
                // Manejar la excepción 
                header("Location: Eliminacion_fallo.html");
            }

            $stmt->close();
            break;

        case 'Regresar':
            // Redirigir al usuario a la página principal (index.html en este ejemplo)
            header('Location:Inicio.php'); // Cambia "index.html" por la URL de tu página principal
            exit; // Finaliza el script para evitar más ejecución

        default:
            echo "Operación no válida.";
            break;
    }
}

$conexion->close();
?>
