<?php
    namespace projtecweb\myapi\Product\Product;

    require_once __DIR__ . '/vendor/autoload.php';

    use projtecweb\myapi\Product\Product;

    if( isset($_GET['id']) ) {
        $product = new Product();
        $product->getImageById($_GET['id']);
        echo $product->getData();
    }
?>