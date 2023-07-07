<?php
// Configuración de la base de datos
$host = 'localhost';
$db = 'nombre_de_la_base_de_datos';
$user = 'usuario_de_la_base_de_datos';
$password = 'contraseña_de_la_base_de_datos';

// Conexión a la base de datos
$mysqli = new mysqli($host, $user, $password, $db);
if ($mysqli->connect_errno) {
    die('Error en la conexión a la base de datos: ' . $mysqli->connect_error);
}

// Recibir datos del formulario
$name = $_POST['name'];
$email = $_POST['email'];

// Insertar usuario en la base de datos
$sql = "INSERT INTO usuarios (nombre, email) VALUES ('$name', '$email')";
if ($mysqli->query($sql)) {
    echo "Usuario agregadoexitosamente.";
} else {
    echo "Error al agregar el usuario: " . $mysqli->error;
}

// Cerrar conexión a la base de datos
$mysqli->close();
?>
