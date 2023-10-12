<?php 
//importar la conexión
require '../includes/config/database.php';
$db=conectarDB();
//escribir el query
$query= "SELECT * FROM propiedades";
//consultar la bd
$resultadoConsulta=mysqli_query($db,$query);

//mostrar un mensaje condicional
$resultado=$_GET['resultado']??null;
//incluir template
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
<!-- mostrar los resultados -->
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
            <?php while ($propiedad=mysqli_fetch_assoc($resultadoConsulta)) { ?>
            <tr>
                <td><?php echo $propiedad['id'];?></td>
                <td><?php echo $propiedad['titulo'];?></td>
                <td>
                    <img src="../imagenes/<?php echo $propiedad['imagen'];?>" class="imagen-tabla" >   
                </td>
                <td><?php echo $propiedad['precio'];?></td>
                <td>
                    <a class="boton-rojo-block" href="#">Eliminar</a>
                    <a class="boton-amarillo-block" href="../admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>">Actualizar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>
    
</main>

<?php 

//Cerrar la conexión 
    mysqli_close($db);
    incluirTemplate('footer');
?>
