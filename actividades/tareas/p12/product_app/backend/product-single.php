<?php

    namespace TECWEB\MYAPI\Read;

    include_once __DIR__.'/vendor/autoload.php';
    $data = array();

    $singleProduct = new Read('marketplace');

    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        $singleProduct->single( json_decode( json_encode($id) ) );
        echo $singleProduct->getData();
    
    }
    else{
        $data = array(
            'status'  => 'error',
            'message' => 'Falta de argumento'
        );
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
    /*
    $productos = new Products('marketplace');
    $productos->single( $_POST['id'] );
    echo $productos->getData();
    */
    
?>