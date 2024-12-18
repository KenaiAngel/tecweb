<?php
require_once __DIR__ . '/config.php';

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Datos de prueba para insertar
$username = 'testuser';
$password = password_hash('testpassword', PASSWORD_DEFAULT);
$ubicacion = 'testlocation';

// Preparar y ejecutar la sentencia SQL
$stmt = mysqli_prepare($conexion, "INSERT INTO users (username, password, ubicacion) VALUES (?, ?, ?)");
mysqli_stmt_bind_param($stmt, 'sss', $username, $password, $ubicacion);

if (mysqli_stmt_execute($stmt)) {
    echo 'Usuario insertado exitosamente.';
} else {
    echo 'Error al insertar usuario: ' . mysqli_stmt_error($stmt);
}

// Cerrar la sentencia y la conexión
mysqli_stmt_close($stmt);
mysqli_close($conexion);
?>

