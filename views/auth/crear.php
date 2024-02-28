<main class="contenedor crear">
 
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>

    <div class="contenedor-md">
        <p class="descripcion-pagina">Crear cuenta</p>
        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <form action="/crear" method="post" class="formulario">
        

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre" value="<?php echo $usuario->nombre ?? '';?>">
            </div>

            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email" value="<?php echo $usuario->email ?? '';?>" >
            </div>

            <div class="campo">
                <div class="container-password">
                 <label for="password">Contraseña</label>
                    <input type="password" name="pass" id="pass" placeholder="Tu Contraseña">

                    <?php include_once __DIR__ . '/../templates/ojopass.php'?>

                </div>
         
            </div>

            <div class="campo">
                <div class="container-password">

            
                    <label for="pass2">Repetir Contraseña</label>
                    <input type="password" name="pass2" id="pass2" placeholder="Repita la constraseña">



                </div>
            </div>

            <input type="submit" value="Crear Cuenta" class="boton">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia sesion</a>
            <a href="/recuperar">¿Olvidaste tu password?</a>
        </div>

    </div>

</main>

<?php 

    $script = "<script src='build/js/eye.js'></script>"
?>