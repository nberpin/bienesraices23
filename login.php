<?php
require './includes/config/database.php';
$db=conectarDB();
$errores=[];
//validación del formulario
if($_SERVER['REQUEST_METHOD']==='POST'){

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';
    //sanitizamos datos
    $email=mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password=mysqli_real_escape_string($db, $_POST['password']);
    //comprobamos errores
    if(!$email){
        $errores[]="El email es obligatorio o no es válido";
    }

    if(!$password){
        $errores[]="El password es obligatorio";
    }
//en caso de no haber errores
    if(empty($errores)){
        //revisar si el usuario existe
        $query="SELECT * FROM usuario WHERE  email='${email}'";
        $resultado= mysqli_query($db, $query);
        if ($resultado->num_rows){
            //revisar si el password es correcto
            
        }else{
            $errores="El usuario no existe";
        }

    }
}
//inclusión del encabezado
    require './includes/funciones.php';
    incluirTemplate('header');
    
?>

<main class="contenedor seccion">
    <h1>Iniciar Sesión</h1>
    <?php 
        foreach($errores as $error){ ?>
            <div class="alerta error">
                <?php echo $error;?>
            </div>
    <?php
        }
    ?>

    <form method="POST" class="formulario" >
         <fieldset>
                <legend>Email y Password</legend>

                 <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu Email" id="email" required>

                <label for="telefono">Password</label>
                <input type="password" name="password" placeholder="Password" id="password" required>

               
            </fieldset>
            <input type="submit" value="Iniciar sesión" class="boton boton-verde">

    </form>
</main>

<?php 
   
    incluirTemplate('footer');
    
?>