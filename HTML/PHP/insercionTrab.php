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
if (isset($_POST['cargo'])) {
    $cargo = $_POST['cargo'];
} else {
    $cargo ='';
}

// Insertar datos en la base de datos
$sql = "INSERT INTO trabajadores (nombre, apellido, cedula, cargo) VALUES ('$nombre', '$apellido', '$cedula', '$cargo')";

if ($conn->query($sql) === TRUE) {
    header("Location: "); // Redirige al archivo home.html si la inserción es exitosa
    exit();
} else {
    header("Location: index.php"); // Redirige al archivo login.php si hay un error en la inserción
    exit();
}
// Cerrar conexión
$conn->close();


?>