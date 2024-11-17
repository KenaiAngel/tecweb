<?php

    use TECWEB\MYAPI\Products as Products;
    include_once __DIR__.'/myapi/Products.php';

    $deleteProduct = new Products('marketplace');
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        $deleteProduct->delete($id);
        echo $deleteProduct->getData();
    }
    else{
        $data = array(
            'status'  => 'error',
            'message' => 'EL dato ingresado es incorrecto'
        );
        echo json_encode($data, JSON_PRETTY_PRINT);
    }


?>