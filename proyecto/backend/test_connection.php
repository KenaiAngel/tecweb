<?php
require_once __DIR__ . '/config.php';

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conexion) {
    echo '¡Conexión exitosa a la base de datos!';
} else {
    die('Error de conexión: ' . mysqli_connect_error());
}
?>
