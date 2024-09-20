<?php

function esMultiploDe5y7($num) {
    return ($num % 5 == 0 && $num % 7 == 0);
}

function esMultiploDe($dividendo, $divisor) {
    return ($dividendo % $divisor == 0 );
}



function esImpar($num) {
    return $num % 2 != 0;
}

function esPar($num) {
    return $num % 2 == 0;
}


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

        if (esImpar($num1) && esPar($num2) && esImpar($num3)) {
            
            break;
        } 

    } while (true);

    return [$secuencias, $iteraciones];

}

function aleatorioWhile($divisor){
    $iteraciones =0;
    $encontrado = false;

    while(!$encontrado){
        $num1 = rand(1, 1000);
        $iteraciones++;
        if($num1 % $divisor == 0){
            $encontrado = true;
        }

    }
    return [$num1,$iteraciones];
}


function aleatorioDoWhile($divisor){
    $iteraciones =0;


    do{
        $num1 = rand(1, 1000);
        $iteraciones++;

    }while($num1 % $divisor != 0);

    return [$num1,$iteraciones];
}

/*
function numAleatorios() {
    $secuencias = [];
    $iteraciones = 0;


    echo "<table border='1' cellspacing='0' cellpadding='5'>";
    echo "
    <thead>
            <tr>
                <th style='color:blue;'>IMPAR</th>
                <th style='color:red;'>PAR</th>
                <th style='color:blue;'>IMPAR</th>
            </tr>
    </thead>
    ";

    echo "<tbody>";

    do {
        $iteraciones++;
        $num1 = rand(1, 1000);
        $num2 = rand(1, 1000);
        $num3 = rand(1, 1000);


        $secuencias[] = [$num1, $num2, $num3];

   
        if (esImpar($num1) && esPar($num2) && esImpar($num3)) {

            echo "<tr>";
            echo "<td style='color:blue;' >$num1</td>";
            echo "<td style='color:red;' >$num2</td>";
            echo "<td style='color:blue;' >$num3</td>";
            echo "</tr>";

            echo "</tbody>";
            echo "</table>";

            echo "<p>" . ($iteraciones * 3) . " números obtenidos en $iteraciones iteraciones</p>";
            break;
        }
        else{
            echo "<tr>";
            echo "<td>$num1</td>";
            echo "<td>$num2</td>";
            echo "<td>$num3</td>";
            echo "</tr>";
        }

    } while (true);
}

*/
?>