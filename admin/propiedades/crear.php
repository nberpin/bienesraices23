<?php 
//Base de datos
    require '../../includes/config/database.php';
    $db= conectarDB();
    if ($_SERVER['REQUEST_METHOD']==='POST'){
        
        echo "<pre>";
        var_dump($_SERVER);
        echo "</pre>";
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
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for=" descripcion"> Descripción: </label>
            <textarea id="descripcion" name="descripcion" cols="30" rows="10"></textarea>

        </fieldset>
        <fieldset>
            <legend> Información de la propiedad</legend>

            <label for="habitaciones">Título: </label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej.3">

            <label for="wc">Baños: </label>
            <input type="number" id="wc" name="wc" placeholder="Ej.1">

            <label for="estacionamiento">Baños: </label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej.1">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select >
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
