/*------------------------Enviar Formulario----------------------*/
    $(document).ready(function(){
        $('#product-form').submit(function(e){
            e.preventDefault();
            
            $('#msnombre').html('');
            $('#mscategoria').html('');
            $('#msprecioOrg').html('');
            $('#msprecio').html('');
            $('#detalles').html('');
            $('#msunidades').html('');

            let valid = true;

            let nombre = $('#nombre').val().trim();
            let categoria = $('#categoria').val().trim();
            let precioOriginal = $('#precioOrg').val().trim();
            let precioFinal = $('#precio').val().trim();
            let detalles = $('#detalles').val().trim();
            let unidades = $('#unidades').val().trim();
            let imagen;
            //let imagen = $('#imagen').val();
            //let idSesion = sessionStorage.idSesion();
            let idSesion = 1;

            //-------------VALIDACIONES-------------
            //NOMBRE
            if(!nombre){
                $('#msnombre').html('El nombre del producto es obligatorio');
                valid = false;
            }else if(nombre.length > 100){
                $('#msnombre').html('Nombre muy largo');
                valid = false;
            }
            //CATEGORIA
            if(!categoria){
                $('#mscategoria').html('Categoria Obligatoria');
                valid = false;
            }
            //PRECIO ORIGINAL
            if(!precioOriginal || parseFloat(precioOriginal) <= 0){
                $('#msprecioOrg').html('El precio debe ser mayor a 0');
                valid = false;
            }
            //PRECIO
            if(!precioFinal || parseFloat(precioFinal) <= 0){
                $('#msprecio').html('El precio debe ser mayor a 0');
                valid = false;
            }
            //DETALLES
            if(detalles && detalles.length > 250){
                $('#msdetalles').html('Descripcion demasiada larga');
                valid = false;
            }
            //UNIDADES
            if(!unidades || parseInt(unidades) <= 0){
                $('#msunidades').html('Las unidades deben ser mayores a 0');
                valid = false;
            }
            //IMAGEN


            if(valid){
                const datosFormulario = {
                    'nombre': nombre,
                    'categoria': categoria,
                    'cantidad': unidades,
                    'precioOri': precioOriginal,
                    'precioFin': precioFinal,
                    'detalles': detalles,
                    'imagen': imagen,
                    'user_id': idSesion
                };

                let postData = JSON.stringify(datosFormulario);
                console.log(postData);
            
                $.ajax({
                    url: './backend/products-add.php',
                    type: 'POST',
                    data: postData,
                    success: function(response) {
                        console.log(response); 
                        try {
                            const resultado = JSON.parse(response);
                            if (resultado.status === 'success') {
                                alert(resultado.message);
                                console.log(resultado.message);
                                $('#product-form')[0].reset();
                            } else {
                                alert(resultado.status + '', resultado.message);
                                console.log(resultado.status + ':', resultado.message);
                            }
                        } catch (error) {
                            console.error('Error al procesar la respuesta:', error);
                        }
                    }
                });
            }
            

        });
    });