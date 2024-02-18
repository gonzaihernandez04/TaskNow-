<?php include_once __DIR__ . '/header-dashboard.php';?>

<div class="contenedor-sm">
    <?php if(count($proyectos) === 0){?>
        <p class="no-proyectos">No hay proyectos aun <a href="/crear-proyecto">Comienza creando uno</a></p>
    <?php } else{ ?>
        
        <ul class="listado-proyectos">
                
            <?php foreach($proyectos as $proyecto){?>
                <li class="proyecto">
                    <a href="/proyecto?urlProyecto=<?php echo $proyecto->urlProyecto;?>">
                        <?php echo $proyecto->nombre;?>
                    </a>
                </li>

            <?php  } ?>

        </ul>

    <?php  } ?>


</div>


<?php include_once __DIR__ . '/footer-dashboard.php';?>
