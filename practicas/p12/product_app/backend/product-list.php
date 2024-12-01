<?php
    namespace TECWEB\MYAPI\Read;

    include_once __DIR__.'/vendor/autoload.php';

    $listOfProducts = new Read('marketplace');
    $listOfProducts->list();
    echo $listOfProducts->getData();
?>