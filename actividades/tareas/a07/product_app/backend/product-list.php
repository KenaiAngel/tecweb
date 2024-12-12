<?php
    use TECWEB\MYAPI\Products as Products;

    include_once __DIR__.'/myapi/Products.php';

    $listOfProducts = new Products('marketplace');
    $listOfProducts->list();
    echo $listOfProducts->getData();
?>