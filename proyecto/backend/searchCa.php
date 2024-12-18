<?php
    namespace projtecweb\myapi\Product\Product;

    require_once __DIR__ . '/vendor/autoload.php';

    use projtecweb\myapi\Product\Product;

    if( isset($_GET['value']) ) {
        $product = new Product();
        $product->searchAndListCa($_GET['value']);
        echo $product->getData();
    }
?>