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

    <div>
        <h2>Ejercicio 5</h2>
        
        <form action="" method="post">
            <p>Sexo:</p> 
            <select name="sexo" id="sexo">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select><br>
            <p>Edad:</p>
            <input type="number" name="edad" id="edad"><br>
            <input type="submit" value="Enviar">
        </form>
        <?php
            if(isset($_POST['sexo']) && isset($_POST['edad'])){
                $sexo = $_POST['sexo'];
                $edad = $_POST['edad'];
                if ($sexo == "femenino" && $edad >= 18 && $edad <= 35) {
                    echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
                } else {
                    echo "<p>Error: Sus datos no cumplen con los requisitos .</p>";
                }
            }        
        ?>
    </div>

    <div>
        <h2>Ejercicio 6</h2>
        <?php
        $parqueVehicular = [
            'GHI7890' => [
                'Auto' => [
                    'Marca' => 'Ford',
                    'Modelo' => 2021,
                    'Tipo' => 'SUV'
                ],
                'Propietario' => [
                    'Nombre' => 'Carlos García',
                    'Ciudad' => 'Monterrey',
                    'Dirección' => 'Calle del Sol 789'
                ]
            ],
            'JKL3456' => [
                'Auto' => [
                    'Marca' => 'Chevrolet',
                    'Modelo' => 2018,
                    'Tipo' => 'pickup'
                ],
                'Propietario' => [
                    'Nombre' => 'Laura Fernández',
                    'Ciudad' => 'Tijuana',
                    'Dirección' => 'Calle Luna 321'
                ]
            ],
            'MNO1234' => [
                'Auto' => [
                    'Marca' => 'Mazda',
                    'Modelo' => 2022,
                    'Tipo' => 'sedan'
                ],
                'Propietario' => [
                    'Nombre' => 'David Hernández',
                    'Ciudad' => 'Puebla',
                    'Dirección' => 'Avenida Reforma 567'
                ]
            ],
            'PQR5678' => [
                'Auto' => [
                    'Marca' => 'Nissan',
                    'Modelo' => 2020,
                    'Tipo' => 'crossover'
                ],
                'Propietario' => [
                    'Nombre' => 'Ana Torres',
                    'Ciudad' => 'Cancún',
                    'Dirección' => 'Calle del Mar 234'
                ]
            ],
            'STU9101' => [
                'Auto' => [
                    'Marca' => 'Volkswagen',
                    'Modelo' => 2017,
                    'Tipo' => 'compacto'
                ],
                'Propietario' => [
                    'Nombre' => 'Roberto Martínez',
                    'Ciudad' => 'Querétaro',
                    'Dirección' => 'Calle Viento 123'
                ]
            ],
            'VWX2345' => [
                'Auto' => [
                    'Marca' => 'Tesla',
                    'Modelo' => 2023,
                    'Tipo' => 'eléctrico'
                ],
                'Propietario' => [
                    'Nombre' => 'Sofía Ramírez',
                    'Ciudad' => 'Mérida',
                    'Dirección' => 'Avenida Verde 789'
                ]
            ],
            'YZA3456' => [
                'Auto' => [
                    'Marca' => 'BMW',
                    'Modelo' => 2021,
                    'Tipo' => 'coupe'
                ],
                'Propietario' => [
                    'Nombre' => 'Miguel Ruiz',
                    'Ciudad' => 'León',
                    'Dirección' => 'Boulevard Dorado 456'
                ]
            ],
            'BCD6789' => [
                'Auto' => [
                    'Marca' => 'Audi',
                    'Modelo' => 2020,
                    'Tipo' => 'sedan'
                ],
                'Propietario' => [
                    'Nombre' => 'Valeria Pérez',
                    'Ciudad' => 'Toluca',
                    'Dirección' => 'Calle Real 789'
                ]
            ],
            'EFG9012' => [
                'Auto' => [
                    'Marca' => 'Hyundai',
                    'Modelo' => 2019,
                    'Tipo' => 'SUV'
                ],
                'Propietario' => [
                    'Nombre' => 'Jorge Mendoza',
                    'Ciudad' => 'Villahermosa',
                    'Dirección' => 'Calle Esmeralda 123'
                ]
            ],
            'HIJ2345' => [
                'Auto' => [
                    'Marca' => 'Kia',
                    'Modelo' => 2021,
                    'Tipo' => 'minivan'
                ],
                'Propietario' => [
                    'Nombre' => 'Elena Navarro',
                    'Ciudad' => 'Aguascalientes',
                    'Dirección' => 'Avenida Las Flores 567'
                ]
            ],
            'KLM4567' => [
                'Auto' => [
                    'Marca' => 'Peugeot',
                    'Modelo' => 2022,
                    'Tipo' => 'hatchback'
                ],
                'Propietario' => [
                    'Nombre' => 'Fernando Gutiérrez',
                    'Ciudad' => 'Saltillo',
                    'Dirección' => 'Calle del Bosque 890'
                ]
            ],
            'NOP7890' => [
                'Auto' => [
                    'Marca' => 'Renault',
                    'Modelo' => 2018,
                    'Tipo' => 'sedan'
                ],
                'Propietario' => [
                    'Nombre' => 'Gabriela Sánchez',
                    'Ciudad' => 'Morelia',
                    'Dirección' => 'Calle Diamante 345'
                ]
            ],
            'QRS0123' => [
                'Auto' => [
                    'Marca' => 'Subaru',
                    'Modelo' => 2020,
                    'Tipo' => 'SUV'
                ],
                'Propietario' => [
                    'Nombre' => 'Julio Castillo',
                    'Ciudad' => 'Oaxaca',
                    'Dirección' => 'Calle del Arco 678'
                ]
            ],
            'TUV3456' => [
                'Auto' => [
                    'Marca' => 'Mitsubishi',
                    'Modelo' => 2019,
                    'Tipo' => 'pickup'
                ],
                'Propietario' => [
                    'Nombre' => 'Paola Reyes',
                    'Ciudad' => 'Chihuahua',
                    'Dirección' => 'Calle Central 910'
                ]
            ],
            'WXY5678' => [
                'Auto' => [
                    'Marca' => 'Fiat',
                    'Modelo' => 2017,
                    'Tipo' => 'compacto'
                ],
                'Propietario' => [
                    'Nombre' => 'Santiago Lara',
                    'Ciudad' => 'Culiacán',
                    'Dirección' => 'Calle Norte 101'
                ]
            ]    
        ];
        print_r($parqueVehicular);
    ?>
    
    <h2>Consulta de Parque Vehicular</h2>
    <form action="" method="post">
        Matrícula:
        <input type="text" name="matricula" id="matricula">
        <input type="submit" name="consulta" value="Por Matricula">
        <input type="submit" name="consulta" value="Consultar Todos">
    </form>
    <?php
