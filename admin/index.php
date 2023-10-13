<?php 
//importar la conexión
require '../includes/config/database.php';
$db=conectarDB();

if ($_SERVER['REQUEST_METHOD']==='POST'){
        $id=$_POST['id'];
        echo $id;
        $id=filter_var($id, FILTER_VALIDATE_INT);
        if ($id){
            //eliminar la imagen
            $query="SELECT imagen FROM propiedades WHERE id=${id}";
            $resultado= mysqli_query($db,$query);
            $propiedad=mysqli_fetch_assoc($resultado);
            unlink('../imagenes/'.$propiedad['imagen']);
  
            //eliminar la propiedad
            $query="DELETE FROM propiedades  WHERE id=${id}";
            $resultado=mysqli_query($db,$query);
            if ($resultado){
                header('location: /admin?resultado=3');
            }
        }

}
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
    <?php } elseif (intval($resultado)===2) {?>
        <p class="alerta exito">Anuncio actualizado correctamente</p>
    <?php } elseif (intval($resultado)===3) {?>
        <p class="alerta exito">Anuncio eliminado correctamente</p>
    <?php }?>
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
                    <form method="post">
                        <input type="hidden" name="id" value=<?php echo $propiedad['id'];?>>
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
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
