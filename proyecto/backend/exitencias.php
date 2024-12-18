<?php
use projtecweb\myapi\Validaciones\Validaciones;
require_once __DIR__ . '/vendor/autoload.php';
$log = new Validaciones();
$response = $log->exitencias();
        echo json_encode($response);
/*$datosCategoria = ["Bebida", "Dulceria", "Postres", "Comida Preparada"];
$cantidad= [];
for($i = 0; $i<4; $i++){
    $cantidad[] = 1;//¿$log->query("SELECT SUM(cantidad) FROM productos WHERE categoria = "+datosCategoria[$i]+";");
}
$cantidad[] = 0;
$respuesta = [
    "categoria" => $datosCategoria,
    "datos" => $cantidad,
];
echo json_encode($respuesta);*/

?>