<?php

function esMultiploDe5y7($num) {
    return ($num % 5 == 0 && $num % 7 == 0);
}

function esImpar($num) {
    return $num % 2 != 0;
}

function esPar($num) {
    return $num % 2 == 0;
}
/*
function numAleatorios() {
    $secuencias = [];
    $iteraciones = 0;

    echo "  IMPAR   PAR   IMPAR     <br>";

    do {
        $iteraciones++;
        $num1 = rand(1, 1000);
        $num2 = rand(1, 1000);
        $num3 = rand(1, 1000);

        $secuencias[] = [$num1, $num2, $num3];
        echo "  ".$num1."    ".$num2."   ".$num3."   <br>";

        if (esImpar($num1) && esPar($num2) && esImpar($num3)) {
            echo ($iteraciones*3)." números obtenidos en ".$iteraciones." iteraciones".'<br>';
            break;
        } 

    } while (true);

}*/
function generarSecuencia() {
    $secuencias = [];
    $iteraciones = 0;


    echo "<table border='1' cellspacing='0' cellpadding='5'>";
    echo "<thead><tr><th>IMPAR</th><th>PAR</th><th>IMPAR</th></tr></thead>";
    echo "<tbody>";

    do {
        $iteraciones++;
        $num1 = rand(1, 1000);
        $num2 = rand(1, 1000);
        $num3 = rand(1, 1000);


        $secuencias[] = [$num1, $num2, $num3];


        echo "<tr>";
        echo "<td>$num1</td>";
        echo "<td>$num2</td>";
        echo "<td>$num3</td>";
        echo "</tr>";

   
        if (esImpar($num1) && esPar($num2) && esImpar($num3)) {
            
            echo "</tbody>";
            echo "</table>";

            echo "<p>" . ($iteraciones * 3) . " números obtenidos en $iteraciones iteraciones</p>";
            break;
        }

    } while (true);
}


?>