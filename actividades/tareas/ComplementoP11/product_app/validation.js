let mistakes = {};


$(document).ready(function() {

    function listMistakes (){
        if(Object.keys(myEmptyObj).length !== 0){
            document.getElementById('container').innerHTML = "";
            mistakes.forEach(function(mistake) {
                document.getElementById('container').innerHTML += `<p>${mistake}</p>`;
            });
        }
        
    }
    

    $("#form-name").keyup(function(e) {
        e.preventDefault();

        const name = document.getElementById('form-name').value;

        if (!name || name.length > 100) {
            fieldsKeyUp.name=false;
            mistakes["NullNameOrExcess"] = 'El nombre sobrepasa el límite de 100 caracteres o está vacío';  
        }
        else{
            fieldsKeyUp.name=true;
            delete mistakes["NullNameOrExcess"];
           
        }

        listMistakes();

    });

    $("#form-model").keyup(function(e) {
        e.preventDefault();

        const model = document.getElementById('form-model').value;

        if (!model|| model.length > 25) {
            mistakes["NullModelOrExcess"] = 'El modelo sobrepasa el límite de 25 caracteres o está vacío'; 
        }else{
            
            delete mistakes["NullModelOrExcess"];
        }
        
        if (!(/\d/.test(model))) {
            
            mistakes["ModelNeedsNumber"] = 'El modelo debe contener al menos un número';
        }else{
            
            delete mistakes["ModelNeedsNumber"]
        }
        listMistakes();

    });

    $('#form-features').keyup(function(e){
        e.preventDefault();

        const features = document.getElementById('form-features').value;

        if (features && features.length > 300) {
            mistakes["FeaturesExcess"] = 'Los detalles sobrepasan el límite de 300 caracteres';
        }else{
            
            delete mistakes["FeaturesExcess"]
        }
        listMistakes();
    });


    $('#form-price').keyup(function(e){
        e.preventDefault();

        const price = document.getElementById('form-price').value;

        if (isNaN(price) || parseFloat(price) < 99.99) {
            mistakes["PriceNaNorLower"]= 'El precio debe ser un número y estar por encima de 99.99';
        }else{
            
            delete mistakes["PriceNaNorLower"];s
        }
        listMistakes();
    });

    $('#form-unit').keyup(function(e){
        e.preventDefault();

        const unit = document.getElementById('form-unit').value;

        if (isNaN(unit) || parseInt(unit) < 0) {
            mistakes["UnitNaNorLower"] = 'Las unidades deben ser un número mayor o igual a 0';
        }else{
            
            delete mistakes["UnitNaNorLower"];
        }
        listMistakes();
    });

    $('#form-brand').keyup(function(e){
        e.preventDefault();

        const brand = document.getElementById('form-brand').value;

        const validBrands = ['Nike', 'Jordan', 'Converse', 'Adidas'];

        if (!brand || !validBrands.includes(brand)) {
            mistakes["BrandNotValid"]= 'La marca debe ser Nike, Jordan, Converse, o Adidas.';
        }else{
            
            delete mistakes["BrandNotValid"];
        }
        listMistakes();
    });

    let img=document.getElementById('form-img').value;
    (img!== "") ? (img="img/imagen.png") : ('img/'+img+'.png');


});
  