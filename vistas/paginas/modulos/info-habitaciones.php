<!-- este pagina donde muestro  un coche o un habitacion a quien voy a busacar si hay alguna disponible de en esta gategoria seleccionada ,  luego el systema de reserva seguida en este codigo me tiene que devolver solo una de estas que 
estan disponible -->

<?php
     
$valor = $_GET["pagina"];  /* esta variable captura propiedad de ruta de la tabla categorias   */
							 

  $habitaciones = ControladorHabitaciones::ctrMostrarHabitaciones($valor);  /*  nos llega habitaciones agrupadas por categoria */ 
	

/*=============================================
ESCENARIO 2 - 3  DE RESERVAS : en este escenario el usuario solo selecciona categoria : porque categoria tiene mismo habitacion varias veces , las habitacion se clasifican por numeros , enn este caso el systema tiene que detectar que habitacion esta 
                            disponible en este categoria , pues ..... por form de disponiblidad tengo que mandar todos ids de estos habitaciones que pertenecen a la  categoria seleccionada 
                 
=============================================*/
      $arrayHabitaciones = array();   /* iniciamos este variable como array para empujarle varios datos y lo ordena como array con indices  */
     
      foreach ($habitaciones as $key => $value) {
     
      	array_push($arrayHabitaciones, $value["id_h"]);   /* en cada indice empujo solo su id en el array iniciado  */ /* porque a mi solo el id que me interesa */
     
	  }
	  
	 /*  echo '<pre class="bg-white">'; print_r($arrayHabitaciones); echo '</pre>'; */     /* estos son los ids que tengo que inviar por este formulario de ver diponiblidad  */ 
	
	  $nuevoArrayHab = implode("," , $arrayHabitaciones);                           /* pues para poder inviarlos por variable de formulario los convierto en string */
    /*  echo '<pre class="bg-white">'; print_r($nuevoArrayHab); echo '</pre>';  */
?>

<!--=====================================
INFO HABITACIÓN
======================================-->

