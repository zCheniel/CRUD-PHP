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

// Recibir ID del usuario a eliminar
$id = $_POST['id'];

// Eliminar usuario de la base de datos
$sql = "DELETE FROM usuarios WHERE id = $id";
if ($mysqli->query($sql)) {
    echo "Usuario eliminado exitosamente.";
} else {
    echo "Error al eliminar el usuario: " . $mysqli->error;
}

// Cerrar conexión a la base de datos
$mysqli->close();
?>
