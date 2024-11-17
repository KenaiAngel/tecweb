<?php

    namespace TECWEB\MYAPI;
    use TECWEB\MYAPI\DataBase as DataBase;
    require_once __DIR__. '/DataBase.php';

    class Products extends DataBase {
        private $data;

        public function __construct($db, $user = 'root', $pass = 'sapo123'){
            //$this->conexion = new DataBase($user, $pass, $db);
            $this->data = array();
            parent::__construct($db, $user, $pass);
        }

        public function list(){
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);
        
                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }

        public function add($product){

            $this->data = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre y modelo'
            );
        
            // Ejecutar la consulta para verificar si el producto ya existe
            $productExists = $this->conexion->query("SELECT EXISTS(SELECT 1 FROM productos WHERE nombre = '$product->nombre' AND modelo='$product->modelo' AND eliminado = 0) AS existe");
        
            // Verificar si la consulta devuelve un resultado
            if ($productExists) {
                $row = $productExists->fetch_assoc();
                $exists = $row['existe']; // Esto será 1 si existe o 0 si no
        
                $this->conexion->set_charset("utf8");
        
                // Si el producto no existe, proceder con la inserción
                if (!$exists) {
                    // Preparar y ejecutar la consulta de inserción
                    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                            VALUES ('{$product->nombre}', '{$product->marca}', '{$product->modelo}', {$product->precio}, '{$product->detalles}', {$product->unidades}, '{$product->imagen}', 0)";
        
                    if ($this->conexion->query($sql)) {
                        $this->data['status'] = "success";
                        $this->data['message'] = "Producto agregado";
                    } else {
                        $this->data['message'] = "ERROR: No se ejecutó $sql. " . mysqli_error($this->conexion);
                    }
                } 
            }
        
            // Cerrar la conexión
            $this->conexion->close();
        

        }

        public function delete($product){
            $this->data = array(
                'status'  => 'error',
                'message' => 'La consulta falló'
            );

            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$product}";
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto eliminado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }

        public function search($product){
            $this->data = array();
            $sql = "SELECT * FROM productos WHERE (id = '{$product}' OR nombre LIKE '%{$product}%' OR marca LIKE '%{$product}%' OR detalles LIKE '%{$product}%') AND eliminado = 0";
            if ( $result = $this->conexion->query($sql) ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();

        }

        public function single($product)  {
            $this->data = array();
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE id = {$product}") ) {
                // SE OBTIENEN LOS RESULTADOS
                $row = $result->fetch_assoc();

                if(!is_null($row)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($row as $key => $value) {
                        $this->data[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }

        public function edit($jsonOBJ)
        {
            $this->data = array(
                'status' => 'error',
                'message' => 'La consulta falló'
            );
            
                $sql = "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}',";
                $sql .= "modelo='{$jsonOBJ->modelo}', precio={$jsonOBJ->precio}, detalles='{$jsonOBJ->detalles}',";
                $sql .= "unidades={$jsonOBJ->unidades}, imagen='{$jsonOBJ->imagen}' WHERE id={$jsonOBJ->id}";
                $this->conexion->set_charset("utf8");
                if ($this->conexion->query($sql)) {
                    $this->data['status'] = "success";
                    $this->data['message'] = "Producto actualizado";
                } else {
                    $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            
        }
        

        public function getData(){
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
            $this->data=NULL;
            return $jsonData;//$jsonData;
            
        }
    }
?>