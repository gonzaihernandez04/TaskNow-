<main class="contenedor index">
  <?php include_once __DIR__ . '/../templates/nombre-sitio.php';
  ?>


    <div class="contenedor-md">
        <p class="descripcion-pagina">Iniciar Sesion</p>
        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <form action="" method="post" class="formulario">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email" value="<?php echo $authUsuario->email ?? ''?>">
            </div>

            <div class="campo">
                <label for="pass">Contraseña</label>
                <div class="container-password">
                  <input type="password" name="pass" id="pass" placeholder="Tu contraseña">
                  <?php include_once __DIR__ . '/../templates/ojopass.php'?>
                </div>

            </div>

            <input type="submit" value="Iniciar Sesion" class="boton">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aun no tienes una cuenta? Obtener una</a>
            <a href="/recuperar">¿Olvidaste tu password?</a>
        </div>

    </div>

</main>

<?php 

    $script = "<script src='build/js/eye.js'></script>"
?>