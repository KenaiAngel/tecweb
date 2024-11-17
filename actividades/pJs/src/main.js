/*
function getDatos(){
    var nombre = prompt('Nombre: ', '');
    var edad = prompt('Edad: ', 0);

    var div1 = document.getElementById('nombre');
    div1.innerHTML = '<h3>Nombre: ' + nombre + '</h3>';
    var div2 = document.getElementById('edad');
    div2.innerHTML = '<h3>Edad: ' + edad + '</h3>';
}
*/
function ejem1(){
    let ejem1 = document.getElementById('ejem1');
    ejem1.innerHTML = '<p>Hola Mundo</p>';
}

function ejem2(){
    let nombre = 'Juan';
    let edad = 10;
    let altura = 1.92;
    let casado = false;

    let div2 = document.getElementById('ejem2');
    div2.innerHTML = '<p>' + nombre + '<br>' + edad + '<br>' + altura + '<br>' + casado + '</p>';
}
function ejem3(){
    let nombre = prompt('Nombre: ', '');
    let edad = prompt('Edad: ', 0);

    let div3 = document.getElementById('ejem3');
    div3.innerHTML = '<p>Hola ' + nombre + ' así que tienes ' + edad + '</p>';
}
function ejem4(){
    let valor1 = prompt('Introducir primer número','');
    let valor2 = prompt('Introducir primer número','');
    let suma = parseInt(valor1) + parseInt(valor2);
    let producto = parseInt(valor1) * parseInt(valor2);

    let div4 = document.getElementById('ejem4');
    div4.innerHTML = '<p>La suma es: ' + suma + '<br> El producto es: ' + producto + '</p>';
}
function ejem5(){
    let nombre = prompt('Ingresa tu nombre:', '');
    let nota = prompt('Ingresa tu nota:', '');
    if (nota>=4) {
        let div5 = document.getElementById('ejem5');
        div5.innerHTML = '<p>' + nombre + ' esta aprobado con un ' + nota + '</p>';
    }
}
function ejem6(){
    let num1 = prompt('Ingresa el primer número:', '');
    let num2 = prompt('Ingresa el segundo número:', '');
    num1 = parseInt(num1);
    num2 = parseInt(num2);

    let div6 = document.getElementById('ejem6');
    if (num1>num2) {
        div6.innerHTML = '<p>El mayor es ' + num1 + '</p>';
    }
    else {
        div6.innerHTML = '<p>El mayor es ' + num2 + '</p>';
    }
}
function ejem7(){
    let nota1 = prompt('Ingresa 1ra. nota:', '');
    let nota2 = prompt('Ingresa 2da. nota:', '');
    let nota3 = prompt('Ingresa 3ra. nota:', '');
    nota1 = parseInt(nota1);
    nota2 = parseInt(nota2);
    nota3 = parseInt(nota3);

    let promedio = (nota1+nota2+nota3)/3;
    let div7 = document.getElementById('ejem7');
    if (promedio>=7) {
            div7.innerHTML = '<p>Aprobado</p>';
        }
        else {
        if (promedio>=4) {
            div7.innerHTML = '<p>Regular</p>';
        }
        else {
            div7.innerHTML = '<p>Reprobado</p>';
        }
    }
}
function ejem8(){
    var valor = prompt('Ingresar un valor comprendido entre 1 y 5:', '' );
    valor = parseInt(valor);

    var div8 = document.getElementById('ejem8');
    switch (valor) {
        case 1: div8.innerHTML = '<p>uno</p>';
            break;
        case 2: div8.innerHTML = '<p>dos</p>';
            break;  
        case 3: div8.innerHTML = '<p>tres</p>';                                                 
            break;
        case 4: div8.innerHTML = '<p>cuatro</p>';
            break;
        case 5: div8.innerHTML = '<p>cinco</p>';
            break;
        default: div8.innerHTML = '<p>Debe ingresar un valor comprendido entre 1 y 5.</p>';
    }
}
function ejem9(){
    var col = prompt('Ingresa el color con que quierar pintar el fondo de la ventana (rojo, verde, azul)' , '');
    switch (col) {
    case 'rojo': document.bgColor='#ff0000';
        break;
    case 'verde': document.bgColor='#00ff00';
        break;
    case 'azul': document.bgColor='#0000ff';
        break;
    }
}
function ejem10(){
    let x = 1;
    let contenido = '';
    while (x<=100) {
    contenido += x + '<br>';
    x = x+1;
    }

    let div10 = document.getElementById('ejem10');
    div10.innerHTML = '<p>' + contenido + '</p>';
}
function ejem11(){
    let x = 1;
    let suma = 0;
    let valor;
    while (x<=5){
    valor = prompt('Ingresa el valor:', '');
    valor = parseInt(valor);
    suma += valor;
    x += 1;
    }

    let div11 = document.getElementById('ejem11');
    div11.innerHTML = "<p>La suma de los valores es " + suma + "</p>";
}
function ejem12(){
    let valor;
    let contenido = ''
    do{
        valor = prompt('Ingresa un valor entre 0 y 999:', '');
        valor = parseInt(valor);
        if (valor<10)
            contenido += 'El valor ' + valor + ' tiene 1 digitos<br>';
        else
            if (valor<100) {
                contenido += 'El valor ' + valor + ' tiene 2 digitos<br>';
            }
            else {
                contenido += 'El valor ' + valor + ' tiene 3 digitos<br>';
            }
    }while(valor != 0);

    let div12 = document.getElementById('ejem12');
    div12.innerHTML = '<p>' + contenido + '</p>';
}
function ejem13(){
    let i;
    let contenido = "";
    for(i=1; i<=10; i++){
        contenido+= i + ' ';
    }

    let div13 = document.getElementById('ejem13');
    div13.innerHTML = '<p>' + contenido + '</p>';

}
function ejem14(){
    let contenido = 'Cuidado<br>Ingresa tu documento correctamente<br>'
    contenido+= contenido + contenido;

    let div14 = document.getElementById('ejem14');
    div14.innerHTML = '<p>' + contenido + '</p>';
}
function ejem15(){
    function mostrarMensaje() {
        let cadena = 'Cuidado<br>Ingresa tu documento correctamente<br>';
        div15.innerHTML += cadena;
    }
    let div15 = document.getElementById('ejem15');
    div15.innerHTML = '';
    mostrarMensaje();
    mostrarMensaje();
    mostrarMensaje();
}
function ejem16(){
    function mostrarRango(x1,x2) {
        var cadena = '';
        var inicio;
        var div16 = document.getElementById('ejem16');
        for(inicio=x1; inicio<=x2; inicio++) {
            cadena+= inicio + ' ';
        }
        div16.innerHTML = '<p>' + cadena + '</p>';
    }
    var valor1,valor2;
    valor1 = prompt('Ingresa el valor inferior:', '');
    valor1 = parseInt(valor1);
    valor2 = prompt('Ingresa el valor superior:', '');
    valor2 = parseInt(valor2);
    mostrarRango(valor1,valor2);
}
function ejem17(){
    function convertirCastellano(x) {
        if(x==1)
            return 'uno';
        else
            if(x==2)
                return 'dos';
            else
                if(x==3)
                    return 'tres';
                else
                    if(x==4)
                        return 'cuatro';
                    else
                        if(x==5)
                            return 'cinco';
                        else
                            return 'valor incorrecto';
    }
    let valor = prompt("Ingresa un valor entre 1 y 5", "");
    valor = parseInt(valor);
    let r = convertirCastellano(valor);

    let div17 = document.getElementById('ejem17');
    div17.innerHTML = '<p>' + r + '</p>';
}
function ejem18(){
    function convertirCastellano(x) {
        switch (x) {
            case 1: return "uno";
            case 2: return "dos";
            case 3: return "tres";
            case 4: return "cuatro";
            case 5: return "cinco";
            default: return "valor incorrecto";
        }
    }
    let valor = prompt("Ingresa un valor entre 1 y 5", "");
    valor = parseInt(valor);
    let r = convertirCastellano(valor);

    let div18 = document.getElementById('ejem18');
    div18.innerHTML = '<p>' + r + '</p>';
}