// Simulación del array $parqueVehicular, ya que no está definido en el código proporcionado.
$parqueVehicular = [
    'ABC123' => [
        'Auto' => ['Marca' => 'Toyota', 'Modelo' => 'Corolla', 'Tipo' => 'Sedán'],
        'Propietario' => ['Nombre' => 'Juan Pérez', 'Ciudad' => 'Ciudad de México', 'Dirección' => 'Calle Falsa 123']
    ],
    'XYZ789' => [
        'Auto' => ['Marca' => 'Honda', 'Modelo' => 'Civic', 'Tipo' => 'Sedán'],
        'Propietario' => ['Nombre' => 'María López', 'Ciudad' => 'Guadalajara', 'Dirección' => 'Avenida Siempreviva 456']
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las claves 'consulta' y 'matricula' existen antes de acceder a ellas
    if (isset($_POST['consulta'])) {
        $consulta = $_POST['consulta'];
    } else {
        $consulta = ''; // Evitar el warning asignando un valor por defecto
    }

    if (isset($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
    } else {
        $matricula = ''; // Evitar el warning asignando un valor por defecto
    }

    // Si la consulta es "Por Matrícula" y la matrícula no está vacía
    if ($consulta == "Por Matrícula" && !empty($matricula)) {
        if (isset($parqueVehicular[$matricula])) {
            $vehiculo = $parqueVehicular[$matricula];
            echo "<h3>Vehículo con Matrícula $matricula</h3>";
            echo "<p>Marca: " . $vehiculo['Auto']['Marca'] . "</p>";
            echo "<p>Modelo: " . $vehiculo['Auto']['Modelo'] . "</p>";
            echo "<p>Tipo: " . $vehiculo['Auto']['Tipo'] . "</p>";
            echo "<p>Propietario: " . $vehiculo['Propietario']['Nombre'] . "</p>";
            echo "<p>Ciudad: " . $vehiculo['Propietario']['Ciudad'] . "</p>";
            echo "<p>Dirección: " . $vehiculo['Propietario']['Dirección'] . "</p>";
        } else {
            echo "<p>No se encontró el vehículo con matrícula $matricula.</p>";
        }
    } elseif ($consulta == "Consultar Todos") {
        foreach ($parqueVehicular as $matricula => $vehiculo) {
            echo "<h3>Matrícula: $matricula</h3>";
            echo "<p>Marca: " . $vehiculo['Auto']['Marca'] . "</p>";
            echo "<p>Modelo: " . $vehiculo['Auto']['Modelo'] . "</p>";
            echo "<p>Tipo: " . $vehiculo['Auto']['Tipo'] . "</p>";
            echo "<p>Propietario: " . $vehiculo['Propietario']['Nombre'] . "</p>";
            echo "<p>Ciudad: " . $vehiculo['Propietario']['Ciudad'] . "</p>";
            echo "<p>Dirección: " . $vehiculo['Propietario']['Dirección'] . "</p>";
            echo "<br>";
        }
    }
}
?>


    </div>


</body>
</html>