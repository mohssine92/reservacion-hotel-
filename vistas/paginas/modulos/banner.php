<!--                                                        no olvides que el codigo se esta ejecutando en la linea 24 del index principal 
 -->

<?php
  $banner = ControladorBanner::ctrMostrarBanner();   /* lo que estoy haciendo pido al controlador : traeme los banner *//* aqui tengo una collecion de objeto banner desde la base de datos *//* trae ubicacion de img en disco duro  */
?>                                                   <!-- aqui la vista esta solicitando la informacion al controlador  -->
                                                     <!-- desde aqui hizimos una peticion al controlador  -->


<!--=====================================
BANNER
======================================-->

<div class="banner container-fluid  p-0">
	
	<div class="jd-slider fade-slider">
		
		<div class="slide-inner">
			
			<ul class="slide-area">
            <!--              coleccion  indice   objeto             -->
                <?php foreach ($banner as $key => $value): ?>  <!-- recorremos $banner con foreach de php   -->
                
        				
				 <li>					
                    <img src="<?php echo $servidor.$value["img"]; ?>" width="100%">  <!-- $servidor es path del backend , img es propiedad del objeto:string => roota de img en repositorio backend necesario para cargar img en este plantilla  -->
                </li>                                                                <!-- de esta manera ubico la img en disco duro en funccion de routa que devuelva la base de datos  -->
  
               <?php endforeach ?>

			</ul>

		</div>

	 	<div class="controller d-none"><div class="">
		 </div>
		 	
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
