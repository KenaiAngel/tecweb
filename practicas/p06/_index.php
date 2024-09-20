<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        include 'src/funciones.php';

        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R:- El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R:- El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>

    <div>
        
        <?php

            echo "
                <h2>
                    Ejercicio 2
                </h2>
            <br>";


            $resultado = numAleatorios();
            $GLOBALS["matriz"] = $resultado[0];
            $GLOBALS["iteraciones"] = $resultado[1];

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

            for ($i = 0; $i < $iteraciones; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 3; $j++) {
                    if ($i == $iteraciones - 1) {
                        // Colorear la última fila con diferentes estilos
                        echo "<td style='color:blue;'>" . $matriz[$i][$j] . "</td>";
                        echo "<td style='color:red;'>" . $matriz[$i][$j+1] . "</td>";
                        echo "<td style='color:blue;'>" . $matriz[$i][$j+2] . "</td>";

                        break;
                    } else {
                        // Mostrar los números normales en otras filas
                        echo "<td>" . $matriz[$i][$j] . "</td>";
                    }
                }
                echo "</tr>";
            }

            // Cerrar la tabla y mostrar el número total de números obtenidos
            echo "</tbody>";
            echo "</table>";

            echo "<p>" . ($iteraciones * 3) . " números obtenidos en $iteraciones iteraciones</p>";


    
        ?>

    </div>

    <div>
        <h2>
            Ejercicio 3
        </h2>
        <br>
        <?php
         
            if (isset($_GET['divisor_get'])){
                $divisor = $_GET['divisor_get'];
                list($encontrado,$iteraciones) = aleatorioWhile($divisor);
                list($encontradoDoWhile,$iteracionesDoWhile) = aleatorioDoWhile($divisor);
                echo "Num $encontrado en $iteraciones iteraciones <br>";
                echo "Num $encontradoDoWhile en $iteracionesDoWhile iteraciones <br>";
            }


        ?>
    </div>

    <div>
        
        <h2>Ejercicio 4</h2>
        <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’ a la ‘z’.</p>
        <?php
            $ascii = valoresAscii();
            foreach ($ascii as $key => $value) {
                echo '['.$key.'] =>'.$value.'<br>';
            }
            
        ?>

    </div>


</body>
</html>