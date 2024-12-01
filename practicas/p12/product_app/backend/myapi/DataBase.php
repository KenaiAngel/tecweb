<?php
    namespace TECWEB\MYAPI;

    abstract class DataBase{
        protected $conexion;
        protected $data;


        public function __construct($db, $user, $pass)
        {
            $this->conexion = @mysqli_connect(
                'localhost',
                $user,
                $pass,
                $db,
            );

            if(!$this->conexion) {
                die('¡Base de datos NO conextada!');
            }
        }
        public function getData(){
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
            $this->data=NULL;
            return $jsonData;//$jsonData;
        }
    }


?>