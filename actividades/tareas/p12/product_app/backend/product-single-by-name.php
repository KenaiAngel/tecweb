<?php

    namespace TECWEB\MYAPI\Read;

    include_once __DIR__.'/vendor/autoload.php';
    
    $data = array();

    $singleProductByName = new Read('marketplace');

    if( isset($_POST['nombre']) ) {
        $nombre = $_POST['nombre'];
        $singleProductByName->single( json_decode( json_encode($nombre) ) );
        echo $singleProductByName->getData();
    
    }
    else{
        $data = array(
            'status'  => 'error',
            'message' => 'Falta de argumento'
        );
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
?>