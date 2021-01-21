
<?php

/* variables post recbidas desde 3 formularios ; desde modulo header y modulo info habitaciones y modulo info reserva */

if(isset($_POST["id-habitacion"])){       /* esto es id del producto a rentar  comprobamos si nos acaba de llegar  */  /* son variables de tipo post recebidas de formulario  */

	echo '<pre class="bg-white">'; print_r($_POST["id-habitacion"]); echo '</pre><br>'; 
    echo '<pre class="bg-white">'; print_r($_POST["fecha-ingreso"]); echo '</pre><br>'; 
    echo '<pre class="bg-white">'; print_r($_POST["fecha-salida"]); echo '</pre><br>';  
	 
    $valor = $_POST["id-habitacion"] ;  /* con id_habitacion ya es suficiente para darnos cuenta si la reservas hechas para este producto o no  */
	/* este proceso en que ya tenemos el producto elegido con fechas - vamos a comprobar su disponiblidad , usando su id para saber primero si esta registrado en tabla de reservas - sabemos que no puede estar registrado en tablas reservas hasta que 
	  ya se ha efectuado el pago eso segnifica que ya ha pasado por varios procesos por tener este id_habitacion registrado en esta tabla  */
 
	$reservas = ControladorReservas::ctrMostrarReservas($valor);  /* obtengo toda informacion acerca de del producto alquilado , tada informacions en tabla habitacion + toda informacion en tabla categoria + toda informacion en tabla reserva   */
    /*  echo '<pre class="bg-white">'; print_r($reservas); echo '</pre><br>';  */ 
 
	
 
}else{
    /* en de llegar a este fichero sin fechas o id de habitacion no voy a dejar pasar te mando a pagina ed inicio */  /* asi si no me trare id de producto a reservar no dejo pasar  */
	echo '<script> window.location="'.$ruta.'"</script>';

}


?>


<!--=====================================
INFO RESERVAS
======================================-->


<!-- vamos averiguar la existencia de id habitacion en tabla de reservas por javascript . para el tema de la disponiblidad igual como hemos hecho con php , asi que la pregunta como lo vamos hacer  --><!-- voy a utulizar unos atrributos en el div de infoReservas
 que puede capturar en javascript  estos atrributos van a variar informacion imporatante en el proceso de js ,  recient conseguida por peticiones al controlador por php gracias al flujo de jecuccion en php --->  <!-- reservas.js -->
