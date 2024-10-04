<?php


 if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre;
    $marca;
    $modelo;
    $precio;
    $detalles;
    $unidades;
    $imagen;


    $msjerror;
    $msjexito;
    $error=false;

    //
    do{

        //Verificar que las variables fueron llenadas

        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $nombre = $_POST['name'];
        } else {
            $msjerror = "Ingrese el campo (Nombre)";
            $error=true;
            
        }

        if (isset($_POST['brand']) && !empty($_POST['brand'])) {
            $marca = $_POST['brand'];
        } else {
            $msjerror = "Ingrese el campo (Marca)";
            $error=true;
        }

        if (isset($_POST['model']) && !empty($_POST['model'])) {
            $modelo = $_POST['model'];
        } else {
            $msjerror = "Ingrese el campo (Modelo)";
            $error=true;
        }

        if (isset($_POST['price']) && !empty($_POST['price'])) {
            $precio = $_POST['price'];
        } else {
            $msjerror = "Ingrese el campo (Precio)";
            $error=true;
        }

        $detalles = $_POST['features'] ?? '';

        if (isset($_POST['units']) && !empty($_POST['units'])) {
            $unidades = $_POST['units'];
        } else {
            $msjerror = "Ingrese el campo (Unidades)";
            $error=true;
        }


        if (isset($_POST['img']) && !empty($_POST['img'])) {
            $img = $_POST['img'];
        } else {
            $msjerror = "Ingrese el campo (img)";
            $error=true;
        }
    

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
                $msjerror = "El producto $nombre ya esta registrado en la base de datos";
                $error = true;
                $link->close();
                break;
            }

            if($fila["marca"]==$marca){
                $msjerror = "La $marca ya esta registrado en la base de datos";
                $error = true;
                $link->close();
                break;
            }

            
            if($fila["modelo"]==$modelo){
                $msjerror = "El $modelo ya esta registrado en la base de datos";
                $link->close();
                $error = true;
                break;
            }
     
        }

        //INSERCION DE DATOS ************************************************************************
        unset($sql);
        $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

        if ( $link->query($sql) ) 
        {
            $msjexito = "Insercion completa: $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen";
            
        }
        else
        {
            $msjerror = 'El Producto no pudo ser insertado =(';
            $link->close();
            $error = true;
        }


        $link->close();



    }while(!$error);
}
    




?>