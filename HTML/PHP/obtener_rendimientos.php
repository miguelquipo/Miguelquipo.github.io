<?php
// Incluir tu archivo de conexión a la base de datos
include 'db.php';

// Realizar la consulta SQL para obtener los datos
$sql = "SELECT rendimiento.id_rendimiento, rendimiento.cantidad_vendida, productos.nombre_producto, trabajadores.nombre AS nombre_trabajador, rendimiento.fecha_registro, rendimiento.hora_registro
        FROM rendimiento
        INNER JOIN productos ON rendimiento.id_producto = productos.id_producto
        INNER JOIN trabajadores ON rendimiento.id_trabajador = trabajadores.id_trabajador";

$result = $conn->query($sql);

$rendimientos = [];

if ($result->num_rows > 0) {
    // Guardar los datos en un array asociativo
    while ($row = $result->fetch_assoc()) {
        $rendimientos[] = $row;
    }
}

// Cerrar la conexión
$conn->close();

// Establecer el encabezado para indicar que la respuesta es JSON
header('Content-Type: application/json');

// Imprimir los datos en formato JSON
echo json_encode($rendimientos);
?>
