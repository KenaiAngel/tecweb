<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
    </style>
    <title>Formulario</title>
</head>
<body>
    <h1>Datos Personales</h1>

   <!-- <form id="miFormulario" onsubmit="" method="post">
        <fieldset>
            <legend>Actualiza los datos personales de esta persoa:</legend>
            <ul>
                <li><label>Nombre:</label> <input type="text" name="name" value=" !empty($_POST['nombre'])?$_POST['nombre']:$_GET['nombre'] "></li>
                <li><label>Edad:</label> <input type="text" name="age" value=" !empty($_POST['edad'])?$_POST['edad']:$_GET['edad'] ?>"></li>
            </ul>
        </fieldset>
        <p>
            <input type="submit" value="ENVIAR">
        </p>
    </form>-->

    
    <form id="miFormulario"  action="update_producto.php" method="post">
        <div>

            <div>
                <label for="form-id">Id:</label> 
                <input type="text" name="id" id="form-id"
                 value="<?= !empty($_POST['id'])?$_POST['id']:$_GET['id'] ?>"
                 readonly
                >
            </div>

            <div>
                <label for="form-name">Nombre:</label> 
                <input type="text" name="name" id="form-name"
                 value="<?= !empty($_POST['name'])?$_POST['name']:$_GET['name'] ?>"
                >
                
                <div id="error_name"></div> 
            </div>

            <div>
                <label for="form-marca">Marca:</label>
                <select name="brand" id="form-brand">
                    <optgroup label="Nike Brand">
                        <option value="Nike" <?= (!empty($_POST['brand']) && $_POST['brand'] == 'Nike') || (!empty($_GET['brand']) && $_GET['brand'] == 'Nike') ? 'selected' : '' ?>>Nike</option>
                        <option value="Jordan" <?= (!empty($_POST['brand']) && $_POST['brand'] == 'Jordan') || (!empty($_GET['brand']) && $_GET['brand'] == 'Jordan') ? 'selected' : '' ?>>Jordan</option>
                        <option value="Converse" <?= (!empty($_POST['brand']) && $_POST['brand'] == 'Converse') || (!empty($_GET['brand']) && $_GET['brand'] == 'Converse') ? 'selected' : '' ?>>Converse</option>
                    </optgroup>
                    <optgroup label="Adidas Brand">
                        <option value="Adidas" <?= (!empty($_POST['brand']) && $_POST['brand'] == 'Adidas') || (!empty($_GET['brand']) && $_GET['brand'] == 'Adidas') ? 'selected' : '' ?>>Adidas</option>
                    </optgroup>
                </select>
                <div id="error_marca"></div> 
            </div>

            <div>
                <label for="form-model">Modelo:</label>
                <input type="text" name="model" id="form-model"
                    value="<?= !empty($_POST['model'])?$_POST['model']:$_GET['model'] ?>"
                >

                <div id="error_model"></div> 
                
            </div>

            <div>
                <div id="error-price"><p>Obligatorio</p></div> 
                <label for="form-price">Precio:</label> 
                <input type="number" id="form-price" name="price" min="99.99"  max="10000" step="0.01"
                    value="<?= !empty($_POST['price'])?$_POST['price']:$_GET['price'] ?>"
                >   
                
            </div>

            <div>
                <label for="form-features">Detalles:</label>
                <br>
                <textarea name="features" rows="4" cols="60" id="form-features" placeholder="No más de 300 caracteres de longitud">
                    <?= !empty($_POST['features'])?$_POST['features']:$_GET['features'] ?>
                </textarea>
                <div id="error_features"></div>
            </div>

            <div>
                <div id="error-unit"><p>Obligatorio</p></div> 
                <label for="form-unit">Unidades:</label> 
                <input type="number" id="form-unit" 
                    name="units" min="0" 
                    max="10000" step="1" 
                    value="<?= !empty($_POST['units'])?$_POST['units']:$_GET['units'] ?>"
                > 
                <div id="error_unit"></div>  
            </div>
            

            <div>
                <label for="form-img">Nombre de la imagen:</label> 
                <input type="text" name="img" id="form-img"
                value="<?= !empty($_POST['image'])?$_POST['image']:$_GET['image'] ?>"
                >
            </div>

            <div>
                <label for="form-status">Estado:</label> 
                <select name="status" id="form-status">
                    
                    <option value="Activo" <?= (!empty($_POST['status']) && $_POST['status'] == 'Activo') || (!empty($_GET['status']) && $_GET['status'] == 'Activo') ? 'selected' : '' ?>>Activo</option>
                    <option value="Inactivo" <?= (!empty($_POST['status']) && $_POST['status'] == 'Inactivo') || (!empty($_GET['status']) && $_GET['status'] == 'Inactivo') ? 'selected' : '' ?>>Inactivo</option>

                </select>
            
            </div>
            <!--
            <li><label for="form-img">Imagen:</label>
            <input type="file" id="form-img" name="img" accept="image/png, image/jpeg" />
            </li>-->
        </div>
        <p>
            <input type="submit" value="ENVIAR">
        </p>
    </form>

    <script src="src/main.js"></script>
</body>
</html>