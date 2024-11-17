<?php

    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__ . '/myapi/Products.php';
    
    $productos = new Products('marketplace');
    $productos->edit(json_decode(json_encode($_POST)));
    echo $productos->getData();

?>