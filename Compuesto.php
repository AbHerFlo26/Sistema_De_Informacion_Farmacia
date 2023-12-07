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
            $ID_COMPUESTO = $_POST['ID_COMPUESTO'];
            $NOMBRE = $_POST['NOMBRE'];
            $FUNCION = $_POST['FUNCION'];
            $CONTROLADO = $_POST['CONTROLADO'];

            // Ejecutar consulta de inserción
            $query = "INSERT INTO Compuesto (ID_COMPUESTO, NOMBRE, FUNCION, CONTROLADO) 
            VALUES (?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("isss", $ID_COMPUESTO, $NOMBRE, $FUNCION, $CONTROLADO);

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
            $ID_COMPUESTO = $_POST['ID_COMPUESTO'];
            $NOMBRE = $_POST['NOMBRE'];
            $FUNCION = $_POST['FUNCION'];
            $CONTROLADO = $_POST['CONTROLADO'];

            $query = "UPDATE Compuesto 
            SET NOMBRE = ?, FUNCION = ?, CONTROLADO = ?
            WHERE ID_COMPUESTO = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("sssi", $NOMBRE, $FUNCION, $CONTROLADO, $ID_COMPUESTO);

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
            $ID_COMPUESTO = $_POST['ID_COMPUESTO'];
            $query = "DELETE FROM Compuesto WHERE ID_COMPUESTO = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("i", $ID_COMPUESTO);

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
            header('Location: Inicio.php');
            exit; // Finaliza el script para evitar más ejecución

        default:
            echo "Operación no válida.";
            break;
    }
}

$conexion->close();
?>
