<div class="contenedor restablecer">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'?>

    <div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'?>

    <?php if($mostrar){ ?>
    <form  method="post" class="formulario">
        <div class="campo">
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" placeholder="Nueva contraseña">
        </div>
        <input type="submit" value="Cambiar contraseña">
    </form>
    <?php } ?>
    <div class="acciones">
        <a href="/">¿Ya recordaste tu contraseña?</a>
        <a href="/crear">¿Aun no tienes una cuenta? Obtener una</a>
    </div>

    </div>

   
</div>