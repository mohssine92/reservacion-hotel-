<?php

$item = "id_u";               /* campo */
$valor = $_SESSION["id"];

$usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);
/* $reservas = ControladorReservas::ctrMostrarReservasUsuario($valor); */

/* $hoy = date("Y-m-d");
$noVencidas = 0;
$vencidas = 0; */

/* foreach ($reservas as $key => $value) {
	
	if($hoy >= $value["fecha_ingreso"]){

		++$vencidas;		
	
	}else{

		++$noVencidas;

	}

}
 */


?>



<!--=====================================
INFO PERFIL
======================================-->

<div class="infoPerfil container-fluid bg-white p-0 pb-5 mb-5">
	
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

									<li class="px-2" style="background:#FFFDF4"> 1 Por vencerse</li>
									<li class="px-2 text-white" style="background:#CEC5B6"> 5 vencidas</li>

								</ul>

								<!--=====================================
								TABLA RESERVAS MÓVIL
								======================================-->	

								<div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>Suite Contemporánea</h5>
										<h5 class="small text-gray-dark">Del 30.08.2018 al 03.09.2018</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div>

								<hr class="my-0">

								<div class="d-lg-none d-flex py-2">
									
									<div class="p-2 flex-grow-1">

										<h5>Suite Contemporánea</h5>
										<h5 class="small text-gray-dark">Del 30.08.2018 al 03.09.2018</h5>

									</div>

									<div class="p-2">

										<button type="button" class="btn btn-dark btn-sm text-white"><i class="fas fa-pencil-alt"></i></button>
										<button type="button" class="btn btn-warning btn-sm text-white"><i class="fas fa-eye"></i></button>

									</div>

								</div>

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
										<li class="list-group-item small">
											<button class="btn btn-dark btn-sm">Cambiar Contraseña</button>
										</li>
										<li class="list-group-item small">
											<button class="btn btn-primary btn-lg">Cambiar Imagen</button>
										</li>

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
						
						<h4 class="float-left">Hola <?php echo $usuario["nombre"]; ?></h4>
					
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
						
						<table class="table table-striped">
					    <thead>
					      <tr>
					      	<th>#</th>
					        <th>Habitación</th>
					        <th>Fecha de Ingreso</th>
					        <th>Fecha de Salida</th>
					        <th>Comentarios</th>
					      </tr>
					    </thead>
					    <tbody>
					      <tr>
					        <td>1</td>
					        <td>Suite Contemporánea</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr>
					       <tr>
					        <td>2</td>
					        <td>Especial Caribeña</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        	
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr>

					       <tr>
					        <td>3</td>
					        <td>Suite Clásica</td>
					        <td>30.08.2018</td>
					        <td>03.09.2018</td>
					        <td>
					        	
								  <button type="button" class="btn btn-dark text-white"><i class="fas fa-pencil-alt"></i></button>
								  <button type="button" class="btn btn-warning text-white"><i class="fas fa-eye"></i></button>
								
					        </td>
					      </tr>
					    </tbody>
					  </table>


					</div>

				</div>
			
			</div>

		</div>

	</div>

</div>
