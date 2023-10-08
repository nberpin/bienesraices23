<?php 
    $resultado=$_GET['resultado'];
    require '../includes/funciones.php';
    incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Administrador</h1>
    <?php if (intval($resultado)===1){ ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
    <?php } ?>
    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
    
</main>

<?php 
    incluirTemplate('footer');
?>
