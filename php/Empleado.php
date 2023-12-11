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
        case 'alta':
            // Realizar operación de alta en la base de datos
            $Id_emp = $_POST['Id_emp'];
            $nombre_Emp = $_POST['nombre_Emp'];
            $ap_P_Emp = $_POST['ap_P_Emp'];
            $ap_M_Emp = $_POST['ap_M_Emp'];
            $puesto = $_POST['puesto'];
            $Horario = $_POST['Horario'];
            $fecha_nac = date('Y-m-d', strtotime($_POST['fecha_nac'])); // Ajustar el formato de la fecha
            $salario_mensual = $_POST['salario_mensual'];

            // Ejecutar consulta de inserción
            $query = "INSERT INTO Empleado_F (Id_emp, nombre_Emp, ap_P_Emp, ap_M_Emp, puesto, Horario, fecha_nac, salario_mensual) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("issssssd", $Id_emp, $nombre_Emp, $ap_P_Emp, $ap_M_Emp, $puesto, $Horario, $fecha_nac, $salario_mensual);

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
            $Id_emp = $_POST['Id_emp'];
            $nombre_Emp = $_POST['nombre_Emp'];
            $ap_P_Emp = $_POST['ap_P_Emp'];
            $ap_M_Emp = $_POST['ap_M_Emp'];
            $puesto = $_POST['puesto'];
            $Horario = $_POST['Horario'];
            $fecha_nac = date('Y-m-d', strtotime($_POST['fecha_nac'])); // Ajustar el formato de la fecha
            $salario_mensual = $_POST['salario_mensual'];

            $query = "UPDATE Empleado_F 
                      SET nombre_Emp = ?, ap_P_Emp = ?, ap_M_Emp = ?, puesto = ?, 
                          Horario = ?, fecha_nac = ?, salario_mensual = ?
                      WHERE Id_emp = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("ssssssdi", $nombre_Emp, $ap_P_Emp, $ap_M_Emp, $puesto, $Horario, $fecha_nac, $salario_mensual, $Id_emp);

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
            $Id_emp = $_POST['Id_emp'];
            $query = "DELETE FROM Empleado_F WHERE Id_emp = ?";
            $stmt = $conexion->prepare($query);
            $stmt->bind_param("i", $Id_emp);

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
            exit; // Finaliza el script para evitar más ejecución

        default:
            echo "Operación no válida.";
            break;
    }
}

$conexion->close();
?>
