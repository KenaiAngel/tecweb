<?php

    namespace TECWEB\MYAPI\Delete;
    use TECWEB\MYAPI\DataBase;

    class Delete extends DataBase {


        public function __construct($db, $user = 'root', $pass = 'sapo123'){
            //$this->conexion = new DataBase($user, $pass, $db);
            
            parent::__construct($db, $user, $pass);
            $this->data = array();
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

    }

    
?>