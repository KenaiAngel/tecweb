
document.getElementById("form-name").addEventListener("input", () => {
    
    let name = document.getElementById("form-name").value;

    if (name.length > 100) {
        document.getElementById('error_name').innerHTML = 
            '<p>El nombre sobrepasa el límite de 100 caracteres</p>'
        ;
    } else {
        document.getElementById('error_name').innerHTML = ''; 
    }
});



document.getElementById("form-model").addEventListener("input", () => {
    
    let model = document.getElementById("form-model").value;

    // Expresión regular para verificar si contiene algún número
    let isThereANumber = /\d/.test(model);

    if (model.length > 25) {
        document.getElementById('error_model').innerHTML = 
            '<p>El nombre sobrepasa el límite de 25 caracteres</p>'
        ;
    } 
    else if(!isThereANumber){
        document.getElementById('error_model').innerHTML = 
            '<p>Debe contener almenos un número</p>'
        ;
    }
    else {
        document.getElementById('error_model').innerHTML = ''; 
    }
});


document.getElementById("form-features").addEventListener("input",()=>{
    let features = document.getElementById("form-features").value;

    if (features.length > 300) {
        document.getElementById('error_features').innerHTML = 
            '<p>El nombre sobrepasa el límite de 300 caracteres</p>'
        ;
    } else {
        document.getElementById('error_features').innerHTML = ''; 
    }
});



document.getElementById("form-price").addEventListener("input", () => {
    let price = parseFloat(document.getElementById("form-price").value); 

    if (price < 99.99) {
        document.getElementById('error-price').innerHTML = 
            '<p>El precio debe estar por encima de 99.99</p>';
    } else {
        document.getElementById('error-price').innerHTML = ''; 
    }
}); 

document.getElementById("form-unit").addEventListener("input", () => {
    let unit = parseFloat(document.getElementById("form-unit").value); 

    if (unit < 0) {
        document.getElementById('error-unit').innerHTML = 
            '<p>Las unidades deben ser mayores o iguales a 0</p>';
    } else {
        document.getElementById('error-unit').innerHTML = ''; 
    }
}); 





function validar(){
    let name = document.getElementById("form-name").value;

    if (name.length > 100) {
        document.getElementById('error_name').innerHTML = 
            '<p>El nombre sobrepasa el límite de 100 caracteres</p>'
        ;
    } else {
        document.getElementById('error_name').innerHTML = ''; 
    }

    let model = document.getElementById("form-model").value;

    // Expresión regular para verificar si contiene algún número
    let isThereANumber = /\d/.test(model);

    if (model.length > 25) {
        document.getElementById('error_model').innerHTML = 
            '<p>El nombre sobrepasa el límite de 25 caracteres</p>'
        ;
    } 
    else if(!isThereANumber){
        document.getElementById('error_model').innerHTML = 
            '<p>Debe contener almenos un número</p>'
        ;
    }
    else {
        document.getElementById('error_model').innerHTML = ''; 
    }



}