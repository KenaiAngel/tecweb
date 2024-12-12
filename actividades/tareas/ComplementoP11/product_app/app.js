// JSON BASE A MOSTRAR EN FORMULARIO
/*
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/imagen.png"
};

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;
}
*/
$(document).ready(function() {

    let edit = false;
    let mistakes = [];


    console.log('Hi jquery')
    listadoProductos();

    function listadoProductos(){
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response){
                let productos = JSON.parse(response);
                if(Object.keys(productos).length > 0) {
                    let template = '';

                    productos.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>
                                    <ul class="product-item">${producto.nombre}</ul>
                                </td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    document.getElementById("products").innerHTML = template;
                }
            }
        });
    }

    $('#search').keyup(function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

        // Obtener el valor de búsqueda usando jQuery
        let search = $('#search').val(); 

        // Realizar la solicitud AJAX
        $.ajax({
            url: './backend/product-search.php',
            type: 'GET',
            data: { search: search },
            success: function(response) {
                let productos = JSON.parse(response);

                if (Object.keys(productos).length > 0) {
                    let template = '';
                    let template_bar = '';

                    productos.forEach(producto => {
                        let descripcion = `
                            <li>precio: ${producto.precio}</li>
                            <li>unidades: ${producto.unidades}</li>
                            <li>modelo: ${producto.modelo}</li>
                            <li>marca: ${producto.marca}</li>
                            <li>detalles: ${producto.detalles}</li>
                        `;

                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>
                                    <ul class="product-item">${producto.nombre}</ul>
                                </td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" data-id="${producto.id}">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;

                        template_bar += `<li>${producto.nombre}</li>`;
                    });

                    // Actualizar el DOM con los resultados
                    document.getElementById("product-result").className = "card my-4 d-block";
                    document.getElementById("container").innerHTML = template_bar;
                    document.getElementById("products").innerHTML = template;
                } else {
                    // Manejar el caso en que no se encuentran productos
                    document.getElementById("product-result").className = "card my-4 d-none"; // Ocultar el contenedor
                    document.getElementById("container").innerHTML = ""; // Limpiar la barra de estado
                    document.getElementById("products").innerHTML = ""; // Limpiar la tabla de productos
                }
            },
            error: function() {
                alert("Hubo un error al realizar la búsqueda.");
            }
        });
    });

    //VALIDACION AL INSTANTE 

    function listMistakes (){
        if(Object.keys(mistakes).length !== 0){
            document.getElementById("product-result").className = "card my-4 d-block";
            document.getElementById('container').innerHTML = "";

            Object.values(mistakes).forEach(mistake => {
                document.getElementById('container').innerHTML += `<p>${mistake}</p>`;
            });
        }else{
            document.getElementById("product-result").className = "card my-4 d-none";
            
        }
        
    }
    

    $("#form-name").keyup(function(e) {
        e.preventDefault();

        const name = $( "#form-name").val();

        if (!name || name.length > 100) {
            mistakes["NullNameOrExcess"] = 'El nombre sobrepasa el límite de 100 caracteres o está vacío';  
            $( "#form-name" ).removeClass( "valid" );
        }
        else{
            $( "#form-name" ).addClass( "valid" );
            delete mistakes["NullNameOrExcess"];

            $.ajax({
                url: './backend/product-name.php',
                type: 'GET',
                data: {name},
    
                success: function(response){
                    console.log(response);
                    let respuesta = JSON.parse(response);
                    
                    if(respuesta.status === "f"){
                        let template_bar = '';
                        template_bar = `<li style="list-style: none;">message: ${respuesta.message}</li>`;
                        document.getElementById("product-result").className = "card my-4 d-block";
                        document.getElementById("container").innerHTML = template_bar;

                    }
                    
    
                }
    
            });
           
        }
        listMistakes();
        console.log(mistakes);

    });

    $("#form-model").keyup(function(e) {
        e.preventDefault();

        const model = $( "#form-model").val();

        if (!model|| model.length > 25) {
            mistakes["NullModelOrExcess"] = 'El modelo sobrepasa el límite de 25 caracteres o está vacío'; 
            $( "#form-model").removeClass('valid');
        }else{
            $( "#form-model").addClass('valid');
            delete mistakes["NullModelOrExcess"];
        }
        
        if (!(/\d/.test(model))) {
            $( "#form-model").removeClass('valid');
            mistakes["ModelNeedsNumber"] = 'El modelo debe contener al menos un número';
        }else{
            $( "#form-model").addClass('valid');
            delete mistakes["ModelNeedsNumber"]
        }
        listMistakes();
        console.log(mistakes);

    });

    $('#form-features').keyup(function(e){
        e.preventDefault();

        const features = $( "#form-features").val();

        if (features && features.length > 300) {
            $( "#form-features").removeClass('valid');
            mistakes["FeaturesExcess"] = 'Los detalles sobrepasan el límite de 300 caracteres';
        }else{
            $( "#form-features").addClass('valid');
            delete mistakes["FeaturesExcess"]
        }
        listMistakes();
        console.log(mistakes);
    });


    $('#form-price').keyup(function(e){
        e.preventDefault();

        const price = $( "#form-price").val();

        if (isNaN(price) || parseFloat(price) < 99.99) {
            $( "#form-features").removeClass('valid');
            mistakes["PriceNaNorLower"]= 'El precio debe ser un número y estar por encima de 99.99';
        }else{
            $( "#form-price").addClass('valid');
            delete mistakes["PriceNaNorLower"];
        }
        listMistakes();
    });

    $('#form-unit').keyup(function(e){
        e.preventDefault();

        const unit = $( "#form-unit").val();

        if (isNaN(unit) || parseInt(unit) < 0) {
            $( "#form-unit").removeClass('valid');
            mistakes["UnitNaNorLower"] = 'Las unidades deben ser un número mayor o igual a 0';
        }else{
            $( "#form-unit").addClass('valid');
            delete mistakes["UnitNaNorLower"];
        }
        listMistakes();
    });

    $('#form-brand').keyup(function(e){
        e.preventDefault();

        const brand = $( "#form-brand").val();

        const validBrands = ['Nike', 'Jordan', 'Converse', 'Adidas'];

        if (!brand || !validBrands.includes(brand)) {
            $( "#form-brand").removeClass('valid');
            mistakes["BrandNotValid"]= 'La marca debe ser Nike, Jordan, Converse, o Adidas.';
        }else{
            $( "#form-brand").addClass('valid');
            delete mistakes["BrandNotValid"];
        }
        listMistakes();
    });

    // FIN VALIDACION AL INSTANTE 

    

    

    $('#product-form').submit(function(e) { 
        e.preventDefault();

        let img=document.getElementById('form-img').value;
        (img!== "") ? (img="img/imagen.png") : ('img/'+img+'.png');

        const json = {};
        json['nombre'] = document.getElementById('form-name').value;
        json['marca'] = document.getElementById('form-brand').value;
        json['modelo'] = document.getElementById('form-model').value;
        json['precio'] = document.getElementById('form-price').value;
        json['detalles'] = document.getElementById('form-features').value;
        json['unidades'] = document.getElementById('form-unit').value;
        json['imagen'] = img;
        json['id'] = document.getElementById('productId').value;

        let finalJSON = {};

    
        // Ejecutar validación
        if (validar(json)) {
            document.getElementById("product-result").className = "card my-4 d-block";
            return; // Si hay errores, detener el proceso
        }else{
            finalJSON= JSON.stringify(json);
            console.log(json);
        }
    
        // Si no hay errores, proceder con el envío
        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
    
        $.ajax({
            url: url,
            type: 'POST',
            contentType: 'application/json',
            data: finalJSON,
    
            success: function(response) {
                const respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
    
                document.getElementById("product-result").className = "card my-4 d-block";
                document.getElementById("container").innerHTML = template_bar;
    
                listadoProductos();
                //init();
                edit = false;
                $('#submit-button').text('Agregar Producto');
                $('#form-name').val('');
            }
        });
    });
    

    $(document).on('click', '.product-delete', function() {
        if( confirm("Eliminar este producto") ) {
            let id = event.target.parentElement.parentElement.getAttribute("productId");
            $.ajax({
                url: './backend/product-delete.php?id='+id,
                type: 'GET',
                data: {id},

                success: function(response){
                    let respuesta = JSON.parse(response);
                    let template_bar = '';
                    template_bar += `
                                <li style="list-style: none;">status: ${respuesta.status}</li>
                                <li style="list-style: none;">message: ${respuesta.message}</li>
                            `;
                    document.getElementById("product-result").className = "card my-4 d-block";
                    document.getElementById("container").innerHTML = template_bar;

                    listadoProductos();
                }
            });
        }
    });

    $(document).on('click', '.product-item', function() {
        let id = $(this)[0].parentElement.parentElement.getAttribute('productid');
        $.post('./backend/product-single.php', {id}, function(response){
            const product = JSON.parse(response);
            $('#form-name').val(product[0].nombre);
            $('#productId').val(product[0].id);
            let productWithoutNameAndId = {...product[0]};
            delete productWithoutNameAndId.nombre;
            delete productWithoutNameAndId.id;
            delete productWithoutNameAndId.eliminado;

            $('#description').val(JSON.stringify(productWithoutNameAndId, null, 4));
            edit = true;

            $('#submit-button').text('Editar Producto');

        })
    });
});