<div class="infoHabitacion container-fluid bg-white p-0 pb-5">

	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqHabitaciones p-0">
				
				<!--=====================================
				CABECERA HABITACIONES
				======================================-->
				
				<div class="pt-4 cabeceraHabitacion">

					<a href="<?php echo $ruta;  ?>" class="float-left lead text-white pt-1 px-3">
						<h5><i class="fas fa-chevron-left"></i> Regresar</h5>
					</a>

					<h2 class="float-right text-white px-3 categoria text-uppercase "><?php echo $habitaciones[0]["tipo"]; ?></h2>

					<div class="clearfix"></div>

					<ul class="nav nav-justified mt-lg-4">	

					
					<?php foreach ($habitaciones as $key => $value): ?> 

						<li class="nav-item">
                                                                                             
							<a class="nav-link text-white" orden="<?php echo $key; ?>" ruta="<?php echo $_GET["pagina"]; ?>"  href="#">
							 
							   <?php echo $value['estilo']; ?>   <!--listando los estilos de habitaciones disponibles en cada categorias   -->

							</a>                            
						</li>
                           
						
                    <?php endforeach ?>

					</ul>

				</div>

				<!--=====================================
				MULTIMEDIA HABITACIONES
				======================================-->

				<!-- SLIDE  -->

				<section class="jd-slider mb-3 my-lg-3 slideHabitaciones">
		      	       
			        <div class="slide-inner">
			            
			            <ul class="slide-area">

                        <!-- sabemos en la tabla de habitaciones tenemos una columna de galeria trae un array pues vamos hacer al siguiente paso mejor sencillo es facil : -->
						<?php

				        /* json_decode() esta funccion va decodificar es decir json_decode me permite tomar una estructuta tipo array que realmente viene en strings viene en cadena de texto lo va convertir en un array de verdad  */
				        $galeria = json_decode( $habitaciones[0]['galeria'], true ); /* entoces cando esto esta convertido a un array de verdad se va ordenar en array con indexes */ /* asi puedo recorrerlo */
						 
						// echo '<pre class="bg-white">'; print_r($galeria); echo '</pre>';
 				     	?>

					     	<?php foreach ($galeria as $index => $ImageOfGaleria): ?>
                         
						      <li>	
                                    
							     	<img src="<?php echo $servidor.$ImageOfGaleria;?>" class="img-fluid">

							  </li>
  
					        <?php endforeach ?>
				             
							
						</ul>

					</div>

				  	  	<a class="prev d-none d-lg-block" href="#">
				            <i class="fas fa-angle-left fa-2x"></i>
				        </a>

				        <a class="next d-none d-lg-block" href="#">
				            <i class="fas fa-angle-right fa-2x"></i>
				        </a>

				         <div class="controller d-block d-lg-none">

					        <div class="indicate-area"></div>

					    </div>
									   
				</section>

				<!-- VIDEO  -->

				<section class="mb-3 my-lg-3 videoHabitaciones d-none">
					
					<iframe width="100%" height="380" src="https://www.youtube.com/embed/<?php echo $habitaciones[0]['video'] ;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		
				</section>

				<!-- 360 GRADOS -->

				<section class="mb-3 my-lg-3 360Habitaciones d-none">
          
				    <div id="myPano" class="pano" back="<?php echo $servidor.$habitaciones[0]["recorrido_virtual"]; ?>">  <!-- capturado y reemplazado por js  -->

						<div class="controls">
							<a href="#" class="left">&laquo;</a>
							<a href="#" class="right">&raquo;</a>
						</div>

					</div>
									
				</section>

				<!--=====================================
				DESCRIPCIÓN HABITACIONES
				======================================-->	

				<div class="descripcionHabitacion px-3"> 
					
					<h1 class="colorTitulos float-left"><?php echo $habitaciones[0]['estilo']." ".$habitaciones[0]['tipo']; ?></h1>   <!-- capturado reeeplazado por js  -->

					<div class="float-right pt-2">
						
						<button type="button" class="btn btn-default" vista="fotos"><i class="fas fa-camera"></i> Fotos</button>

						<button type="button" class="btn btn-default" vista="video"><i class="fab fa-youtube"></i> Video</button>
			
						<button type="button" class="btn btn-default" vista="360"><i class="fas fa-video"></i> 360°</button>
							
					</div>

					<div class="clearfix mb-4"></div>	

				    <div class="d-habitaciones">  <!-- Remplazable - segun peticion ajax  --> <!-- es decir el div se captura en el fichero habitaciones.js y ..... -->
					
					  <?php echo $habitaciones[0]['descripcion_h']; ?>  <!-- capturado  remplazado por js   -->
					
					</div>
 

                <form action="<?php echo $ruta;  ?>reservas" method="post" > <!-- metodo que voy a usar varables post , variables occultas -->

				    <!-- Input de escenario dos donde pasamos ids de habitaciones de la categorias seleccionada -->
				    <input type="hidden" name="id-habitacion" value="<?php echo $nuevoArrayHab; ?>" > <!-- Escenario 2 --> <!--o parecen todos los ref de carros que pertenecen a esa subcat en escenario 3  pues esto el que se manda a pagina reservas  -->

					<input type="hidden" name="ruta" value="<?php echo $habitaciones[0]["ruta"]; ?>" >																							
				 
				 	<div class="container">     <!-- formulario de comprobar la disponiblidad : sabemos para comprobar la disponiblidad de algun producto necesitaremos el id del producto a que queremos ver la disponiblidad  -->
                                                <!-- en estre caso el producto es la habitacion -->

						<div class="row py-2" style="background:#509CC3">

							 <div class="col-6 col-md-3 input-group pr-1">
							

								<input type="text" class="form-control datepicker entrada" autocomplete="off"  placeholder="Entrada"  name="fecha-ingreso" required>

								<div class="input-group-append">
									
									<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								
								</div>

							</div>

						 	<div class="col-6 col-md-3 input-group pl-1">
							
								<input type="text" class="form-control datepicker salida" autocomplete="off"  placeholder="Salida" name="fecha-salida"  readonly required>

								<div class="input-group-append">
									
									<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								
								</div>

							</div>

							<div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
								
								
									<input type="submit" class="btn btn-block btn-md text-white" value="Ver disponibilidad" style="background:black">	
						            <!-- estos variables post se van a pagina reservas pero yo las necesito especificamente en modulo infs reservas   -->

							</div>

						</div>

					</div>
				
				</form>	

				</div>

			</div>   <!-- comenzemos de abajo hacia arriba a reeemplazar  -->
			  
			<!--=====================================
			BLOQUE DER
			======================================-->

			<div class="col-12 col-lg-4 colDerHabitaciones">

			    <h2 class="colorTitulos text-uppercase"><?php echo $habitaciones[0]["tipo"]; ?> INCLUYE:</h2>  
				
				<ul>
				<!-- recuerda que incluye es una propiedad de la tablla habitacines que es un json son propiedades metidas dentro de un array  -->
				<!-- entonces debo convertir eso en un array que pueda recorrer en php  -->
                <?php

					$incluye = json_decode($habitaciones[0]["incluye"], true);
					/* echo '<pre class="bg-white">'; print_r($incluye); echo '</pre>'; */
				?>
                	<?php foreach ($incluye as $key => $value): ?>

                        <li>
	                        <h5>
	                	        <i class="<?php echo $value["icono"]; ?> w-25 colorTitulos"></i> 
	                	        <span class="text-dark small"><?php echo $value["item"]; ?></span>
	                        </h5>
                        </li>

                    <?php endforeach ?>

				</ul>

				<!-- HABITACIONES -->

				<div class="habitaciones " id="habitaciones">

					<div class="container">

						<div class="row">

						<?php

							$categorias = ControladorCategorias::ctrMostrarCategorias();

						?>
           
                    	<?php foreach ($categorias as $key => $value): ?>

                        <?php if ($_GET["pagina"] != $value["ruta"]): ?>  <!-- no quiero que me muestra la categoria del categoria en que estoy actualmente asi es mas elegante  -->

                         <div class="col-12 pb-3 px-0 px-lg-3">

	                        	<a href="<?php echo $ruta.$value["ruta"];  ?>">  <!-- dar en cuenta que estan listados dentro de elemento a que se vualva a cargar la misma pagina con valor ruta diferente  -->

	                         	<figure class="text-center">
			
	                     	  	 <img src="<?php echo $servidor.$value["img"]; ?>" class="img-fluid" width="100%">

		                        	<p class="small py-4 mb-0"><?php echo $value["descripcion_cat"]; ?></p>
                     
		                        	<h3 class="py-2 text-gray-dark mb-0">DESDE $<?php echo number_format($value["continental_baja"]); ?> COP</h3>

		                        	<h5 class="py-2 text-gray-dark border">Ver detalles <i class="fas fa-chevron-right ml-2"></i></h5>
			 
		                     	   <h1 class="text-white p-3 mx-auto w-50 lead text-uppercase" style="background:<?php echo $value["color"]; ?>"><?php echo $value["tipo"]; ?></h1>

	                        	</figure>
                     
                            	</a>

                         </div>

                        <?php endif ?>	

                    	<?php endforeach ?>

		            	
						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</div>