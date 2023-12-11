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
            $id_pedido = $_POST['id_pedido'];
            $id_producto = $_POST['id_producto'];
            $id_proveedor = $_POST['id_proveedor'];
            $Id_emp = $_POST['Id_emp'];
            $cantidad_productos = $_POST['cantidad_productos'];
            $fecha = date('Y-m-d', strtotime($_POST['fecha']));
            $precio_unitario_compra = $_POST['precio_unitario_compra'];
            $precio_unitario_venta = $_POST['precio_unitario_venta'];
            $Costo_total = $_POST['Costo_total'];

            // Ejecutar consulta de inserción
            $query = "INSERT INTO Pedido_F (id_pedido, id_producto, id_proveedor, Id_emp, cantidad_productos, fecha, precio_unitario_compra, precio_unitario_venta, Costo_total) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("iiiiisddd", $id_pedido, $id_producto, $id_proveedor, $Id_emp, $cantidad_productos, $fecha, $precio_unitario_compra, $precio_unitario_venta, $Costo_total);

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
            $id_pedido = $_POST['id_pedido'];
            $id_producto = $_POST['id_producto'];
            $id_proveedor = $_POST['id_proveedor'];
            $Id_emp = $_POST['Id_emp'];
            $cantidad_productos = $_POST['cantidad_productos'];
            $fecha = date('Y-m-d', strtotime($_POST['fecha']));
            $precio_unitario_compra = $_POST['precio_unitario_compra'];
            $precio_unitario_venta = $_POST['precio_unitario_venta'];
            $Costo_total = $_POST['Costo_total'];

            $query = "UPDATE Pedido_F 
            SET id_producto = ?, id_proveedor = ?, Id_emp = ?, cantidad_productos = ?, fecha = ?, precio_unitario_compra = ?, precio_unitario_venta = ?, Costo_total = ?
            WHERE id_pedido = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("iiiiisddi", $id_producto, $id_proveedor, $Id_emp, $cantidad_productos, $fecha, $precio_unitario_compra, $precio_unitario_venta, $Costo_total, $id_pedido);

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
            $id_pedido = $_POST['id_pedido'];
            $query = "DELETE FROM Pedido_F WHERE id_pedido = ?";

            $stmt = $conexion->prepare($query);
            $stmt->bind_param("i", $id_pedido);

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
