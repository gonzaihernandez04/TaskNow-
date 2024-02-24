<div class="campo">
    <label for="nombre">Nombre del proyecto</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre del proyecto" value="<?php echo $proyecto->nombre?>">
</div>

<div class="campo">
    <label for="descripcion">Descripcion del proyecto</label>
    <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Escriba la descripcion del proyecto" value="<?php echo $proyecto->descripcion?>"></textarea>

    <?php include_once __DIR__ . '/../templates/contador.php';?>
    
</div>



<?php $script="<script src='/build/js/contador.js'></script>"?>