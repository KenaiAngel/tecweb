<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status' =>  "nf",
        'message' => 'NO EXISTE ningun producto con ese nombre'
    );
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['name']) ) {
        $search = $_GET['name'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE nombre = '{$search}' AND eliminado = 0";

        if ($result = $conexion->query($sql)) {
            // Verificar si se encontraron filas
            if ($result->num_rows > 0) {
                $data['status'] =  "f";
                $data['message'] = "EXISTE un producto con ese nombre";
            } else {
                $data['status'] =  "nf";
                $data['message'] = "NO existe ningún producto con ese nombre";
            }
        
            // Liberar memoria del resultado
            $result->free();
        } else {
            // Manejar errores de consulta
            die('Query Error: ' . $conexion->error);
        }
        
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>