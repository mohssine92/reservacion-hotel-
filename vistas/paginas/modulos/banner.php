<?php

$banner = ControladorBanner::ctrMostrarBanner();    /* no olvides que el codigo se esta ejecutando en la linea 24 del index principal */

?>

<!--=====================================
BANNER
======================================-->

<div class="banner container-fluid  p-0">
	
	<div class="jd-slider fade-slider">
		
		<div class="slide-inner">
			
			<ul class="slide-area">

                <?php foreach ($banner as $key => $value): ?>  <!-- $banner es colleccion y $key indice de objetos $value objetos  -->
                
        				
				 <li>					
                    <img src="<?php echo $servidor.$value["img"]; ?>" width="100%">   <!-- $servido es path del backend , en indice 0 en el objeto value selecciono la propiedad img del objetos asi vamos recorriendo toda collecion   -->
                </li>                                                                  <!-- de esta manera ubico la img en dico duro en funccion de routa que devuelva la base de datos  -->
  

               <?php endforeach ?>

			</ul>

		</div>

	 	<div class="controller d-none">
		 	
			<a class="auto" href="#">

                <i class="fas fa-play fa-xs"></i>
                <i class="fas fa-pause fa-xs"></i>

            </a>

            <div class="indicate-area"></div>

	 	</div>

	 	<div class="verMas text-center bg-white rounded-circle d-none d-lg-block" vinculo="#planes">
    
    	 	<i class="fas fa-chevron-down"></i>	

    	</div>

	</div>

</div>
