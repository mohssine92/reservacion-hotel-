<?php
   
   $item = "id_u";              
   $valor = $_SESSION["id"];

   $usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);     /* => trae 1 registro de solo tabla usuario , del ususario loguedo  */
   $reservas = ControladorReservas::ctrMostrarReservasUsuario($valor); 

 /*   echo '<pre class="bg-white">'; print_r($reservas); echo '</pre><br>';   */

   $hoy = date("Y-m-d");
   $noVencidas = 0;
   $vencidas = 0; 
  
foreach ($reservas as $key => $value) {
	
	if($hoy >= $value["fecha_ingreso"]){

		++$vencidas;		
	
	}else{

		++$noVencidas;

	}

}



?>



<!--=====================================
INFO PERFIL
======================================-->

<div class="infoPerfil container-fluid bg-white p-0 pb-5 pb-5">
	
	<div class="container">
		
		<div class="row">

			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-4 colIzqPerfil p-0 px-lg-3">
				
				<div class="cabeceraPerfil pt-4">
				
				    <?php if ($usuario["modo"] == "facebook"): ?>
      
                     <a href="#" class="float-left lead text-white pt-1 px-3 mb-4 salir">  <!-- asi desde javascript cuando damos a esta clase salir borramos cookies de facebook y luego y luego rederigimos a la pagina salir.php -->
                     	<h5><i class="fas fa-chevron-left"></i> Salir</h5>                  <!-- Todo desde javascript -->
                     </a>
					

                    <?php else: ?>  <!-- => cerrar cession en modo directo y google -->

					<a href="<?php echo $ruta;  ?>salir" class="float-left lead text-white pt-1 px-3 mb-4">
						<h5><i class="fas fa-chevron-left"></i> Salir</h5>
					</a>

					<?php endif ?>

					<div class="clearfix"></div>

					<h1 class="text-white p-2 pb-lg-5 text-center text-lg-left">MI PERFIL</h1>	
				</div>

				<!--=====================================
				PERFIL
				======================================-->

				<div class="descripcionPerfil">
					
					<figure class="text-center imgPerfil">
					 
					<?php if ($usuario["foto"] == ""): ?> <!-- 1 -->

                       <img src="<?php echo $servidor; ?>vistas/img/usuarios/default/default.png" class="img-fluid rounded-circle">
					     
                    <?php else: ?>
                     
                    <?php if ($usuario["modo"] == "directo"): ?> <!-- 2 -->
                     
                     	<img src="<?php echo $servidor.$usuario["foto"]; ?>" class="img-fluid rounded-circle">
                     
                    <?php else: ?>	
                     
            	       <img src="<?php echo $usuario["foto"]; ?>" class="img-fluid rounded-circle" width="100" height="100">   <!-- foto Redes sociales  -->
						
   
                    <?php endif ?>  <!-- 2 -->
                     
                    <?php endif ?>  <!-- 1 -->
					
					</figure>

					<div id="accordion">

						<div class="card">

							<div class="card-header">
								<a class="card-link" data-toggle="collapse" href="#collapseOne">
									MIS RESERVAS
								</a>
							</div>

							<div id="collapseOne" class="collapse show" data-parent="#accordion">

								<ul class="card-body p-0">

									<li class="px-2 misReservas" style="background:#FFFDF4"> <?php echo $noVencidas; ?> Por vencerse</li>
									<li class="px-2 text-white misReservas" style="background:#CEC5B6"> <?php echo $vencidas; ?> vencidas</li>

								</ul>

								<!--=====================================
								TABLA RESERVAS MÓVIL
								======================================-->	
								<?php

                                 if(!$reservas){
                                 
                                 	echo ' <div class="d-lg-none d-flex py-2">Aún no tiene reservas realizadas</div>';
                                 
                                 }
                                 
                                 
                                foreach ($reservas as $key => $value) { /* permito 20 ultimas reservas hechas por id user  */

                                    $habitacion = ControladorHabitaciones::ctrMostrarHabitacion($value["id_habitacion"]);   
									$categoria = ControladorCategorias::ctrMostrarCategoria($habitacion["categoria_id"]);
									$testimonio = ControladorReservas::ctrMostrarTestimonios("reserva_id", $value["id_reserva"]);

									
                                    if($value["fecha_ingreso"] != '0000-00-00') {

                                        echo '<div class="d-lg-none d-flex py-2">
                                       
                                 	      	   <div class="p-2 flex-grow-1">
                                       
                                 	      		   <h5>'.$categoria["tipo"]." ".$habitacion["estilo"].'</h5>
                                 	      		   <h5 class="small text-gray-dark">Del '.$value["fecha_ingreso"].' al '.$value["fecha_salida"].'</h5>
                                       
                                 	      	   </div>
                                       
                                 	      	   <div class="p-2">
                                       
                                 	      			 <button type="button" class="btn btn-dark text-white actualizarTestimonio" data-toggle="modal" data-target="#actualizarTestimonio" idTestimonio="'.$testimonio[0]['id_test'].'"
														verTestimonio="'.$testimonio[0]['testimonio'].'">
                                       
                                 	      				 <i class="fas fa-pencil-alt"></i>
                                       
                                 	      			 </button>
                                       
                                 	      			 <button type="button" class="btn btn-warning text-white verTestimonio" data-toggle="modal" data-target="#verTestimonio" verTestimonio="'.$testimonio[0]['testimonio'].'">
                                       
                                 	      				 <i class="fas fa-eye"></i>
                                       
                                 	      			 </button>
                                       
                                 	      	   </div>
                                       
                                 	         </div>
                                       
                                 	         <hr class="my-0">';
                                    }  								
									
								
                                
                                }

								
                                 
                                 ?>
							
							</div>

						</div>

						<div class="card">

							<div class="card-header">
								<a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
									MIS DATOS
								</a>
							</div>

							<div id="collapseTwo" class="collapse" data-parent="#accordion">
								<div class="card-body p-0">

									<ul class="list-group">
										
										<li class="list-group-item small"><?php echo $usuario["nombre"]; ?></li>
										<li class="list-group-item small"><?php echo $usuario["email"]; ?></li>

									<?php if ($usuario["modo"] == "directo"): ?>
										
										   <li class="list-group-item small">
										     	<button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#cambiarPassword">Cambiar Contraseña</button>
										   </li>
										<!--=====================================
										MODAL PARA CAMBIAR CONTRASEÑA
										======================================-->					
										<div class="modal formulario" id="cambiarPassword">
											
											<div class="modal-dialog">

										 		<div class="modal-content">

										 			<form method="post">

										 				<div class="modal-header">

									 				 		<h4 class="modal-title">Cambiar Contraseña</h4>

        													<button type="button" class="close" data-dismiss="modal">&times;</button>

										 				</div>

										 				<div class="modal-body">
										 					
															<input type="hidden" name="idUsuarioPassword" value="<?php echo $usuario["id_u"]; ?>">

															<div class="form-group">
 
																<input type="password" class="form-control" placeholder="Nueva contraseña" name="editarPassword" required>

															</div>

										 				</div>

										 				<div class="modal-footer d-flex justify-content-between"> 

														 	<div>

													        	<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

													        </div>

												         	<div>
         
												         		<button type="submit" class="btn btn-primary">Enviar</button>

											        	 	</div>

										 				</div>

									 				  	 <?php

                                                          $cambiarPassword = new ControladorUsuarios();
                                                          $cambiarPassword -> ctrCambiarPassword(); 
                                                          
                                                        ?>  

										 			</form>

										 		</div>

											</div>

										</div>

									
										
										<!-- <li class="list-group-item small">
											<button class="btn btn-primary btn-lg">Cambiar Imagen</button>
										</li> -->

										<li class="list-group-item small">
											<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#cambiarFotoPerfil">Cambiar Imagen</button>
										</li>

										<!--=====================================
										MODAL PARA CAMBIAR FOTO DE PERFIL
										======================================-->

										<div class="modal formulario" id="cambiarFotoPerfil">

											<div class="modal-dialog">

												<div class="modal-content">

													<form method="POST" enctype="multipart/form-data">

														<div class="modal-header">

															 <h4 class="modal-title">Cambiar Imagen</h4>

															 <button type="button" class="close" data-dismiss="modal">&times;</button>

														</div>

														<div class="modal-body">

															<input type="hidden" name="idUsuarioFoto" value="<?php echo $usuario["id_u"]; ?>">

															<div class="form-group">

																<input type="file" class="form-control-file border" name="cambiarImagen" required>

																<input type="hidden" name="fotoActual" value="<?php echo $usuario["foto"]; ?>">

															</div>	

														</div>

														<div class="modal-footer d-flex justify-content-between">  

														 	<div>

												        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

												        	</div>

												        	<div>
         
													         	<button type="submit" class="btn btn-primary">Enviar</button>

													         </div>

														</div>

														<?php

															 $cambiarImagen = new ControladorUsuarios();
														     $cambiarImagen -> ctrCambiarFotoPerfil();


														?>

													</form>

												</div>

											</div>

										</div>

										<?php endif ?>

									</ul>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>

			<!--=====================================
			BLOQUE DER            
			======================================-->

			<div class="col-12 col-lg-8 colDerPerfil">                       	<!-- <?php	echo '<pre class="bg-white">'; print_r($usuario); echo '</pre><br>';  ?> -->
		
				<div class="row">

					<div class="col-6 d-none d-lg-block">
						
						<h4 class="float-left my-3">Hola <?php echo $usuario["nombre"]; ?></h4>
					
					</div>

							
                    <div class="col-12">

					<?php if (isset($_COOKIE["codigoReserva"])): ?>  <!-- => si no llega la variable cookies no debe parecer smart button of paypal  -->

				

                         <div class="card">  <!-- => esto es el card donde mostro informacion de reserva a pagar y el button inteligente de paYPAL -->

                         <div class="card-header">
                         
                         <h4>Tienes una reserva pendiente por pagar:</h4> 
                        
						 </div>
                          
                          <div class="card-body text-center">
                         
                           	 <figure>
                         
                         	   <img src="<?php echo $_COOKIE["imgHabitacion"]; ?>" class="img-thumbnail w-50">
                         
                         	  </figure>
                         
                         	  <h5><strong><?php echo $_COOKIE["infoHabitacion"]; ?></strong></h5>
                         
                         	  <h6> Fechas <?php echo $_COOKIE["fechaIngreso"]; ?> - <?php echo $_COOKIE["fechaSalida"]; ?></h6>
                         
                         	  <h4 id="totalOrder"total="<?php echo ($_COOKIE["pagoReserva"]);?>"><?php echo number_format($_COOKIE["pagoReserva"],2);?> MAD</h4> <!--seguridad Imporante! se puede manipular en herramienta desarollador valor precio antes de mandarlo a cookies  -->
                         
                         
                           </div>
                         
                           <div class="card-footer d-flex bg-white">

						   <!-- <figure>
								 			
							  <img src="img/paypal.png" class="img-fluid w-50">
											 
							</figure> -->

						     <!-- Paypal -->
					         <!--=====================================
					         MERCADO PAGO
					         ======================================-->		
                                  
                            <div class="col-12 col-l-8"> 
						    
							<!-- <a href="javascript:location.reload()">Actualizar</a> -->
						
							</form>
                             
							<div id="paypal-button-container"></div>
							
                            </div>
                             							

							 <!-- <div class="alert alert-success d-none" id="alerta" role="alert"> </div>  --><!-- Alerta  de exito de transaccion -->
						    </div> 
					
                           </div>
                           
                         
                             
                         </div>  <!--  => Fin card  -->

					<?php endif ?>   <!-- => Fin isset($_COOKIE["codigoReserva"])  -->
                  
				<!-- 	<?php if (!isset($_COOKIE["codigoReserva"])): ?> 

                     <div class="alert alert-danger" role="alert">
					 Lo sentimos, las fechas de la reserva que habías seleccionado han sido ocupadas o tienes que reservar un dia antes 
				     <a href="<?php echo $ruta; ?>" class="btn btn-danger btn-sm">vuelve a intentarlo </a>
											
                     </div>
					 
					 
											

					<?php endif ?>
 -->
					
					</div>

					<div class="col-6 d-none d-lg-block"></div>

					<div class="col-12 mt-3">

                    <?php

					if($reservas){
                       
                       echo '<p class="help-block small">
					   
				        Si necesitas modificar o cancelar una reserava, Favor escribirnos al WhatsApp  <a href="http://api.whatsapp.com/send?phone=34643446409&text=Hola Portobelo, necesito hacer un cambio en la reserva " targer="_blank" >+34 643 446 409</a>	 
										 
					   </p>';
                
					}
					;?>
						
					<table class="table table-striped">
					    <thead>
					      <tr>
					      	<th>#</th>
							<th>Codigo Rserva</th>
					        <th>Habitación</th>
					        <th>Fecha de Ingreso</th>
					        <th>Fecha de Salida</th>
					        <th>Testimonios</th>
					      </tr>
					    </thead>
					    <tbody>
					     
					     <?php

					         if(!$reservas){
    
					         	echo ' <tr><td colspan="5">Aún no tiene reservas realizadas</td></tr>';
    
					         	return;
    
					         }

                                 foreach ($reservas as $key => $value) {

                                     $habitacion = ControladorHabitaciones::ctrMostrarHabitacion($value["id_habitacion"]);   
                                     $categoria = ControladorCategorias::ctrMostrarCategoria($habitacion["categoria_id"]);
                                     $testimonio = ControladorReservas::ctrMostrarTestimonios("reserva_id", $value["id_reserva"]);

                                     /*  echo '<pre class="bg-white">'; print_r($testimonio); echo '</pre><br>';    */
                                     /*  echo '<pre class="bg-white">'; print_r($testimonio[0]['testimonio']); echo '</pre><br>';  */
                                       if($value["fecha_ingreso"] != '0000-00-00' ){
                                           echo '<tr>
              
					        	      		 <td>'.($key+1).'</td>
								      		 <td>'.$value["codigo_reserva"].'</td>
					        	      		 <td class="text-uppercase">'.$categoria["tipo"]." ".$habitacion["estilo"].'</td>
					        	      		 <td>'.$value["fecha_ingreso"].'</td>
					        	      	     <td>'.$value["fecha_salida"].'</td>
					        	      	     <td>
					                      
					        	      		  <button type="button" class="btn btn-dark text-white actualizarTestimonio" data-toggle="modal" data-target="#actualizarTestimonio" idTestimonio="'.$testimonio[0]['id_test'].'"
					        	      		     verTestimonio="'.$testimonio[0]['testimonio'].'">
              
					        	      		  	<i class="fas fa-pencil-alt"></i>
              
					        	      		  </button>
              
					        	      		  <button type="button" class="btn btn-warning text-white verTestimonio" data-toggle="modal" data-target="#verTestimonio" verTestimonio="'.$testimonio[0]['testimonio'].'">
              
					        	      		  	<i class="fas fa-eye"></i>
              
					        	      		  </button>
					        	      		
					                      	</td>
					                     
					                   </tr>';
                                       }
                                 }




                            
        
					     ?>

					    </tbody>
					  </table>


					</div>

				</div>
			
			</div>

		</div>

	</div>

