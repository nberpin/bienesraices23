<?php 
//Base de datos
require '../../includes/config/database.php';
$db= conectarDB();
//consultar para obtener a los vendedores
$consulta="SELECT * FROM vendedores";
$resultado=mysqli_query($db,$consulta);

//controlando los mensajes de error en la validación del formulario
$errores=[];
//inicializando variables para guardar en el formulario
$titulo= '';
$precio= '';
$descripcion= '';
$habitaciones= '';
$wc= '';
$estacionamiento='';

$vendedores_id= '';
if ($_SERVER['REQUEST_METHOD']==='POST'){

    // $numero="1HOLA";
    // $numero2=1;
    // $resultado=filter_var($numero, FILTER_SANITIZE_NUMBER_INT);
    // $resultado=filter_var($numero, FILTER_VALIDATE_INT);
    // var_dump($resultado);
    // exit;
    
    
    //     echo "<pre>";
    //     var_dump($_SERVER);
    //     var_dump($_POST);
    //     var_dump($_POST);
    //     echo "</pre>";

    //sanitizamos nuestros datos
    $titulo=mysqli_real_escape_string($db, $_POST['titulo']);
    $precio=mysqli_real_escape_string($db,$_POST['precio']);
    $descripcion=mysqli_real_escape_string($db,$_POST['descripcion']);
    $habitaciones= mysqli_real_escape_string($db,$_POST['habitaciones']);
    $wc=mysqli_real_escape_string($db,$_POST['wc']);
    $estacionamiento=mysqli_real_escape_string($db,$_POST['estacionamiento']);
    $vendedores_id=mysqli_real_escape_string($db,$_POST['vendedores_id']);
    $creado=date('Y/m/d');
   
    //Asignar files hacia una variable
    $imagen=$_FILES['imagen'];
     //     echo "<pre>";
    //     var_dump($_SERVER);
    //     var_dump($_POST);
    //     var_dump($_POST);
    //      var_dump($imagen['name]);
    //     echo "</pre>";
    //     exit;

 //comprobamos los datos
    if (!$titulo) {
        $errores[]="Debes añadir un título";
    }
    if (!$precio) {
        $errores[]="Debes añadir un precio";
    }
    if (strlen($descripcion)<50) {
        $errores[]="La descripción es obligatoria y debe tener al menos 50 caracteres";
    }
    if (!$habitaciones) {
        $errores[]="Debes añadir el número de habitaciones";
    }
    if (!$wc) {
        $errores[]="Debes añadir el número de baños";
    }
    if (!$estacionamiento) {
        $errores[]="Debes añadir el número de estacionamientos";
    }
    if (!$vendedores_id) {
        $errores[]="Elige un vendedor";
    }
    if (!$imagen['name']) {
        $errores[]="La imagen es obligatoria";
    }

    //validar la imagen por tamaño
    //medida máxima en kb
    $medida=1024;
    if (($imagen['size']/1024)>$medida){
        $errores[]="Reduzca el tamaño de la imagen, debe ser menor a". $medida."Kb.";
    }
    // echo "<pre>";
    //     var_dump($errores);
    //     echo "</pre>";
    
    //     exit;
    //ahora es donde realmente insertamos los valores en la bd
    //solo se introduce el campo si el array de errores está vacío
    
    if(empty($errores)){
        /**SUBIDA DE ARCHIVOS */

        //creamos la carpeta imágenes en la raíz del proyecto si es que no existe
        $carpetaImagenes='../../imagenes/';

        if (!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }
        //Generar nombre único
        $nombreImagen=md5(uniqid(rand(),true)).".jpg";
        // echo $nombreImagen;
        // exit;

        //subir archivo
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        $query="INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones,wc,estacionamiento, creado,  vendedores_id)   
        VALUES ('$titulo', '$precio', '$nombreImagen','$descripcion', '$habitaciones','$wc','$estacionamiento','$creado', '$vendedores_id')";
       //echo $query;
       $resultado=mysqli_query($db,$query);
       if ($resultado) {
           header('Location:/admin?resultado=1');
       }

    }
  
}

    require '../../includes/funciones.php';
    incluirTemplate('header');
    
  
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <?php foreach($errores as $error){ ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php } ?>
    <a href="/admin/" class="boton boton-verde">Volver</a>
    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        <fieldset>
            <legend> Información General</legend>

            <label for="titulo">Título: </label>
            <input type="text" id="titulo" name="titulo" placeholder="Título propiedad" value="<?php echo $titulo;  ?>">
            
            <label for="precio">Precio: </label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad" value="<?php echo $precio;  ?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for=" descripcion"> Descripción: </label>
            <textarea id="descripcion" name="descripcion" cols="30" rows="10"><?php echo $descripcion;  ?></textarea>

        </fieldset>
        <fieldset>
            <legend> Información de la propiedad</legend>

            <label for="habitaciones">Habitaciones: </label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej.3" value="<?php echo $habitaciones;  ?>">

            <label for="wc">Baños: </label>
            <input type="number" id="wc" name="wc" placeholder="Ej.1"value="<?php echo $wc;  ?>">

            <label for="estacionamiento">Estacionamiento: </label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej.1" value="<?php echo $estacionamiento;  ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedores_id">
                <option value="">--Seleccione--</option>
                <?php while ($vendedor=mysqli_fetch_assoc($resultado)){?>
                    <option <?php echo $vendedores_id===$vendedor['id']?'selected':''; ?> value="<?php echo $vendedor['id'];?>">
                        <?php echo $vendedor['nombre']. " ".$vendedor['apellidos'];  ?>
                    </option>
                <?php } ?>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
    incluirTemplate('footer');
?>
