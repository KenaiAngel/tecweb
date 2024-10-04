<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Registro Completado</title>
		<style type="text/css">
			body {margin: 20px; 
			background-color: #C4DF9B;
			font-family: Verdana, Helvetica, sans-serif;
			font-size: 90%;}
			h1 {color: #005825;
			border-bottom: 1px solid #005825;}
			h2 {font-size: 1.2em;
			color: #4A0048;}
		</style>
	</head>
	<body>
		<h1>MUCHAS GRACIAS</h1>

		<?php

			global $msjerror, $msjexito;

			function impresionMsj ($msj){
				echo '<p><strong>'.$msj.'</strong></p>';
			}


			if ($_SERVER["REQUEST_METHOD"] == "POST") {

				$nombre = $marca = $modelo = $precio = $detalles = $unidades = $imagen = '';
				
				
				$error=false;

				//Verificar que las variables fueron llenadas

				if (isset($_POST['name']) && !empty($_POST['name'])) {
					$nombre = $_POST['name'];
				} else {
					$msjerror .= "Ingrese el campo (Nombre)<br>";
					
					$error=true;
					
				}

				if (isset($_POST['brand']) && !empty($_POST['brand'])) {
					$marca = $_POST['brand'];
				} else {
					$msjerror .= "Ingrese el campo (Marca)<br>";
					$error=true;
				}

				if (isset($_POST['model']) && !empty($_POST['model'])) {
					$modelo = $_POST['model'];
				} else {
					$msjerror .= "Ingrese el campo (Modelo)<br>";
					$error=true;
				}

				if (isset($_POST['price']) && !empty($_POST['price'])) {
					$precio = $_POST['price'];
				} else {
					$msjerror .= "Ingrese el campo (Precio)<br>";
					$error=true;
				}

				$detalles = $_POST['features'] ?? '';

				if (isset($_POST['units']) && !empty($_POST['units'])) {
					$unidades = $_POST['units'];
				} else {
					$msjerror .= "Ingrese el campo (Unidades)<br>";
					$error=true;
				}


				if (isset($_POST['img']) && !empty($_POST['img'])) {
					$imagen = $_POST['img'];
				} else {
					$msjerror .= "Ingrese el campo (img)<br>";
					$error=true;
				}
			
				if(!$error){

					//Generamos conexion
					@$link = new mysqli('localhost', 'root', 'sapo123', 'marketplace');	

					/** comprobar la conexión */
					if ($link->connect_errno) 
					{
						die('Falló la conexión: '.$link->connect_error.'<br/>');
						/** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
					}

					//Verificar que no existan los datos (nombre, marca y modelo)*********************************
					$sql = "SELECT nombre, marca, modelo FROM productos";
					$productos = $link->query($sql);


					//Esta función devuelve cada fila como un array asociativo, donde los nombres de las columnas son las claves del array.
					while ($fila = $productos->fetch_assoc()) {

						if($fila["nombre"]==$nombre){
							$msjerror .= "El producto $nombre ya esta registrado en la base de datos<br>";
							$error = true;
							break;
						}

						if($fila["marca"]==$marca){
							$msjerror .= "La $marca ya esta registrado en la base de datos<br>";
							$error = true;
							break;
						}

						
						if($fila["modelo"]==$modelo){
							$msjerror .= "El $modelo ya esta registrado en la base de datos<br>";
							$error = true;
							break;
						}
				
					}

					if(!$error){

						//INSERCION DE DATOS ************************************************************************
						unset($sql);
						$sql = 
						//"INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}',0)";
						"INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
						VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";


	
						if ( $link->query($sql) ) 
						{
							$msjexito = "Insercion completa: $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen";
							
						}
						else
						{
							$msjerror .= 'El Producto no pudo ser insertado =(<br>';
						}
					}

					$link->close();
				}

				if ($error) {
					impresionMsj($msjerror);
				} else {
					impresionMsj($msjexito);
				}
			}
		?>

		<p>
		    <a href="http://validator.w3.org/check?uri=referer"><img
		      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
		</p>
	</body>
</html>