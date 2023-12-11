<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $nombre_producto = $_POST['product-name'];
    $id_tipo = $_POST['product-type'];
    $codigo_prod = $_POST['qr-code'];
    $creacionfecha = $_POST['fecha-creacion'];

    // Obtener el último id_trabajador
    $sql_last_id = "SELECT MAX(id_trabajador) as max_id FROM trabajadores";
    $result = $conn->query($sql_last_id);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_id = $row["max_id"];
    
        // Incrementar el último ID para obtener el nuevo ID del trabajador
        $new_trabajador = $last_id + 1;
    } else {
        // Si no hay ningún registro, asignar el valor inicial para el nuevo ID del trabajador
        $new_trabajador = 1;
    }
    
    // Preparar la consulta para insertar los datos en la tabla de productos
    $sql = "INSERT INTO productos (nombre_producto, codigo_prod, creacionfecha, id_tipo, id_trabajador) VALUES ('$nombre_producto', '$codigo_prod', '$creacionfecha', $id_tipo, $new_trabajador)";
    
    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado exitosamente";
    } else {
        echo "Error al agregar el producto: " . $conn->error;
    }
    
    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    echo "No se recibieron datos del formulario";
}
?>
