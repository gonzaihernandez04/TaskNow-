<main class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php'; ?>

    <div class="contenedor-md">
        <p class="descripcion-pagina">Crear cuenta</p>

        <form action="" method="post" class="formulario">
        

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Tu nombre">
            </div>

            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu Email">
            </div>

            <div class="campo">
                <label for="pass">Contraseña</label>
                <input type="pass" name="pass" id="pass" placeholder="Tu Contraseña">
            </div>

            <div class="campo">
                <label for="pass2">Repetir Contraseña</label>
                <input type="pass" name="pass2" id="pass2" placeholder="Repita la constraseña">
            </div>

            <input type="submit" value="Iniciar Sesion" class="boton">
        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia sesion</a>
            <a href="/recuperar">¿Olvidaste tu password?</a>
        </div>

    </div>

</main>