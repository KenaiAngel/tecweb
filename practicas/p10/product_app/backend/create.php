<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        /**
         * SUSTITUYE LA SIGUIENTE LÍNEA POR EL CÓDIGO QUE REALICE
         * LA INSERCIÓN A LA BASE DE DATOS. COMO RESPUESTA REGRESA
         * UN MENSAJE DE ÉXITO O DE ERROR, SEGÚN SEA EL CASO.
         */
        $nombre = $jsonOBJ->nombre;
        $marca = $jsonOBJ->marca; 
        $modelo = $jsonOBJ->modelo;
        $precio = $jsonOBJ->precio;
        $detalles = $jsonOBJ->detalles;
        $unidades = $jsonOBJ->unidades;
        $imagen = $jsonOBJ->imagen;

        $mensaje = "";
        //Generamos conexion
        @$link = new mysqli('localhost', 'root', 'sapo123', 'marketplace');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
            /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
        }

        //Verificar que no existan los datos (nombre, marca y modelo)*********************************
        $sql = "SELECT nombre, eliminado FROM productos 
            WHERE nombre = '{$nombre}'
            AND eliminado = '0'"
        ;
        $productos = $link->query($sql);


        if ($productos->num_rows > 0) {
            $mensaje .= "El Producto '{$nombre}' ya existe";
        } else {
            unset($sql);
            $sql = 
            //"INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}',0)";
            "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
            VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";



            if ( $link->query($sql) ) 
            {
                unset($mensaje);
                $mensaje = "Insercion completa: $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen";
                
            }
            else
            {
                $mensaje .= 'El Producto no pudo ser insertado =(<';
            }
        }
        

        $link->close();

        echo json_encode($mensaje, JSON_PRETTY_PRINT);
       
    }
?>
