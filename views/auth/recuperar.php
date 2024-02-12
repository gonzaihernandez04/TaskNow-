<section class="contenedor recuperar">

    <?php include_once __DIR__ . '/../templates/nombre-sitio.php';?>

    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php';?>
        <form action="/recuperar" method="POST" class="formulario" novalidate>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" name="email" id="Email" placeholder="Tu email" value="<?php $usuario->email ?? ''?>">
            </div>

            <input type="submit" value="Enviar mail">

        </form>


        <div class="acciones">
            <a href="/">¿Ya recordaste tu contraseña?</a>
            <a href="/crear">¿Aun no tienes una cuenta? Obtener una</a>
        </div>

    </div>



</section>