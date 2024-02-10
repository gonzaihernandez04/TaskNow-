<div class="alertas">
  
        <?php 
            if(isset($alertas)){
            foreach($alertas as $key =>$alerta){
                foreach($alerta as $mensaje){?>
                      <div class="alerta <?php echo $key?>">
                        <?php echo $mensaje;?>
                      </div>
                    
         <?php       }
            }
        }
          ?>
       



</div>