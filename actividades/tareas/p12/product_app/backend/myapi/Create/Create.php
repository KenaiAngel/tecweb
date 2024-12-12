<?php
    namespace TECWEB\MYAPI\Create;
    use TECWEB\MYAPI\DataBase;


    class Create extends DataBase {


        public function __construct($db, $user = 'root', $pass = 'sapo123'){
            //$this->conexion = new DataBase($user, $pass, $db);
            
            parent::__construct($db, $user, $pass);
            $this->data = array();
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

    }

    
?>