<?php
// Realiza la conexión a la base de datos (cambia estos valores por los tuyos)
include 'db.php';
var_dump($_POST);

// Verifica si se ha enviado una solicitud POST y si los campos del formulario están definidos
if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search-cedula']) && isset($_POST['search-producto'])) {
    // Obtén los valores de los campos del formulario
    $cedula = $_POST['search-cedula'];
    $codigoProducto = $_POST['search-producto'];

    // Función para buscar el ID del trabajador por la cédula (utilizando consulta preparada para evitar inyección SQL)
    $stmtTrabajador = $conn->prepare("SELECT id_trabajador FROM trabajadores WHERE cedula = ?");
    $stmtTrabajador->bind_param("s", $cedula);
    $stmtTrabajador->execute();
    $resultTrabajador = $stmtTrabajador->get_result();

    if ($resultTrabajador->num_rows > 0) {
        $rowTrabajador = $resultTrabajador->fetch_assoc();
        $idTrabajador = $rowTrabajador['id_trabajador'];
    } else {
        // Manejar el caso en el que el trabajador no exista en la base de datos
        header("Location: ../error.html");
        exit();
    }

    // Función para buscar el ID del producto por el código (utilizando consulta preparada)
    $stmtProducto = $conn->prepare("SELECT id_producto FROM productos WHERE id_producto = ?");
    $stmtProducto->bind_param("s", $codigoProducto);
    $stmtProducto->execute();
    $resultProducto = $stmtProducto->get_result();

    if ($resultProducto->num_rows > 0) {
        $rowProducto = $resultProducto->fetch_assoc();
        $idProducto = $rowProducto['id_producto'];
    } else {
        // Manejar el caso en el que el producto no exista en la base de datos
        header("Location: ../error.html");
        exit();
    }

    // Verificar si ya existe un registro para ese trabajador y producto en la tabla rendimiento
    $stmtCheck = $conn->prepare("SELECT * FROM rendimiento WHERE id_trabajador = ? AND id_producto = ?");
    $stmtCheck->bind_param("ss", $idTrabajador, $idProducto);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        // Si ya existe un registro, incrementa la cantidad vendida
        $stmtUpdate = $conn->prepare("UPDATE rendimiento SET cantidad_vendida = cantidad_vendida + 1 WHERE id_trabajador = ? AND id_producto = ?");
        $stmtUpdate->bind_param("ss", $idTrabajador, $idProducto);

        if ($stmtUpdate->execute()) {
            header("Location: ../rendimientos.html"); // Redirige a rendimeintos.html si la actualización es exitosa
            exit();
        } else {
            echo "Error al actualizar cantidad vendida: " , $conn->error;
        }
    } else {
        // Si no existe, realiza la inserción de un nuevo registro
        $fechaRegistro = date("Y-m-d");
        $horaRegistro = date("H:i:s");

        $stmtInsert = $conn->prepare("INSERT INTO rendimiento (cantidad_vendida, fecha_registro, id_producto, id_trabajador, hora_registro) VALUES (?, ?, ?, ?, ?)");
        $cantidadVendida = 1;
        $stmtInsert->bind_param("issss", $cantidadVendida, $fechaRegistro, $idProducto, $idTrabajador, $horaRegistro);

        if ($stmtInsert->execute()) {
            header("Location: ../rendimientos.html"); // Redirige a rendimeintos.html si la inserción es exitosa
            exit();
        } else {
            echo "Error al insertar datos: " , $conn->error;
        }
    }
}

// Cerrar conexión
$conn->close();
?>
