<?php

    use TECWEB\MYAPI\Products as Products;
    include_once __DIR__.'/myapi/Products.php';

    

    if( isset($_GET['search']) ) {

        $searchProduct = new Products('marketplace');
        
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