<?php

    use TECWEB\MYAPI\Products as Products;
    include_once __DIR__.'/myapi/Products.php';

    $data = array();

    $singleProduct = new Products('marketplace');

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
    $productos = new Products('marketzone');
    $productos->single( $_POST['id'] );
    echo $productos->getData();
    */
    
?>