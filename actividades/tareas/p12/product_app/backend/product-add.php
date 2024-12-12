<?php
    namespace TECWEB\MYAPI\Create;

    include_once __DIR__.'/vendor/autoload.php';

    $addAProduct = new Create('marketplace');
    $addAProduct->add(json_decode(json_encode($_POST)));
    echo $addAProduct->getData();
?>