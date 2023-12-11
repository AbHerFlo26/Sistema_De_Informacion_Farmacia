<?php
// Establecer una conexión a la base de datos MySQL

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'sistema_farmacia';

$conexion = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Procesar las operaciones del formulario
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'alta':
            // Realizar operación de alta en la base de datos
            $id_proveedor = $_POST['id_proveedor'];
            $Nombre_P = $_POST['Nombre_P'];
            $ap_P_p = $_POST['ap_P_p'];
            $ap_M_p = $_POST['ap_M_p'];
            $Empresa = $_POST['Empresa'];
            $num_telefono = $_POST['num_telefono'];
            $horario = $_POST['horario'];

            // Ejecutar consulta de inserción
            $query = "INSERT INTO PROVEEDOR_F (id_proveedor, Nombre_P, ap_P_p, ap_M_p, Empresa, num_telefono, horario) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("issssss", $id_proveedor, $Nombre_P, $ap_P_p, $ap_M_p, $Empresa, $num_telefono, $horario);

            try {
                if ($stmt->execute()) {
                    // Operación de alta exitosa
                    header("Location: ../html/Registro_exito.html");
                    exit;
                } else {
                    throw new Exception("Error en la operación de alta: " . $stmt->error);
                }
            } catch (Exception $e) {
                // Manejar la excepción (registro duplicado u otro error)
                header("Location: ../html/Registro_fallo.html");
            }
            $stmt->close();
            break;

        // Agregar casos para las operaciones de búsqueda, modificación y baja

        case 'buscar':
            // Realizar operación de búsqueda en la base de datos
            break;

        case 'modificar':
            // Realizar operación de modificación en la base de datos
            $id_proveedor = $_POST['id_proveedor'];
            $Nombre_P = $_POST['Nombre_P'];
            $ap_P_p = $_POST['ap_P_p'];
            $ap_M_p = $_POST['ap_M_p'];
            $Empresa = $_POST['Empresa'];
            $num_telefono = $_POST['num_telefono'];
            $horario = $_POST['horario'];

            $query = "UPDATE PROVEEDOR_F 
            SET Nombre_P = ?, ap_P_p = ?, ap_M_p = ?, Empresa = ?, num_telefono = ?, horario = ?
            WHERE id_proveedor = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("ssssssi", $Nombre_P, $ap_P_p, $ap_M_p, $Empresa, $num_telefono, $horario, $id_proveedor);

            try {
                if ($stmt->execute()) {
                    // Operación de actualizacion exitosa
                    header("Location: ../html/Update_exito.html");
                    exit;
                } else {
                    throw new Exception("Error en la operación de update: " . $stmt->error);
                }
            } catch (Exception $e) {
                // Manejar la excepción 
                header("Location: ../html/Update_fallo.html");
            }

            $stmt->close();
            break;

        case 'baja':
            // Realizar operación de baja en la base de datos
            $id_proveedor = $_POST['id_proveedor'];
            $query = "DELETE FROM PROVEEDOR_F WHERE id_proveedor = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("i", $id_proveedor);

            try {
                if ($stmt->execute()) {
                    // Operación de  Eliminacion exitosa
                    header("Location: ../html/Eliminacion_exito.html");
                    exit;
                } else {
                    throw new Exception("Error en la operación de update: " . $stmt->error);
                }
            } catch (Exception $e) {
                // Manejar la excepción 
                header("Location: ../html/Eliminacion_fallo.html");
            }

            $stmt->close();
            break;

        case 'Regresar':
            // Redirigir al usuario a la página principal (index.html en este ejemplo)
            header('Location: ../php/Inicio.php'); // Cambia "index.html" por la URL de tu página principal
            exit; // Finaliza el script para evitar más ejecución

        default:
            echo "Operación no válida.";
            break;
    }
}

$conexion->close();
?>
