<?php
    use projtecweb\myapi\Formulario\Formulario;
    require_once __DIR__ . '/vendor/autoload.php';
    
    $productos = new Formulario();
    $productos->saveData(json_decode( json_encode($_POST) ) ); 
    echo $productos->getData();
?>