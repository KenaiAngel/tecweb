<?php

    namespace TECWEB\MYAPI\Update;
    use TECWEB\MYAPI\DataBase;
    class Update extends DataBase {


        public function __construct($db, $user = 'root', $pass = 'sapo123'){
            //$this->conexion = new DataBase($user, $pass, $db);
            
            parent::__construct($db, $user, $pass);
            $this->data = array();
        }

        public function edit($jsonOBJ){

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

    }

    
?>