<?php
$nombre = 'Blazer';
$marca  = 'Nike';
$modelo = 'Blazer Mid77 Vintage';
$precio = 2000.0;
$detalles = 'Nike,Blazer Mid77 Vintage, tallas (25 cm - 29 cm)';
$unidades = 18;
$imagen   = 'img/blazer.png';

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'sapo123', 'marketplace');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

/** Crear una tabla que no devuelve un conjunto de resultados */
$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
if ( $link->query($sql) ) 
{
    echo 'Producto insertado con ID: '.$link->insert_id;
}
else
{
	echo 'El Producto no pudo ser insertado =(';
}

$link->close();
?>