<?php
   namespace projtecweb\myapi\Product;

   use projtecweb\myapi\DataBase;
   
   class Product extends DataBase {
   
       public function __construct() {
           parent::__construct();
       }
   
       public function searchAndList($search) {
           $this->data = array();
           $sql = "SELECT * FROM vista_usuarios_productos WHERE producto_nombre LIKE ? AND producto_estado = 0 AND producto_cantidad > 0";
   
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
                           $this->data[$num][$key] = utf8_encode($value);
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