<?php
namespace projtecweb\myapi\Formulario;

use projtecweb\myapi\DataBase;
// require_once __DIR__ . '/../DataBase.php';

class Formulario extends DataBase {

    public function __construct() {
        parent::__construct();
    }

    //$datos = arreglo con la informacion recibida del formulario
    public function saveData($JSON){

        $this->data = array(
            'status'  => 'error',
            'message' => 'Producto no agregado'
        );
        $datos = json_decode(file_get_contents('php://input'), true);
        
        //Vericar que sea un arreglo y no este vacio
        if(!is_array($datos) || empty($datos)){
            throw new \Exception("Arreglo asociativo invalido");
        }

        $columnas = implode(',', array_keys($datos));
        $marcadores = implode(',', array_fill(0, count($datos),'?'));
        $query = "INSERT INTO productos ($columnas) VALUES ($marcadores)";
        

        $stmt = $this->conexion->prepare($query);
        if(!$stmt){
            throw new \Exception("Error al preparar la consulta ".$this->conexion->error);
        }

        $tipos = $this->getTiposDeDatos($datos);
        $valores = array_values($datos);
        $stmt->bind_param($tipos, ...$valores);
        
        if(!$stmt->execute()){
            throw new \Exception("Error al ejecutar la consulta ".$this->conexion->error);
        }

        $stmt->close();
        $this->conexion->close();
        $this->data = array(
            'status' => 'success',
            'message' => 'Producto agregado exitosamente.'
        );
    }

    private function getTiposDeDatos($datos){
        $tipos = '';
        foreach ($datos as $valor){
            if (is_int($valor)) {
                $tipos .='i';
            } elseif (is_double($valor)) {
                $tipos .='d';
            } else{
                $tipos .= 's';
            }
        }
        return $tipos;
    }
}
?>