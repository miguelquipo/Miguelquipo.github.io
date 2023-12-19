<?php
include 'db.php'; // Incluir el archivo de conexión a la base de datos

if (isset($_POST['product-name'])) {
    $productName = $_POST['product-name'];

    // Validar y limpiar los datos (usar consultas preparadas es más seguro)
    $productName = $conn->real_escape_string($productName); // Usando real_escape_string para prevenir inyección SQL
    // Realizar validaciones adicionales si es necesario

    // Sentencia preparada para la inserción
    $stmt = $conn->prepare("INSERT INTO productos (nombre_producto) VALUES (?)");
    $stmt->bind_param("s", $productName);
// Tipos de datos ('ss' significa dos strings)

    if ($stmt->execute()) {
        echo 'Se a ingresado correctamente';
        header("Location: ../ingProductos1.html"); // Redirigir con mensaje de éxito
        exit();
    } else {
        echo 'Hubo un error al subir el Producto';
        header("Location: ../index.html" . urlencode($conn->error)); // Redirigir con mensaje de error
        exit();
    }

    $stmt->close(); // Cerrar la sentencia preparada
}

$conn->close(); // Cerrar la conexión a la base de datos
?>

