<?php include_once __DIR__ . '/header-dashboard.php'; ?>


<div class="contenedor-sm">
     <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

     <form class="formulario" method="POST" action="cambiar-password">


          <div class="campo">
               <label for="passwordActual">Contraseña actual</label>
               <input type="password" name="passwordActual" id="passwordActual" placeholder="Escriba su contraseña actual para validar que es usted">
          </div>

          <div class="campo">
               <div class="container-password">
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" id="pass" placeholder="Nueva contraseña">
                    <?php include_once __DIR__ . '/../templates/ojopass.php'?>

               </div>
          </div>

          <div class="campo">
               <div class="container-password">
                    <label for="pass2">Repetir contraseña</label>
                    <input type="password" name="pass2" id="pass" placeholder="Repita la misma contraseña">
               </div>

          </div>



          <div class="acciones">
               <input type="submit" value="Cambiar contraseña">
               <a href="/perfil">Volver al perfil</a>
          </div>


     </form>
</div>




<?php include_once __DIR__ . '/footer-dashboard.php'; ?>
<?php 

    $script = "<script src='build/js/eye.js'></script>"
?>