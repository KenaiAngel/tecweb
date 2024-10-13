<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<?php
    //header("Content-Type: application/json; charset=utf-8"); 
    $data = array();

	if(isset($_GET['tope']))
    {
		$tope = $_GET['tope'];
    }
    else
    {
        die('Parámetro "tope" no detectado...');
    }

	if (!empty($tope))
	{
		/** SE CREA EL OBJETO DE CONEXION */
		@$link = new mysqli('localhost', 'root', 'sapo123', 'marketplace');
        /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */

		/** comprobar la conexión */
		if ($link->connect_errno) 
		{
			die('Falló la conexión: '.$link->connect_error.'<br/>');
			//exit();
		}

		/** Crear una tabla que no devuelve un conjunto de resultados */
		if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope AND eliminado =0") ) 
		{
            /** Se extraen las tuplas obtenidas de la consulta */
			$row = $result->fetch_all(MYSQLI_ASSOC);

            /** Se crea un arreglo con la estructura deseada */
            foreach($row as $num => $registro) {            // Se recorren tuplas
                foreach($registro as $key => $value) {      // Se recorren campos
                    $data[$num][$key] = utf8_encode($value);
                }
            }

			/** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free();
		}

		$link->close();

        /** Se devuelven los datos en formato JSON */
        //echo json_encode($data, JSON_PRETTY_PRINT);
	}
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Producto</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
			img{
				height: 200px;
				width: 200px;
                object-fit:contain;
			}
		</style>
	</head>
	<body>
		<h3>PRODUCTO</h3>

		<br/>
		
		<?php if( isset($row) ) : ?>
			<table class="table">
				<thead class="thead-dark">
					<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre</th>
					<th scope="col">Marca</th>
					<th scope="col">Modelo</th>
					<th scope="col">Precio</th>
					<th scope="col">Unidades</th>
					<th scope="col">Detalles</th>
					<th scope="col">Imagen</th>
                    <th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($row as $value) : ?>
                        <tr id=<?=$value['id'] ?>>
                            <th scope="row" class="row-data"  ><?= $value['id'] ?></th>
                            <td class="row-data"><?= $value['nombre'] ?></td>
                            <td class="row-data"><?= $value['marca'] ?></td>
                            <td class="row-data"><?= $value['modelo'] ?></td>
                            <td class="row-data"><?= $value['precio'] ?></td>
                            <td class="row-data"><?= $value['unidades'] ?></td>
                            <td class="row-data"><?= $value['detalles'] ?></td>
                            <td class="row-data"><img src=<?= $value['imagen'] ?> alt=<?= $value['imagen'] ?>></td>
                           
                            <td><button  onclick="goToFormulario()" >Modificar</button></td>
                        </tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php elseif(!empty($id)) : ?>

            <script>
            alert('El ID del producto no existe');
            </script>

		<?php endif; ?>

        <script>

			function send2form(id, name,brand, model,price,units,features,image,status) {     //form) { 
                alert(
					"ID: " + id + "\n" +
					"Nombre: " + name + "\n" +
					"Marca: " + brand + "\n" +
					"Modelo: " + model + "\n" +
					"Precio: " + price + "\n" +
					"Unidades: " + units + "\n" +
					"Características: " + features + "\n" +
					"Imagen: " + image + "\n" +
					"Estado: " + status
				);
				let urlForm = "http://localhost/tecweb/practicas/p09/formulario_v2.php";
               
                window.open(urlForm+"?id="+id+"&name="+name+"&brand="+brand+"&model="+model+"&price="+price
				+"&units="+units+"&features="+features+"&image="+image+"&status="+status);
            }

			function goToFormulario() {
				// se obtiene el id de la fila donde está el botón presinado
				let rowId = event.target.parentNode.parentNode.id;

				// se obtienen los datos de la fila en forma de arreglo
				let data = document.getElementById(rowId).querySelectorAll(".row-data");
				/**
				querySelectorAll() devuelve una lista de elementos (NodeList) que 
				coinciden con el grupo de selectores CSS indicados.
				(ver: https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_Selectors)

				En este caso se obtienen todos los datos de la fila con el id encontrado
				y que pertenecen a la clase "row-data".
				*/

				let id = data[0].innerHTML;
				let name = data[1].innerHTML;	
				let brand = data[2].innerHTML;
				let model = data[3].innerHTML;
				let price = data[4].innerHTML;
				let units = data[5].innerHTML;
				let features = data[6].innerHTML;
				let image = data[7].querySelector('img').alt;
				let status = "Activo";
				



				
				send2form(id, name,brand, model,price,units,features,image,status);
			}

		</script>	
	</body>
</html>