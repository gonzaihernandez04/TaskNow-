<main class="contenedor index">
  <?php include_once __DIR__ . '/../templates/nombre-sitio.php';
  ?>


    <div class="contenedor-md">
        <p class="descripcion-pagina">Iniciar Sesion</p>

        <form action="" method="post" class="formulario">
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Tu email">
            </div>

            <div class="campo">
                <label for="pass">Contraseña</label>
                <input type="pass" name="pass" id="pass" placeholder="Tu contraseña">
            </div>

            <input type="submit" value="Iniciar Sesion" class="boton">
        </form>

        <div class="acciones">
            <a href="/crear">¿Aun no tienes una cuenta? Obtener una</a>
            <a href="/recuperar">¿Olvidaste tu password?</a>
        </div>

    </div>

</main>