
<?php

/* variables post recbidas desde 3 formularios ; desde modulo header y modulo info habitaciones y modulo info reserva */

if(isset($_POST["id-habitacion"])){       /* esto es id del producto a rentar  comprobamos si nos acaba de llegar  */  /* son variables de tipo post recebidas de formulario  */

	echo '<pre class="bg-white">'; print_r($_POST["id-habitacion"]); echo '</pre><br>'; 
    echo '<pre class="bg-white">'; print_r($_POST["fecha-ingreso"]); echo '</pre><br>'; 
    echo '<pre class="bg-white">'; print_r($_POST["fecha-salida"]); echo '</pre><br>';  
	 
	$valor = $_POST["id-habitacion"] ;  
	
	$reservas = ControladorReservas::ctrMostrarReservas($valor);  /*Recuerda objeto reservas trea 3 tablas */ /* trea todo tipo de informacion acerca de la habitacion a alquiler  */
	$planes = ControladorPlanes::ctrMostrarPlanes(); /* tala planes */

	
	/*=============================================
	DEFINIR PRECIOS DE TEMPORADA
	=============================================*/

	date_default_timezone_set("Africa/Casablanca");  /* Definir Zona Horaria */ 
	$hoy = getdate();  /* aqui tengo hora actual de me zona , ami me interesa los dias ,   */
	echo '<pre class="bg-white">'; print_r($hoy); echo '</pre><br>';      /* siempre cuando quier filtra uso el print para no fallar en escritura de propiedad */

     /* asi empiezo a filtrar - lo que para el hotel va ser temporada alta */
     if($hoy["mon"] == 12 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||  $hoy["mon"] == 1 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15 ||  $hoy["mon"] == 6 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||   $hoy["mon"] == 7 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15){
     
	     /* depende de id_habitacion */ /* solo estoy traendo de tablas habitaciones Reservas Categorias */
          $precioContinental = $reservas[0]["continental_alta"];
	      $precioAmericano = $reservas[0]["americano_alta"];
	      /*debo emvocar con otro objeto la traeda de planes */
          $precioRomantico = $reservas[0]["americano_alta"] + $planes[0]["precio_alta"];
          $precioLunaDeMiel = $reservas[0]["americano_alta"] + $planes[1]["precio_alta"];
          $precioAventura = $reservas[0]["americano_alta"] + $planes[2]["precio_alta"];
          $precioSPA = $reservas[0]["americano_alta"] + $planes[3]["precio_alta"];
	
       
     }else{

	      $precioContinental = $reservas[0]["continental_baja"];
	      $precioAmericano = $reservas[0]["americano_baja"];
	      $precioRomantico = $reservas[0]["americano_baja"] + $planes[0]["precio_baja"];
	      $precioLunaDeMiel = $reservas[0]["americano_baja"] + $planes[1]["precio_baja"];
	      $precioAventura = $reservas[0]["americano_baja"] + $planes[2]["precio_baja"];
	      $precioSPA = $reservas[0]["americano_baja"] + $planes[3]["precio_baja"];

     } /* end else */

    /*=============================================
	DEFINIR CANTIDAD DE DIAS DE LA RESERVA
	=============================================*/
	$fechaIngreso = new DateTime($_POST["fecha-ingreso"]); /* DateTime Object  */                   echo '<pre class="bg-white">'; print_r($fechaIngreso); echo '</pre><br>'; 
	$fechaSalida = new DateTime($_POST["fecha-salida"]);                                        	echo '<pre class="bg-white">'; print_r($fechaSalida); echo '</pre><br>';  
	$diff = $fechaIngreso->diff($fechaSalida);  /* DateInterval */                               	echo '<pre class="bg-white">'; print_r($diff); echo '</pre><br>';  
    $dias = $diff->days; 	                                                                        echo '<pre class="bg-white">'; print_r($diff->days); echo '</pre><br>';  

	if($dias == 0){

		$dias = 1;
	}
 

	


	
 
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
<div class="infoReservas container-fluid bg-white p-0 pb-5" idHabitacion="<?php echo $_POST["id-habitacion"]; ?>" fechaIngreso="<?php echo $_POST["fecha-ingreso"]; ?>" fechaSalida="<?php echo $_POST["fecha-salida"]; ?>" dias="<?php echo $dias; ?>">
	
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
           
                                                  <!-- siempre inicie escondido -->			
			<div class="col-12 col-lg-4 colDerReservas" style="display:none">

				<h4 class="mt-lg-5">Código de la Reserva:</h4>
				<h2 class="colorTitulos"><strong class="codigoReserva"></strong></h2> <!-- codigo se meto por javascript  -->

				<div class="form-group">
				  <label>Ingreso 3:00 pm: </label>
				  <input type="date" class="form-control" value="<?php echo $_POST["fecha-ingreso"]; ?>" readonly>
				</div>

				<div class="form-group">
				  <label>Salida: 1:00 pm: </label>
				  <input type="date" class="form-control" value="<?php echo $_POST["fecha-salida"]; ?>"  readonly>
				</div>

				<div class="form-group">
				  <label>Habitación:</label>
				  <input type="text" class="form-control" value="Habitación <?php echo $reservas[0]["tipo"]." ".$reservas[0]["estilo"]; ?>" readonly>

				  <?php

				  	$galeria = json_decode($reservas[0]["galeria"], true);  /* echo '<pre class="bg-white">'; print_r($galeria); echo '</pre><br>';  */
				  
				  ?>

				  <img src="<?php echo $servidor.$galeria[0]; ?>" class="img-fluid">


				</div>

				<div class="form-group">
				 <label><a href="#infoPlanes" data-toggle="modal">Escoge tu Plan:</a> <small>(Precio sugerido para 2 personas)</small></label>
				  <select class="form-control">
				  	
				    <option value="americano">Plan Continental $ 1 día 1 noche</option>
					<option value="americano">Plan Americano $<?php echo number_format($precioAmericano); ?> 1 día 1 noche</option>
					<option value="romantico">Plan Romántico $<?php echo number_format($precioRomantico); ?> 1 día 1 noche</option>
					<option value="lunademiel">Plan Luna de Miel $<?php echo number_format($precioLunaDeMiel); ?> 1 día 1 noche</option>
					<option value="aventura">Plan Aventura $<?php echo number_format($precioAventura); ?> 1 día 1 noche</option>
					<option value="spa">Plan SPA $<?php echo number_format($precioSPA); ?> 1 día 1 noche</option>

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
						<!-- esto lo que viene por defecto al no cambiar el paln  --> <!-- Logica: valores obtenidas por ejeciccion desde la Url hacia abajo php puro  -->
						<h1 class="precioReserva"><span><?php echo number_format($precioContinental*$dias); ?></span> <span>MAD</span></h1> <!-- le ponemos una clase para manipular atraves de javascript en caso de : -que se surga algun cambio en el selecctor
					                                                                                                                           Lanzamos evento de javascript para manipular precio de una manera asincrona  -->

					</div>
					
					<div class="col-12 col-lg-6 col-xl-5">
				
						<a href="<?php echo $ruta;  ?>perfil">
							<button class="btn btn-dark btn-lg w-100">PAGAR <br> RESERVA</button>
						</a>

					</div>
			
				</div>

			</div> <!-- Col de derecha -->
			
			
		</div>  <!-- row  -->
		
	</div>   <!-- container  -->
	
</div>     <!-- div info reservas  -->

<!--=====================================
VENTANA MODAL PLANES
======================================-->
<div class="modal" id="infoPlanes">
	
	 <div class="modal-dialog modal-lg">
			
		<div class="modal-content">

			<div class="modal-header">
	        	<h4 class="modal-title text-uppercase">Habitación <?php echo $reservas[0]["tipo"].' '.$reservas[0]["estilo"]; ?></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>

	      	<div class="modal-body">

				<figure class="text-center">

       				<img src="<?php echo $servidor.$galeria[0]; ?>" class="img-fluid">

       			</figure>

				<p class="px-2"><?php echo $reservas[0]["descripcion_h"]; ?></p>

				<hr>

       			<div class="row">

       			<?php foreach ($planes as $key => $value): ?> <!-- ectura planes -->

					<div class="col-12 col-md-6">
						
						<h2 class="text-uppercase p-2">Plan <?php echo $value["tipo"]; ?></h2>

						<figure class="center">
	       					<img src="<?php echo $servidor.$value["img"]; ?>" class="img-fluid">
	       				</figure>

	       				<p class="p-2"><?php echo $value["descripcion"]; ?></p>

	       				<h4 class="px-2">Precio por pareja</h4>

       					<p class="px-2">

	       				Temporada Baja: Plan Americano + $ <?php echo number_format($value["precio_baja"]); ?> COP<br>

	       				Temporada Alta: Plan Americano + $ <?php echo number_format($value["precio_alta"]); ?> COP

	       				</p>


					</div>
       				
       			<?php endforeach ?>
       			
       			</div>

	      	</div>

	      	<div class="modal-footer">
        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      		</div>

		</div>

	</div>

</div>
