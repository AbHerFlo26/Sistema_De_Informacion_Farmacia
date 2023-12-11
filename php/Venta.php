<?php
// Establecer una conexión a la base de datos MySQL
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'sistema_farmacia';

$conexion = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Procesar las operaciones del formulario
if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        case 'alta':
            // Realizar operación de alta en la base de datos
            $id_venta = $_POST['id_venta'];
            $Id_empleado = $_POST['Id_empleado'];
            $id_cliente = $_POST['id_cliente'];
            $id_producto = $_POST['id_producto'];
            $fecha = date('Y-m-d', strtotime($_POST['fecha'])); // Ajustar el formato de fecha para MySQL
            $total = $_POST['total'];

            // Ejecutar consulta de inserción
            $query = "INSERT INTO Venta_f (id_venta, Id_emp, id_cliente, id_producto, fecha, total) 
                      VALUES (?, ?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param('iiisds', $id_venta, $Id_empleado, $id_cliente, $id_producto, $fecha, $total);

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
            $id_venta = $_POST['id_venta'];
            $Id_empleado = $_POST['Id_empleado'];
            $id_cliente = $_POST['id_cliente'];
            $id_producto = $_POST['id_producto'];
            $fecha = date('Y-m-d', strtotime($_POST['fecha'])); // Ajustar el formato de fecha para MySQL
            $total = $_POST['total'];

            $query = "UPDATE Venta_f 
                      SET Id_emp = ?, id_cliente = ?, id_producto = ?, fecha = ?, total = ?
                      WHERE id_venta = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param('iisdsi', $Id_empleado, $id_cliente, $id_producto, $fecha, $total, $id_venta);

            
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
            $id_venta = $_POST['id_venta'];
            $stmt = $conexion->prepare("DELETE FROM Venta_f WHERE id_venta = ?");
            $stmt->bind_param('i', $id_venta);

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
            // Redirigir al usuario a la página principal (Index.html en este ejemplo)
            header('Location: ../php/Inicio.php'); // Cambia "index.html" por la URL de tu página principal
            exit;

        default:
            echo "Operación no válida.";
            break;
    }
}

$conexion->close();
?>
