<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';

        echo '<p>Ejercicio 2</p><br>' ;
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo $a.'<br>';
        echo $b.'<br>';
        echo $c.'<br>';

        echo '<br>';

        $a = "PHP server";
        $b = &$a;

        echo $a.'<br>';
        echo $b.'<br>';


        echo '<p>Respuesta: Asignamos otro valor a la varible 
        $a y $b, modificamos la variable $a y obtenemos su valor por referencia para asignarla a $b </p>';

        
        
        echo '<br><p>Ejercicio 3</p><br>' ;
        unset($a);
        unset($b);
        unset($c);

        $a = "PHP5";
        echo $a.'<br>';
        $z[] = &$a;
        print_r($z);
        echo '<br>';
        $b = "5a version de PHP";
        echo $b.'<br>';
        @$c = $b*10;
        echo $c.'<br>';
        $a .= $b;
        echo $a.'<br>';
        @$b *= $c;
        echo $b.'<br>';
        $z[0] = "MySQL";
        print_r($z);
        echo '<br>';

        echo '<br><p>Ejercicio 4</p><br>' ;
        function mostrar(){
            echo '$a en el ambito global: '.$GLOBALS['a'].'<br>';
            echo '$b en el ambito global: '.$GLOBALS['b'].'<br>';
            echo '$c en el ambito global: '.$GLOBALS['c'].'<br>';
            print_r ($GLOBALS['z']);
    
        }
        mostrar();

        echo '<br><p>Ejercicio 5</p><br>' ;
        /*Dar el valor de las variables $a, $b, $c al final del siguiente script:
$a = “7 personas”;
$b = (integer) $a;
$a = “9E3”;
$c = (double) $a;
6. Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
usando la función var_dump(<datos>). */
        unset($a);
        unset($b);
        unset($c);

        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;
        
        echo $a.'<br>';
        echo $b.'<br>';
        echo $c.'<br>';

        echo '<br><p>Ejercicio 6</p><br>' ;
        unset($a);
        unset($b);
        unset($c);

        $a = "0";
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        echo '$a ='.$a.'<br>';
        echo '$b ='.$b.'<br>';
        echo '$c ='.(bool) $c ? 'true' : 'false'.'<br>';
        echo '$d ='.$d.'<br>';
        echo '$e ='.(bool) $e ? 'true' : 'false'.'<br>';
        echo '$f ='.$f.'<br>';

        /*7. Usando la variable predefinida $_SERVER, determina lo siguiente:
a. La versión de Apache y PHP,
b. El nombre del sistema operativo (servidor),
c. El idioma del navegador (cliente). */

        echo '<br><p>Ejercicio 7</p><br>' ;

        echo 'Software:- '.$_SERVER['SERVER_SOFTWARE'].'<br>';
        echo  'Sistema Operativo:- '.PHP_OS.'<br>';
        echo  'Lenguaje:- '.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'<br>';
        
        


    ?>
    <p>
    <a href="https://validator.w3.org/markup/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>
</body>
</html>