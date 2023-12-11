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
            $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
            $NOMBRE = $_POST['NOMBRE'];
            $DESCRIPCION = $_POST['DESCRIPCION'];
            $GENERICO_PATENTE = $_POST['GENERICO_PATENTE'];
            $Precio_m = $_POST['Precio_m'];
            $FECHA_CADUCIDAD = date('Y-m-d', strtotime($_POST['FECHA_CADUCIDAD'])); // Formato de fecha compatible con MySQL
            $STOCK_MAX = $_POST['STOCK_MAX'];
            $STOCK_MIN = $_POST['STOCK_MIN'];
            $CANTIDAD_EXISTENCIA = $_POST['CANTIDAD_EXISTENCIA'];
            $ID_COMPUESTO = $_POST['ID_COMPUESTO'];

            // Ejecutar consulta de inserción
            $query = "INSERT INTO Medicamento (ID_PRODUCTO, NOMBRE, DESCRIPCION, GENERICO_PATENTE, Precio_m, FECHA_CADUCIDAD, STOCK_MAX, STOCK_MIN, CANTIDAD_EXISTENCIA, ID_COMPUESTO) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("isssdssiis", $ID_PRODUCTO, $NOMBRE, $DESCRIPCION, $GENERICO_PATENTE, $Precio_m, $FECHA_CADUCIDAD, $STOCK_MAX, $STOCK_MIN, $CANTIDAD_EXISTENCIA, $ID_COMPUESTO);

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
            $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
            $NOMBRE = $_POST['NOMBRE'];
            $DESCRIPCION = $_POST['DESCRIPCION'];
            $GENERICO_PATENTE = $_POST['GENERICO_PATENTE'];
            $Precio_m = $_POST['Precio_m'];
            $FECHA_CADUCIDAD = date('Y-m-d', strtotime($_POST['FECHA_CADUCIDAD'])); // Formato de fecha compatible con MySQL
            $STOCK_MAX = $_POST['STOCK_MAX'];
            $STOCK_MIN = $_POST['STOCK_MIN'];
            $CANTIDAD_EXISTENCIA = $_POST['CANTIDAD_EXISTENCIA'];
            $ID_COMPUESTO = $_POST['ID_COMPUESTO'];

            $query = "UPDATE Medicamento 
            SET NOMBRE = ?, DESCRIPCION = ?, GENERICO_PATENTE = ?, Precio_m = ?, FECHA_CADUCIDAD = ?, STOCK_MAX = ?, STOCK_MIN = ?, CANTIDAD_EXISTENCIA = ?, ID_COMPUESTO = ?
            WHERE ID_PRODUCTO = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("sssdssiisi", $NOMBRE, $DESCRIPCION, $GENERICO_PATENTE, $Precio_m, $FECHA_CADUCIDAD, $STOCK_MAX, $STOCK_MIN, $CANTIDAD_EXISTENCIA, $ID_COMPUESTO, $ID_PRODUCTO);

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
            $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
            $query = "DELETE FROM Medicamento WHERE ID_PRODUCTO = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("i", $ID_PRODUCTO);

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
