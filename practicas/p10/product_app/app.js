// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };



// FUNCIÓN CALLBACK DE BOTÓN "Buscar"
function buscarID(e) {
    /**
     * Revisar la siguiente información para entender porqué usar event.preventDefault();
     * http://qbit.com.mx/blog/2013/01/07/la-diferencia-entre-return-false-preventdefault-y-stoppropagation-en-jquery/#:~:text=PreventDefault()%20se%20utiliza%20para,escuche%20a%20trav%C3%A9s%20del%20DOM
     * https://www.geeksforgeeks.org/when-to-use-preventdefault-vs-return-false-in-javascript/
     */
    e.preventDefault();

    // SE OBTIENE EL ID A BUSCAR
    var id = document.getElementById('search').value;

    // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
        if (client.readyState == 4 && client.status == 200) {
            console.log('[CLIENTE]\n'+client.responseText);
            
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let productos = JSON.parse(client.responseText);    // similar a eval('('+client.responseText+')');
            
            // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
            if(Object.keys(productos).length > 0) {
                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                let descripcion = '';
                    descripcion += '<li>precio: '+productos.precio+'</li>';
                    descripcion += '<li>unidades: '+productos.unidades+'</li>';
                    descripcion += '<li>modelo: '+productos.modelo+'</li>';
                    descripcion += '<li>marca: '+productos.marca+'</li>';
                    descripcion += '<li>detalles: '+productos.detalles+'</li>';
                
                // SE CREA UNA PLANTILLA PARA CREAR LA(S) FILA(S) A INSERTAR EN EL DOCUMENTO HTML
                let template = '';
                    template += `
                        <tr>
                            <td>${productos.id}</td>
                            <td>${productos.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;

                // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                document.getElementById("productos").innerHTML = template;
            }
        }
    };
    client.send("id="+id);
}

function buscarProducto(e) {
	e.preventDefault();
	let search = document.getElementById("search").value;

	var client = getXMLHttpRequest();
	client.open("POST", "./backend/read.php", true);
	client.setRequestHeader(
		"Content-Type",
		"application/x-www-form-urlencoded"
	);
	client.onreadystatechange = function () {
		if (client.readyState == 4 && client.status == 200) {
            console.log("Imprimir1");
			console.log("[CLIENTE]\n" + client.responseText);
			let productos = JSON.parse(client.responseText);
            console.log(productos.length);
			if (productos.length > 0) {
                console.log("Imprimir");
				let template = "";
				productos.forEach((producto) => {
					let descripcion = "";
					descripcion += "<li>precio: " + producto.precio + "</li>";
					descripcion += "<li>unidades: " + producto.unidades + "</li>";
					descripcion += "<li>modelo: " + producto.modelo + "</li>";
					descripcion += "<li>marca: " + producto.marca + "</li>";
					descripcion += "<li>detalles: " + producto.detalles + "</li>";
					template += `
                        <tr>
                            <td>${producto.id}</td>
                            <td>${producto.nombre}</td>
                            <td><ul>${descripcion}</ul></td>
                        </tr>
                    `;
				});
				document.getElementById("productos").innerHTML = template;
			}
		}
	};
	client.send("search=" + search);
}

// FUNCIÓN CALLBACK DE BOTÓN "Agregar Producto"
function agregarProducto(e) {
    e.preventDefault();

    // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
    var productoJsonString = document.getElementById('description').value;
    console.log(productoJsonString);


    // SE CONVIERTE EL JSON DE STRING A OBJETO
    var finalJSON = JSON.parse(productoJsonString);
    // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
    finalJSON['nombre'] = document.getElementById('name').value;
    if (finalJSON.imagen === '') {
        finalJSON.imagen = 'img/cat.png'; 
    }

    //validacion
    if(!(validar(finalJSON))){
        window.alert("Ingrese los datos de la manera que se le pide");
    }
    else{
        // SE OBTIENE EL STRING DEL JSON FINAL
        productoJsonString = JSON.stringify(finalJSON,null,2);

        // SE CREA EL OBJETO DE CONEXIÓN ASÍNCRONA AL SERVIDOR
        var client = getXMLHttpRequest();
        client.open('POST', './backend/create.php', true);
        client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
        client.onreadystatechange = function () {
            // SE VERIFICA SI LA RESPUESTA ESTÁ LISTA Y FUE SATISFACTORIA
            if (client.readyState == 4 && client.status == 200) {
                console.log("Imprimir1");
                console.log("[CLIENTE]\n" + client.responseText);
                window.alert(client.responseText);
            }

               
        };
        client.send(productoJsonString);
        
    }

}

// SE CREA EL OBJETO DE CONEXIÓN COMPATIBLE CON EL NAVEGADOR
function getXMLHttpRequest() {
    var objetoAjax;

    try{
        objetoAjax = new XMLHttpRequest();
    }catch(err1){
        /**
         * NOTA: Las siguientes formas de crear el objeto ya son obsoletas
         *       pero se comparten por motivos historico-académicos.
         */
        try{
            // IE7 y IE8
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        }catch(err2){
            try{
                // IE5 y IE6
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(err3){
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}

function validar(objeto) {
    console.log(objeto.nombre);

    let error = "";
    let hayError = false;

    // Validación del nombre
    if ((objeto.nombre.length > 100) || (objeto.nombre.length === 0)) {
        error += '<p>El nombre sobrepasa el límite de 100 caracteres, o esta vacio</p>';  
    }

    // Validación del modelo
    if ((objeto.modelo.length > 25) || (objeto.modelo.length === 0)) {
        error += '<p>El modelo sobrepasa el límite de 25 caracteres</p>'; 
    } else if (!(/\d/.test(objeto.modelo))) {
        error += '<p>El modelo debe contener al menos un número</p>';
    }

    // Validación de detalles
    if (objeto.detalles.length > 300) {
        error += '<p>Los detalles sobrepasan el límite de 300 caracteres</p>';
    }

    // Validación del precio
    if (isNaN(objeto.precio) || parseFloat(objeto.precio) < 99.99) {
        error += '<p>El precio debe ser un número y estar por encima de 99.99</p>';
    }

    // Validación de unidades
    if (isNaN(objeto.unidades) || parseInt(objeto.unidades) <= 0) {
        error += '<p>Las unidades deben ser un número mayor o igual a 0</p>';
    }
    console.log("mARCA"+objeto.marca);
    if ((objeto.marca != 'Nike') && (objeto.marca != 'Jordan') && (objeto.marca != 'Converse') && (objeto.marca != 'Adidas')) {
        error += '<p>La marca debe ser o Nike, o Jordan, o Converse, o Adidas.</p>';
    }
    

    // Mostrar errores si existen
    if (error !== "") {
        document.getElementById('error_validacion').innerHTML = error;
        hayError = true;
    } else {
        document.getElementById('error_validacion').innerHTML = ""; 
        hayError = false;
    }

    return hayError;

}


function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}

