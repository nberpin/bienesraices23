<?php 
//Base de datos
    require '../../includes/config/database.php';
    $db= conectarDB();
     if ($_SERVER['REQUEST_METHOD']==='POST'){
        
    //     echo "<pre>";
    //     var_dump($_SERVER);
    //     var_dump($_POST['titulo']);
    //     echo "</pre>";
    $titulo= $_POST['titulo'];
    $precio= $_POST['precio'];
    $descripcion= $_POST['descripcion'];
    $habitaciones= $_POST['habitaciones'];
    $wc= $_POST['wc'];
    $estacionamiento= $_POST['estacionamiento'];
    $vendedores_id= $_POST['vendedor'];
    //ahora es donde realmente insertamos los valores en la bd
    $query="INSERT INTO propiedades (titulo, precio, descripcion, habitaciones,wc,estacionamiento, vendedores_id)   
     VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones','$wc','$estacionamiento', '$vendedores_id')";
    //echo $query;
    $resultado=mysqli_query($db,$query);
    if ($resultado) {
        echo "Insertado correctamente";
    }
}

    require '../../includes/funciones.php';
    incluirTemplate('header');
    
  
?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin/" class="boton boton-verde">Volver</a>
    <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
        <fieldset>
            <legend> Información General</legend>

            <label for="titulo">Título: </label>
            <input type="text" id="titulo" name="titulo" placeholder="Título propiedad">
            
            <label for="precio">Precio: </label>
            <input type="number" id="precio" name="precio" placeholder="Precio propiedad">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for=" descripcion"> Descripción: </label>
            <textarea id="descripcion" name="descripcion" cols="30" rows="10"></textarea>

        </fieldset>
        <fieldset>
            <legend> Información de la propiedad</legend>

            <label for="habitaciones">Habitaciones: </label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej.3">

            <label for="wc">Baños: </label>
            <input type="number" id="wc" name="wc" placeholder="Ej.1">

            <label for="estacionamiento">Estacionamiento: </label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej.1">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="1">Noelia</option>
                <option value="2">Juan</option>
            </select>
        </fieldset>
        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php 
    incluirTemplate('footer');
?>
