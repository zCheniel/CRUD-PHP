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

// Obtener usuarios de la base de datos
$sql = "SELECT * FROM usuarios";
$result = $mysqli->query($sql);

// Generar tabla con los usuarios
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td><button class='delete-btn' data-id='" . $row['id'] . "'>Eliminar</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No se encontraron usuarios.</td></tr>";
}

// Cerrar conexión a la base de datos
$mysqli->close();
?>
