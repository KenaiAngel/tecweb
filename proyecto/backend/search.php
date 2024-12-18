<?php
    namespace projtecweb\myapi\Product\Product;

    require_once __DIR__ . '/vendor/autoload.php';

    use projtecweb\myapi\Product\Product;

    if( isset($_GET['search']) ) {
        $product = new Product();
        $product->searchAndList($_GET['search']);
        echo $product->getData();
    }
?>