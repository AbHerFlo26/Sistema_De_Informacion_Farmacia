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
            $id_producto = $_POST['id_producto'];
            $nombre_comercial = $_POST['nombre_comercial'];
            $precio_g = $_POST['precio_g'];
            $fecha_caducidad = date('Y-m-d', strtotime($_POST['fecha_caducidad'])); // Ajustar el formato de fecha para MySQL
            $cantidad_existencia = $_POST['cantidad_existencia'];
            $iva = $_POST['iva'];
            $STOCK_MAX = $_POST['STOCK_MAX'];
            $STOCK_MIN = $_POST['STOCK_MIN'];

            // Ejecutar consulta de inserción
            $query = "INSERT INTO Producto_general (id_producto, nombre_comercial, precio_g, fecha_caducidad, cantidad_existencia, iva, STOCK_MAX, STOCK_MIN) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param('isdsdiis', $id_producto, $nombre_comercial, $precio_g, $fecha_caducidad, $cantidad_existencia, $iva, $STOCK_MAX, $STOCK_MIN);

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
            $id_producto = $_POST['id_producto'];
            $nombre_comercial = $_POST['nombre_comercial'];
            $precio_g = $_POST['precio_g'];
            $fecha_caducidad = date('Y-m-d', strtotime($_POST['fecha_caducidad'])); // Ajustar el formato de fecha para MySQL
            $cantidad_existencia = $_POST['cantidad_existencia'];
            $iva = $_POST['iva'];
            $STOCK_MAX = $_POST['STOCK_MAX'];
            $STOCK_MIN = $_POST['STOCK_MIN'];

            $query = "UPDATE Producto_general 
                      SET nombre_comercial = ?, precio_g = ?, fecha_caducidad = ?, cantidad_existencia = ?, iva = ?, STOCK_MAX = ?, STOCK_MIN = ?
                      WHERE id_producto = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param('sdsdiisi', $nombre_comercial, $precio_g, $fecha_caducidad, $cantidad_existencia, $iva, $STOCK_MAX, $STOCK_MIN, $id_producto);

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
            $id_producto = $_POST['id_producto'];
            $stmt = $conexion->prepare("DELETE FROM Producto_general WHERE id_producto = ?");
            $stmt->bind_param('i', $id_producto);

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
            // Redirigir al usuario a la página principal (Index.html en este ejemplo)
            header('Location: Inicio.php');
            exit;

        default:
            echo "Operación no válida.";
            break;
    }
}

$conexion->close();
?>