function validar(objeto) { 
    let error = "";
    console.log(objeto);
    document.getElementById('container').innerHTML = "";

    // Validación del nombre
    if (!objeto.nombre || objeto.nombre.length > 100) {
        error += '<p>El nombre sobrepasa el límite de 100 caracteres o está vacío</p>';  
    }

    // Validación del modelo
    if (!objeto.modelo || objeto.modelo.length > 25) {
        error += '<p>El modelo sobrepasa el límite de 25 caracteres o está vacío</p>'; 
    } else if (!(/\d/.test(objeto.modelo))) {
        error += '<p>El modelo debe contener al menos un número</p>';
    }

    // Validación de detalles
    if (objeto.detalles && objeto.detalles.length > 300) {
        error += '<p>Los detalles sobrepasan el límite de 300 caracteres</p>';
    }

    // Validación del precio
    if (isNaN(objeto.precio) || parseFloat(objeto.precio) < 99.99) {
        error += '<p>El precio debe ser un número y estar por encima de 99.99</p>';
    }

    // Validación de unidades
    if (isNaN(objeto.unidades) || parseInt(objeto.unidades) < 0) {
        error += '<p>Las unidades deben ser un número mayor o igual a 0</p>';
    }

    // Validación de marca
    const marcasValidas = ['Nike', 'Jordan', 'Converse', 'Adidas'];
    if (!objeto.marca || !marcasValidas.includes(objeto.marca)) {
        error += '<p>La marca debe ser Nike, Jordan, Converse, o Adidas.</p>';
    }

    document.getElementById('container').innerHTML = error !== "" ? error : ""; 
    return error !== "";
}