<?php
    namespace projtecweb\myapi\Product;

    use projtecweb\myapi\DataBase;

    class Product extends DataBase {
    public function __construct() {
        parent::__construct();
    }

    public function listProduct() {
        $this->data = array();
        $sql = "SELECT * FROM vista_usuarios_productos WHERE producto_categoria ORDER BY RAND() LIMIT 20";
        $stmt = $this->conexion->prepare($sql);
        if ($stmt) {
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
    
                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        if ($key === 'product_imagen') {
                            // Usar mime_type para determinar el prefijo adecuado
                            $mimeType = $row['mime_type'];
                            $this->data[$num][$key] = "data:$mimeType;base64," . base64_encode($value);
                        } else {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
                }
            } else {
                $this->data = []; // No hay resultados
            }
    
            $result->free();
            $stmt->close();
        } else {
            die('Query Preparation Error: ' . $this->conexion->error);
        }
    
        $this->conexion->close();
    }
    


    public function searchAndList($search) {
        $this->data = array();
        $sql = "SELECT * FROM vista_usuarios_productos WHERE producto_nombre LIKE ? AND producto_estado = 1 AND producto_cantidad > 0";

        // Preparar la consulta
        $stmt = $this->conexion->prepare($sql);

        if ($stmt) {
            // Escapar y enlazar el término de búsqueda
            $searchTerm = "%{$search}%";
            $stmt->bind_param('s', $searchTerm);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        if ($key === 'imagen') {
                            // Usar mime_type para determinar el prefijo adecuado
                            $mimeType = $row['mime_type'];
                            $this->data[$num][$key] = "data:$mimeType;base64," . base64_encode($value);
                        } else {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
                }
            } else {
                // No se encontraron resultados
                $this->data = [];
            }

            // Liberar recursos
            $result->free();
            $stmt->close();
        } else {
            die('Query Preparation Error: ' . $this->conexion->error);
        }

        $this->conexion->close();
    }

    public function searchAndListCa($search) {
        $this->data = array();
        $sql = "SELECT * FROM vista_usuarios_productos WHERE producto_categoria = ?  AND producto_cantidad > 0";

        // Preparar la consulta
        $stmt = $this->conexion->prepare($sql);

        if ($stmt) {
            // Escapar y enlazar el término de búsqueda
            $searchTerm = "{$search}";
            $stmt->bind_param('s', $searchTerm);

            // Ejecutar la consulta
            $stmt->execute();

            // Obtener los resultados
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($rows as $num => $row) {
                    foreach ($row as $key => $value) {
                        if ($key === 'imagen') {
                            // Usar mime_type para determinar el prefijo adecuado
                            $mimeType = $row['mime_type'];
                            $this->data[$num][$key] = "data:$mimeType;base64," . base64_encode($value);
                        } else {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
                }
            } else {
                // No se encontraron resultados
                $this->data = [];
            }

            // Liberar recursos
            $result->free();
            $stmt->close();
        } else {
            die('Query Preparation Error: ' . $this->conexion->error);
        }

        $this->conexion->close();
    }

    public function getData() {
        return json_encode($this->data);
    }
    }
   
?>