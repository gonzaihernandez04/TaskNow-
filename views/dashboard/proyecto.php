<?php include_once __DIR__ . '/header-dashboard.php';?>

    <div class="contenedor-sm">
        <div class="contenedor-nueva-tarea">
            <button type="button" class="agregar-tarea" id="agregar-tarea">&#43; Nueva tarea</button>
        </div>

        <div class="filtros">
        <p>Filtros</p>
            <form  method="post">
                <div class="campo">
                    <label for="filtro">Todas </label>
                    <input type="radio" name="filtro" id="filtro" value="" checked/>
                </div>

                <div class="campo">
                <label for="filtro">Completadas    </label>
                    <input type="radio" name="filtro" id="filtro" value="1"/>
            
                </div>

                <div class="campo">
                <label for="filtro">Pendientes </label>
                    <input type="radio" name="filtro" id="filtro" value="0"/>
                </div>
            </form>
        </div>

        <ul id="listado-tareas" class="listado-tareas">
            
        </ul>

      
    </div>


<?php include_once __DIR__ . '/footer-dashboard.php';?>
<?php $script = "<script src='/build/js/tareas.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

"

?>