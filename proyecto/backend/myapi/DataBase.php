<?php
namespace projtecweb\myapi;
require_once __DIR__ . '/../config.php';

abstract class DataBase {
    protected $conexion;
    protected $data;

    public function __construct() {
        $this->conexion = mysqli_connect(
            DB_HOST,
            DB_USER,
            DB_PASS,
            DB_NAME
        );
    
        if(!$this->conexion) {
            throw new \Exception('¡Base de datos NO conectada! ' . mysqli_connect_error());
        }
        $this->data = array();
    }

    public function getData(){
        return json_encode($this->data);
    }

    // ...existing code...
}
?>
