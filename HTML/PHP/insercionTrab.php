<?php
include 'db.php';

// Capturar datos del formulario
if (isset($_POST['nombre'])) {
    $nombre = $_POST['nombre'];
} else {
    $nombre ='';
}
if (isset($_POST['apellido'])) {
    $apellido = $_POST['apellido'];
} else {
    $apellido ='';
}
if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];
} else {
    $cedula ='';
}

// Insertar datos en la base de datos
$sql = "INSERT INTO trabajadores (nombre, apellido, cedula) VALUES ('$nombre', '$apellido', '$cedula')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../ingPersonal.html"); // Redirige a iingProductos.html si la inserción es exitosa
    exit();
} else {
    header("Location: ../index.html"); // Redirige a index.html si hay un error en la inserción
    exit();
}

// Cerrar conexión
$conn->close();
?>