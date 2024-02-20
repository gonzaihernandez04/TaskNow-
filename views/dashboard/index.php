<?php include_once __DIR__ . '/header-dashboard.php';?>

    <div class="proyectos">
    <?php if(count($proyectos) === 0){?>
        <p class="no-proyectos alerta aviso">No hay proyectos aun <a href="/crear-proyecto">Comienza creando uno</a></p>
    <?php } else{ ?>
        
        <ul class="listado-proyectos">
                
            <?php foreach($proyectos as $proyecto){?>
                <li class="proyecto <?php echo $proyecto->urlProyecto;?>" >
                    <a href="/proyecto?urlProyecto=<?php echo $proyecto->urlProyecto;?>">
                        <?php echo $proyecto->nombre;?>
                    </a>
                </li>

            <?php  } ?>

        </ul>

    <?php  } ?>

    </div>

<?php include_once __DIR__ . '/../templates/papelera.php';?>

<?php include_once __DIR__ . '/footer-dashboard.php';?>
<?php $script = "<script src='/build/js/app.js'></script>"?>