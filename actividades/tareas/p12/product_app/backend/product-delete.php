<?php

    namespace TECWEB\MYAPI\Delete;

    include_once __DIR__.'/vendor/autoload.php';

    $deleteProduct = new Delete('marketplace');
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