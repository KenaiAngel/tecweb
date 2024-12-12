<?php

    use TECWEB\MYAPI\Products as Products;
    include_once __DIR__.'/myapi/Products.php';
    
    $data = array();

    $singleProductByName = new Products('marketplace');

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