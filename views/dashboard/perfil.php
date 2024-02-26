<?php include_once __DIR__ . '/header-dashboard.php';?>
<div class="perfil">


    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php';?>
        <form action="/perfil" method="POST" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Coloca el nombre deseado" value="<?php echo $nombre;?>" name="nombre">
            </div>

            <div class="campo">
                <label for="nombre">Email</label>
                <input type="email" placeholder="Coloca el email deseado" value="<?php echo $email?>" name="email">
            </div>

            <div class="acciones">
                <input type="submit" value="Guardar cambios">
                <a href="/cambiar-password">Cambiar contraseña</a>
            </div>
          
        </form>
    </div>

</div>
<?php include_once __DIR__ . '/footer-dashboard.php';?>