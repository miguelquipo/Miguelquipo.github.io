<?php
// archivo: obtener_productos.php
include 'db.php';

$sql_select = "SELECT * FROM productos";
$result = $conn->query($sql_select);

$productos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($productos);
$conn->close();
?>