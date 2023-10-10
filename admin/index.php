<?php 
    $resultado=$_GET['resultado']??null;
    require '../includes/funciones.php';
    incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Administrador</h1>
    <?php if (intval($resultado)===1){ ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php } ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <a class="boton-rojo-block" href="#">Eliminar</a>
                    <a class="boton-verde-block" href="#">Actualizar</a>
                </td>
            </tr>
        </tbody>

    </table>
    
</main>

<?php 
    incluirTemplate('footer');
?>
