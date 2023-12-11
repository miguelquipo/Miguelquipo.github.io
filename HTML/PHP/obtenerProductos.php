<?php
// Incluir la conexión a la base de datos
include 'db.php';

// Consulta para obtener los productos
$sql = "SELECT nombre_producto, nombre_tipo AS tipo_producto, codigo_prod AS codigoQR, creacionfecha AS fecha_ingreso FROM productos INNER JOIN tipos_producto ON productos.id_tipo = tipos_producto.id_tipo";

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $productos = [];

    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }

    // Devolver los datos en formato JSON
    echo json_encode($productos);
} else {
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
