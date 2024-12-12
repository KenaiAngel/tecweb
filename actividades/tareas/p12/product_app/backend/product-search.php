<?php

    namespace TECWEB\MYAPI\Read;

    include_once __DIR__.'/vendor/autoload.php';

    

    if( isset($_GET['search']) ) {

        $searchProduct = new Read('marketplace');
        
        $search = $_GET['search'];

        $searchProduct->search($search);
        echo $searchProduct->getData();
    }
    else{
        $data = array(
            'status'  => 'error',
            'message' => 'Surgio un problema'
        );
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    
?>