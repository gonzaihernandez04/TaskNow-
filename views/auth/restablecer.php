<div class="contenedor restablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'?>

    <div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'?>

    <?php if($mostrar){ ?>
    <form  method="post" class="formulario">
        <div class="campo">
            <div class="container-password">
                <label for="pass">Password</label>
                <input type="password" name="pass" id="pass" placeholder="Nueva contraseña">
                <?php include_once __DIR__ . '/../templates/ojopass.php'?>
            </div>
   
        </div>
        <input type="submit" value="Cambiar contraseña">
    </form>
    <?php } ?>
    <div class="acciones">
        <a href="/">Volver a Iniciar Sesion<a>
        <a href="/crear">¿Aun no tienes una cuenta? Obtener una</a>
    </div>

    </div>

   
</div>



<?php 

    $script = "<script src='build/js/eye.js'></script>"
?>