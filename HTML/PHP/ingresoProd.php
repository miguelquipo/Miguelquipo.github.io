<?php
include 'db.php';

if (isset($_POST['product-name']) && isset($_POST['fecha-creacion'])) {
    $nombre_producto = $_POST['product-name'];
    $creacion_fecha = $_POST['fecha-creacion'];

    // Sentencia preparada para la inserción
    $sql = "INSERT INTO productos (nombre_producto, creacion_fecha) VALUES ('$nombre_producto',NOW())";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../ingProductos.html"); // Redirige a iingProductos.html si la inserción es exitosa
        exit();
    } else {
        header("Location: ../index.html"); // Redirige a index.html si hay un error en la inserción
        exit();
    }
}

$conn->close();
?>