<div class="infoReservas container-fluid bg-white p-0 pb-5" idHabitacion="<?php echo $_POST["id-habitacion"]; ?>" fechaIngreso="<?php echo $_POST["fecha-ingreso"]; ?>" fechaSalida="<?php echo $_POST["fecha-salida"]; ?>">
	
	<div class="container">
		
		<div class="row">


			<!--=====================================
			BLOQUE IZQ
			======================================-->
			
			<div class="col-12 col-lg-8 colIzqReservas p-0">
				
				<!--=====================================
				CABECERA RESERVAS
				======================================-->
				
				<div class="pt-4 cabeceraReservas">
					
					<a href="javascript:history.back()" class="float-left lead text-white pt-1 px-3">
						<h5><i class="fas fa-chevron-left"></i> Regresar</h5>
					</a>

					<div class="clearfix"></div>

					<h1 class="float-left text-white p-2 pb-lg-5">RESERVAS</h1>	

					<h6 class="float-right px-3">

						<br>
						<a href="<?php echo $ruta;  ?>perfil" style="color:#FFCC29">Ver tus reservas</a>

					</h6>

					<div class="clearfix"></div>

				</div>

				<!--=====================================
				CALENDARIO RESERVAS
				======================================	-->

				<div class="bg-white p-4 calendarioReservas">

				   <!-- Mensaje dinamico de la disponiblidad  -->
				   <?php if (!$reservas): ?> <!-- si el objeto de $reservas viene vacio es decir que el id de habitacion no tiene coincidencia en tabla de reservas  -->                                               
																									 
				    <h1 class="pb-5 float-left text-success">¡Está Disponible!</h1>    <!-- asi puedo lazar este mensaje que indica que la habitacion esta disponible  -->
																					 
				    <?php else: ?> <!-- en caso que arrevez , eso quiere decir que el objeto $reservas me devuelve informacion es decir lleno asi que : lanzo el siguiente linea de  codigo  -->
																					 
				    <div class="infoDisponibilidad"></div> <!-- pero son informaciones que todavia no sabemos si las fechas se cruzan o no , entonces ponemos este div con esta clase paraque ser rellenads de javascript porque en js donde vamos a compara las fechas
																																			 de disponiblidad . Donde validamos esa fechas que se cruzan ? - en reservas.js en el bloque de calendario   -->
				    <?php endif ?>

					<div class="float-right pb-3">
							
						<ul>
							<li>
								<i class="fas fa-square-full" style="color:#847059"></i> No disponible
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#eee"></i> Disponible
							</li>

							<li>
								<i class="fas fa-square-full" style="color:#FFCC29"></i> Tu reserva
							</li>
						</ul>

					</div>

					<div class="clearfix"></div>
			
					<div id="calendar"></div>   <!-- calendario grande es un plugin integrado  -->

					<!--=====================================
					MODIFICAR FECHAS
					======================================	-->

					<h6 class="lead pt-4 pb-2">Puede modificar la fecha de acuerdo a los días disponibles:</h6>

                    <!-- en caso que no haya disponible fecha elegida aqui se puede cambiar las fechas en este formulario -->
					<!-- con este formulario se puede comprobar la disponiblidad del producto por fecha desde la base de datos  -->
					<form action="<?php echo $ruta; ?>reservas" method="post" ><!-- variables post que seran enviadas :  name="id-habitacion"  name="fecha-ingreso"   name="fecha-salida"     -->

					  <input type="hidden" name="id-habitacion" value="<?php echo $_POST["id-habitacion"]; ?>"> <!-- debe ir esta varaible $_POST["id-habitacion"] porque sobre este producto voy a busacar nueva fecha --> <!-- es decir sobre el mismo captado -->

						<div class="container mb-3">

							<div class="row py-2" style="background:#509CC3">

								 <div class="col-6 col-md-3 input-group pr-1">
								
								    <input type="text" class="form-control datepicker entrada"  autocomplete="off" placeholder="Entrada" name="fecha-ingreso" value="<?php echo $_POST["fecha-ingreso"] ;?>" required> 

									 <div class="input-group-append">
										
										<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
								 
									 </div>

								</div>

							 	<div class="col-6 col-md-3 input-group pl-1">
								
								  <input type="text" class="form-control datepicker salida"  autocomplete="off"  placeholder="Salida" name="fecha-salida" value="<?php echo $_POST["fecha-salida"] ;?>" readonly required>

                                   <div class="input-group-append">
										
										<span class="input-group-text"><i class="far fa-calendar-alt small text-gray-dark"></i></span>
									
								    </div>

								</div>

								<div class="col-12 col-md-6 mt-2 mt-lg-0 input-group">
																
								  <input type="submit" class="btn btn-block btn-md text-white" value="Ver disponibilidad" style="background:black">										
								
								</div>

							</div>

						</div>

					</form>

				</div>   <!-- div calendario reserva  -->

			</div>   <!-- col izquierda  -->

		
		
			<!--=====================================
			BLOQUE DER
			======================================-->
           
			
			<div class="col-12 col-lg-4 colDerReservas">

				<h4 class="mt-lg-5">Código de la Reserva:</h4>
				<h2 class="colorTitulos"><strong>K2DRESF34</strong></h2>

				<div class="form-group">
				  <label>Ingreso:</label>
				  <input type="date" class="form-control" value="2019-03-13" readonly>
				</div>

				<div class="form-group">
				  <label>Salida:</label>
				  <input type="date" class="form-control" value="2019-03-15"  readonly>
				</div>

				<div class="form-group">
				  <label>Habitación:</label>
				  <input type="text" class="form-control" value="Habitación Suite Oriental" readonly>

				  <img src="img/oriental.png" class="img-fluid">

				</div>

				<div class="form-group">
				  <label>Plan:</label>
				  <select class="form-control">
				  	
					<option value="continental">Plan Continental</option>
					<option value="americano">Plan Americano</option>
					<option value="romantico">Plan Romántico</option>
					<option value="lunademiel">Plan Luna de Miel</option>
					<option value="aventura">Plan Aventura</option>
					<option value="spa">Plan SPA</option>

				  </select>
				</div>
				
				<div class="form-group">
				  <label>Personas:</label>
				  <select class="form-control">
				  	
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>

				  </select>
				</div>

				<div class="row py-4">

					<div class="col-12 col-lg-6 col-xl-7 text-center text-lg-left">
						
						<h1>$300 USD</h1>

					</div>
					
					<div class="col-12 col-lg-6 col-xl-5">
				
						<a href="<?php echo $ruta;  ?>perfil">
							<button class="btn btn-dark btn-lg w-100">PAGAR <br> RESERVA</button>
						</a>

					</div>
			
				</div>

			</div>
			
			
		</div>  <!-- row  -->
		
	</div>   <!-- container  -->
	
</div>     <!-- div info reservas  -->



