<?php
// Conectar a la base de datos
$link = mysqli_connect("localhost", "root", "sapo123", "marketplace");

// Verificar la conexión
if (!$link) {
    die("ERROR: No se pudo conectar a la base de datos. " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $name = $_POST['name']; 
    $brand = $_POST['brand'];
    $model = $_POST['model']; 
    $price = $_POST['price']; 
    $features = $_POST['features']; 
    $units = $_POST['units']; 
    $image = empty($_POST['img']) ? 'img/cat.png' : $_POST['img'];
    $status = $_POST['status'] == 'Activo' ? 0 : 1;


    // Crear la consulta para actualizar
    $sql = "UPDATE productos SET 
                nombre='$name', 
                marca='$brand', 
                modelo='$model', 
                precio='$price', 
                detalles='$features', 
                unidades='$units', 
                imagen='$image', 
                eliminado='$status' 
            WHERE id='$id'";

    
    if (mysqli_query($link, $sql)) {
        echo "Registro actualizado con éxito.";
        echo '<br><button onclick="window.location.href=\'http://localhost/tecweb/practicas/p09/get_productos_xhtml_v2.php?tope=100000\'">Ver Todos Los Productos</button>';
        echo '<br><button onclick="window.location.href=\'http://localhost/tecweb/practicas/p09/get_productos_vigentes_v2.php?tope=100000\'">Ver Productos Vigentes</button>';
    } else {
        echo '<br><button onclick="window.location.href=\'http://localhost/tecweb/practicas/p09/formulario_v2.php?tope=100000\'">Regresar</button>';
        echo "ERROR: No se pudo actualizar el registro. " . mysqli_error($link);
    }
}


mysqli_close($link);
?>
