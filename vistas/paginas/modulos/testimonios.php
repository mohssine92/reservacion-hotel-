<?php

$valor = $_GET["pagina"];   /* => aprovecho la url de esta categoria  */

$habitaciones = ControladorHabitaciones::ctrMostrarHabitaciones($valor);   /* => tarego todas habitaciones de esta categoria */ /* por defecto cojemos el index 0 .  */

/* echo '<pre class="bg-white">'; print_r($habitaciones[0]['id_h']); echo '</pre><br>'; */  /* => pues con este id habitacion pido testimonios relacionados con este id habitacion  */

$testimonios = ControladorReservas::ctrMostrarTestimonios("habitacion_id", $habitaciones[0]['id_h']); 

/* echo '<pre class="bg-white">'; print_r($testimonios); echo '</pre><br>'; */   /* => eco paar mostrar testemonios de una habitacion por si id  */



?>

<!--=====================================
TESTIMONIOS
======================================-->
<div class="testimonios container-fluid py-5 text-white">

  <div class="container mb-3">
			
			<h1 class="text-center py-5">TESTIMONIOS</h1>
	
			<div class="row">   <!-- systema row col  -->

			<?php
                
				$cantidadTestimonios = 0;
				$idTestimonios = array();    /* => aqui voy empujando todos posibles ids testimonios relacionados a este id habitacion comunicada  */
	          	  
                    foreach($testimonios as $key => $value) {  /* => tener en cuenta $testimonios son id p ids testimonios sobre id habitacion comunicado   */

  						if($value["aprobado"] != 0) {    /* => entonces mostramos solo tetemonios aprobados  */

						  ++$cantidadTestimonios;  /* INICA CON VALOR ZERO CADA VES ENTRA INREMENTA HASTA QWUE CUMPLA VALOR 4 PARA SIGUIENTE TAREA  */
						  array_push($idTestimonios, $value["id_test"]);
                           
			     	  
			     	   }
     
                   
			        }

					
					if($cantidadTestimonios >= 4){
    
                        for($i = 0; $i < count($idTestimonios); $i++) {
                         
							/* echo '<pre class="bg-white">'; print_r($idTestimonios[$i]); echo '</pre><br>'; */

							echo '<div class="col-12 col-lg-3 text-center p-4">';   /* nuestra columna */
					        
							if($testimonios[$i]["foto"] == ""){

								echo '<img src="'.$servidor.'vistas/img/usuarios/default/default.png" class="img-fluid rounded-circle w-50">';
		
							}else{
		
								if($testimonios[$i]["modo"] == "directo"){
		
									echo '<img src="'.$servidor.$testimonios[$i]["foto"].'" class="img-fluid rounded-circle w-50">';
		
								}else{
		
									echo '<img src="'.$testimonios[$i]["foto"].'" class="img-fluid rounded-circle w-50">';
								}
		
							}
							
							echo '<h4 class="py-4">'.$testimonios[$i]["nombre"].'</h4>

				                    	<p>'.$testimonios[$i]["testimonio"].'</p>

                 				  </div>';

					
						}
						
									
				    }else{

					  echo'<div class="col-12 text-white text-center">Esta habitacion aun no tiene testimonios</div>';

				    }


										
	                echo '</div>'; /* nuestra columna */


				  ?> 
    
     
            	
		   
				
			
			</div>  <!-- row -->
	
		
			<?php
            		
            
            		if($cantidadTestimonios > 4){
            
            	    	echo '<button class="btn btn-default float-right px-4 verMasTestimonios">VER MÁS</button>';
            
            		}
            
            	?>
            
	  

		
	
  </div>
	

</div>