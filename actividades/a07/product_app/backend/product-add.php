<?php
    use TECWEB\MYAPI\Products as Products;

    include_once __DIR__.'/myapi/Products.php';

    $addAProduct = new Products('marketplace');
    $addAProduct->add(json_decode(json_encode($_POST)));
    echo $addAProduct->getData();
?>