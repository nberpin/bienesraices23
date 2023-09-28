<?php 
    require '../../includes/funciones.php';
    incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin/" class="boton boton-verde">Volver</a>
    <form class="formulario" action="">
        <fieldset>
            <legend> Información General</legend>

            <label for="titulo">Título: </label>
            <input type="text" id="titulo" placeholder="Título propiedad">
            
            <label for="precio">Precio: </label>
            <input type="number" id="precio" placeholder="Precio propiedad">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for=" descripcion"> Descripción: </label>
            <textarea id="descripcion" cols="30" rows="10"></textarea>

        </fieldset>
        <fieldset>
            <legend> Información de la propiedad</legend>

            <label for="habitaciones">Título: </label>
            <input type="number" id="habitaciones"  placeholder="Ej.3">

            <label for="wc">Baños: </label>
            <input type="number" id="wc" placeholder="Ej.1">

            <label for="estacionamiento">Baños: </label>
            <input type="number" id="estacionamiento" placeholder="Ej.1">

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