</div>

<!--=====================================
MODAL PARA VER TESTIMONIO
======================================-->

<div class="modal" id="verTestimonio">
	
	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h4 class="modal-title">Testimonio</h4>

				<button type="button" class="close" data-dismiss="modal">&times;</button>

			</div>

			<div class="modal-body visorTestimonios">

				<script>
					
				$(".verTestimonio").click(function(){

					var testimonio = $(this).attr("verTestimonio");   /* => capta valor del eteam destimonio , por defecto viene vacio  */

					if(testimonio != ""){

						$(".modal-body.visorTestimonios").html('<p>'+testimonio+'</p>')

					}else{

						$(".modal-body.visorTestimonios").html('<p>Aún no tiene testimonios de esta reserva</p>');

					}


				})

				</script>			

			</div>

		</div>

	</div>

</div>

<!--=====================================
MODAL PARA EDITAR TESTIMONIO
======================================-->

<div class="modal" id="actualizarTestimonio">
	
	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">

				<h4 class="modal-title">Testimonio</h4>

				<button type="button" class="close" data-dismiss="modal">&times;</button>

			</div>

			<div class="modal-body">

			<script>

				$(".actualizarTestimonio").click(function(){

					var testimonio = $(this).attr("verTestimonio");   /* capturar  */
					var idTestimonio = $(this).attr("idTestimonio");

					if(testimonio != ""){

						$(".modal-body textarea").val(testimonio);  /* => lo meto como valor de rextarea */

					}else{

						$(".modal-body textarea").val("");  /* si no llega nada por defecto deja  valu de textarea vacia  */

					}

					$("input[name='idTestimonio']").val(idTestimonio);   /* => pasar valor al attributo value */


				})


			</script>

				<form method="post">

					<input type="hidden" value="" name="idTestimonio">
				
					<textarea class="form-control" rows="3" name="actualizarTestimonio" required></textarea>

					<input class="btn btn-primary my-3 float-right" type="submit" value="Guardar testimonio">  <!-- al dar click debe actualizar eteam testimonio en el id testimonio -->

					<?php

					 	$actualizarTestimonio = new ControladorReservas();
						$actualizarTestimonio -> ctrActualizarTestimonio(); 

					?>

				</form>

			</div>

		</div>

	</div>

</div>



