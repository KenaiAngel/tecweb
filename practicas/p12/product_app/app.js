// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

$(document).ready(function(){
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    console.log("Search");
                    console.log(response);
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();
        
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        let postData = JSON.parse( $('#description').val() );
         // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
        let template_bar = '';
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
        postData['nombre'] = $('#name').val();
        postData['id'] = $('#productId').val();

        const posiblesErrores = validar(postData);

        if(posiblesErrores.length!=0){
            console.log('Posibles Errores'+posiblesErrores);
            template_bar += "<p>"+posiblesErrores+"</p>";
            // SE REINICIA EL FORMULARIO
            $('#name').val('');
            $('#description').val(JsonString);
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
        }
        else{
            const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
            $.post(url, postData, (response) => {
                console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                let respuesta = JSON.parse(response);
            
            
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;
                // SE REINICIA EL FORMULARIO
                $('#name').val('');
                $('#description').val(JsonString);
                // SE HACE VISIBLE LA BARRA DE ESTADO
                $('#product-result').show();
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                $('#container').html(template_bar);
                // SE LISTAN TODOS LOS PRODUCTOS
                listarProductos();
                // SE REGRESA LA BANDERA DE EDICIÓN A false
                edit = false;
            });

        }     
    });

    function validar(objeto) {
        console.log(objeto.nombre);
    
        let error = "";
        //let hayError = false;
    
        // Validación del nombre
        if ((objeto.nombre.length > 100) || (objeto.nombre.length === 0)) {
            error += '<li>El nombre sobrepasa el límite de 100 caracteres, o esta vacio</li>';  
        }
    
        // Validación del modelo
        if ((objeto.modelo.length > 25) || (objeto.modelo.length === 0)) {
            error += '<li>El modelo sobrepasa el límite de 25 caracteres</li>'; 
        } else if (!(/\d/.test(objeto.modelo))) {
            error += '<li>El modelo debe contener al menos un número</li>';
        }
    
        // Validación de detalles
        if (objeto.detalles.length > 300) {
            error += '<li>Los detalles sobrepasan el límite de 300 caracteres</li>';
        }
    
        // Validación del precio
        if (isNaN(objeto.precio) || parseFloat(objeto.precio) < 99.99) {
            error += '<li>El precio debe ser un número y estar por encima de 99.99</li>';
        }
    
        // Validación de unidades
        if (isNaN(objeto.unidades) || parseInt(objeto.unidades) <= 0) {
            error += '<li>Las unidades deben ser un número mayor o igual a 0</li>';
        }
        console.log("mARCA"+objeto.marca);
        if ((objeto.marca != 'Nike') && (objeto.marca != 'Jordan') && (objeto.marca != 'Converse') && (objeto.marca != 'Adidas')) {
            error += '<li>La marca debe ser o Nike, o Jordan, o Converse, o Adidas.</li>';
        }
        return error;
    }

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $('#product-result').hide();
            $.post('./backend/product-delete.php', {id}, (response) => {
                //
                console.log("Delete");
                console.log(response);
                let respuesta = JSON.parse(response);
                // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
                let template_bar = '';
                template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;
                // SE REINICIA EL FORMULARIO
                $('#name').val('');
                $('#description').val(JsonString);
                // SE HACE VISIBLE LA BARRA DE ESTADO
                $('#product-result').show();
                // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                $('#container').html(template_bar);
                // SE LISTAN TODOS LOS PRODUCTOS
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            // SE ELIMINA nombre, eliminado E id PARA PODER MOSTRAR EL JSON EN EL <textarea>
            delete(product.nombre);
            delete(product.eliminado);
            delete(product.id);
            // SE CONVIERTE EL OBJETO JSON EN STRING
            let JsonString = JSON.stringify(product,null,2);
            // SE MUESTRA STRING EN EL <textarea>
            $('#description').val(JsonString);
            
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });    
    
   
});