<?php
    namespace projtecweb\myapi\Product\Product;

    require_once __DIR__ . '/vendor/autoload.php';

    use projtecweb\myapi\Product\Product;

    $product = new Product();
    $product->listProduct();
    echo $product->getData();
?>