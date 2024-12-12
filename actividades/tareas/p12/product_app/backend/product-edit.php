<?php

    namespace TECWEB\MYAPI\Update;

    include_once __DIR__.'/vendor/autoload.php';
    
    $productos = new Update('marketplace');
    $productos->edit(json_decode(json_encode($_POST)));
    echo $productos->getData();

?>