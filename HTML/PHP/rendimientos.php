<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
// Realiza la conexión a la base de datos (cambia estos valores por los tuyos)
include 'db.php';

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search-cedula']) && isset($_POST['search-producto'])){// Obtén los valores de los campos del formulario
    $cedula = $_POST['search-cedula'];
    $codigoProducto = $_POST['search-producto'];


     // Función para buscar el ID del trabajador por la cédula
     function buscarIdTrabajadorPorCedula($conn, $cedula) {
        $sql = "SELECT id_trabajador FROM trabajadores WHERE cedula = ?";
        $stmt = $conn->prepare($sql);
    
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            $stmt->bind_param("s", $cedula); // "s" indica que $cedula es de tipo string
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['id_trabajador'];
            }
        }
        return null;
    }
    // Función para buscar el ID del producto por el código
    function buscarIdProductoPorCodigo($conn, $codigoProducto) {
        $sql = "SELECT id_producto FROM productos WHERE codigoProducto = ?";
        $stmt = $conn->prepare($sql);
    
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt) {
            $stmt->bind_param("s", $codigoProducto); // "s" indica que $codigoProducto es de tipo string
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                return $row['id_producto'];
            }
        }
        return null;
    }
    
    // Funciones para buscar los IDs correspondientes (simuladas)
    $idTrabajador = buscarIdTrabajadorPorCedula($cedula);
    $idProducto = buscarIdProductoPorCodigo($codigoProducto);
    

    // Verifica si ya existe un registro para ese trabajador y producto en la tabla rendimiento
    $sql_check = "SELECT * FROM rendimiento WHERE id_trabajador = $idTrabajador AND id_producto = $idProducto";
    $result = $conn->query($sql_check);

    if ($result && $result->num_rows > 0) {
        // Si ya existe un registro, incrementa la cantidad vendida
        $sql_update = "UPDATE rendimiento SET cantidad_vendida = cantidad_vendida + 1 WHERE id_trabajador = $idTrabajador AND id_producto = $idProducto";

        if ($conn->query($sql_update) === TRUE) {
            header("Location: ../rendimeintos.html"); // Redirige a iingProductos.html si la inserción es exitosa
            exit();
            // Puedes redirigir o realizar otras acciones después de la actualización
        } else {
            echo "Error al actualizar cantidad vendida: " , $conn->error;
        }
    } else {
        // Si no existe, realiza la inserción de un nuevo registro
        $fechaRegistro = date("Y-m-d");
        $horaRegistro = date("H:i:s");

        $sql_insert = "INSERT INTO rendimiento (cantidad_vendida, fecha_registro, id_producto, id_trabajador, hora_registro) VALUES (1, '$fechaRegistro', $idProducto, $idTrabajador, '$horaRegistro')";

        if ($conn->query($sql_insert) === TRUE) {
           header("Location: ../rendimeintos.html"); // Redirige a iingProductos.html si la inserción es exitosa
            exit();
            // Puedes redirigir o realizar otras acciones después de la inserción
        } else {
            echo "Error al insertar datos: " , $conn->error;
        }
    }
}

$conn->close();
// Resto del código de búsqueda y cierre de conexión...
?>
