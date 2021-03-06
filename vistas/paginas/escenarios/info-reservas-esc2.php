
<?php
 
if(isset($_POST["id-habitacion"])){             /* escenario 1 => llega valor id del producto  */     /* escenario 2 => llega valor ids de loa productos en string de la categoria seleccionada  */   

    //  echo '<pre class="bg-white">'; print_r($_POST["id-habitacion"]); echo '</pre><br>'; 
    //  echo '<pre class="bg-white">'; print_r($_POST["fecha-ingreso"]); echo '</pre><br>'; 
	//  echo '<pre class="bg-white">'; print_r($_POST["fecha-salida"]); echo '</pre><br>';  
	//  echo '<pre class="bg-white">'; print_r($_POST["ruta"]); echo '</pre><br>';  
	 
	$valor = $_POST["id-habitacion"] ;  /* recibo ids en string  */
	                                    /* convertir en array ids => seleccionar uno de ellos y mandarlo como id para la siguiente consulta  */ /* porque habitaciones de misma categoria o coches similares  */

	$reservas = ControladorReservas::ctrMostrarReservas($valor);  /*Recuerda objeto reservas trea 3 tablas */ /* trea todo tipo de informacion acerca de la habitacion a alquiler  */ /* es factor imporatant en validacion de fechas  */
	                                                              /* lo hemos usado en manipular precio de reserva  */
   
	$indice = 0;  /* lo uso en precio en caso  de que reservas devuelve resultado  */

	/* este habitacion nunca se reservo , asi pido al controladore de habitaciones que me traega informacion de id_habitacion que necesito   */
	/* tambien en el proyecto de mobilaria puedo seleccionar por agrupamiento sql , aprevecho las relaciones entre tablas , y cogo las prepiedades que me intereza  */  /* IMPORTANT */ /* tenemos la opcion de orm en Laravel */
	if(!$reservas){   

		$valor= $_POST["ruta"];   /* necesito recibir desde los formularios este valor ruta  si o si . asi la paso de manera occulta  */

		 $reservas = ControladorHabitaciones::ctrMostrarHabitaciones($valor);    /* devuelva groupo de habitaciones en  este categoria  */  /* aqui podemos cubrir nuestras necesidades pero si enotro caso podremos crear otro controlador y modelo donde 
																			   aplicamos un buen agrupamiento  */
        /*  echo '<pre class="bg-white">'; print_r($reservas); echo '</pre><br>';	 */																   
      
		foreach ($reservas as $key => $value) {       /* validacion me detecta el indice de habitacion en este grupo por categoria */
			                                          /* los datos que seleccionamos se ordenan por key ,  */
			if($value["id_h"] == $_POST["id-habitacion"]){

				$indice = $key;

			}
		}   /* aqui cuando hacemos la seleccion con rutas sabemos cada categoria tiene ruta propia , asi me va devolver todas habitaciones de esta ruta es decir todas habitaciones de esta categoria y lo ordena en un array es decir lo datos 
			relacionados con tadas tablas relacionadas , asi hacemos lecturas buscamos el id_habitacion que estamos comunicando cuando se detecta - captamos su indice , pues atraves de su idices logramos acceder a toda informacion recuperada 
			gracias a las relaciones entre tablas    */
	}





	$planes = ControladorPlanes::ctrMostrarPlanes(); /* tala planes */

	
	/*=============================================
	DEFINIR PRECIOS DE TEMPORADA
	=============================================*/

	date_default_timezone_set("Africa/Casablanca");  /* Definir Zona Horaria */ 
	$hoy = getdate();  /* aqui tengo hora actual de me zona , ami me interesa los dias , */
/* 	echo '<pre class="bg-white">'; print_r($hoy); echo '</pre><br>' */;      /* siempre cuando quier filtra uso el print para no fallar en escritura de propiedad */

     /* asi empiezo a filtrar - lo que para el hotel va ser temporada alta */
     if($hoy["mon"] == 12 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||  $hoy["mon"] == 1 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15 ||  $hoy["mon"] == 6 && $hoy["mday"] >= 15 && $hoy["mday"] <= 31 ||   $hoy["mon"] == 7 && $hoy["mday"] >= 1 && $hoy["mday"] <= 15){
     
	     /* depende de id_habitacion */ /* solo estoy traendo de tablas habitaciones Reservas Categorias */
          $precioContinental = $reservas[$indice]["continental_alta"];
	      $precioAmericano = $reservas[$indice]["americano_alta"];
	      /*debo emvocar con otro objeto la traeda de planes */
          $precioRomantico = $reservas[$indice]["americano_alta"] + $planes[0]["precio_alta"];
          $precioLunaDeMiel = $reservas[$indice]["americano_alta"] + $planes[1]["precio_alta"];
          $precioAventura = $reservas[$indice]["americano_alta"] + $planes[2]["precio_alta"];
          $precioSPA = $reservas[$indice]["americano_alta"] + $planes[3]["precio_alta"];
	
       
     }else{   

	      $precioContinental = $reservas[$indice]["continental_baja"];
	      $precioAmericano = $reservas[$indice]["americano_baja"];
	      $precioRomantico = $reservas[$indice]["americano_baja"] + $planes[0]["precio_baja"];
	      $precioLunaDeMiel = $reservas[$indice]["americano_baja"] + $planes[1]["precio_baja"];
	      $precioAventura = $reservas[$indice]["americano_baja"] + $planes[2]["precio_baja"];
	      $precioSPA = $reservas[$indice]["americano_baja"] + $planes[3]["precio_baja"];

     } /* end else */

    /*=============================================
	DEFINIR CANTIDAD DE DIAS DE LA RESERVA
	=============================================*/
    $fechaIngreso = new DateTime($_POST["fecha-ingreso"]);   /* DateTime Object  */                    /*  echo '<pre class="bg-white">'; print_r($fechaIngreso); echo '</pre><br>' */; 
	$fechaSalida = new DateTime($_POST["fecha-salida"]);                                            	/* echo '<pre class="bg-white">'; print_r($fechaSalida); echo '</pre><br>'; */  
	$diff = $fechaIngreso->diff($fechaSalida);    /* DateInterval */                                 	/* echo '<pre class="bg-white">'; print_r($diff); echo '</pre><br>'; */  
    $dias = $diff->days; 	                                                                           /*  echo '<pre class="bg-white">'; print_r($diff->days); echo '</pre><br>';   */

	if($dias == 0){

		$dias = 1;
	}
 

	


	
 
}else{
    /* al intentar accedder a este pagina sin id_habitacion no te dejo pasar - porque no tienes nada que putear aqui co??o   */
	echo '<script> window.location="'.$ruta.'"</script>';

}


?>


<!--=====================================
INFO RESERVAS
======================================-->

<!-- en los atributos tenemos captados informaciones obligatorio en este modulo de informacion reserva de habitacion  -->
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

				
																					 
				    <div class="infoDisponibilidad"></div> <!-- javascript lo esta rellenado de toda forma -->
				   

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
			
					<div id="calendar"></div>   <!-- calendario grande es un plugin integrado  -->  <!-- con atrrib idhabitacion se capta por javascript y se capta calendario y se manipula depende de disponiblidad -->

					<!--=====================================
					MODIFICAR FECHAS
					======================================	-->

					<h6 class="lead pt-4 pb-2">Puede modificar la fecha de acuerdo a los d??as disponibles:</h6>

                    <!-- en caso que no haya disponible fecha elegida aqui se puede cambiar las fechas en este formulario -->
					<!-- con este formulario se puede comprobar la disponiblidad del producto por fecha desde la base de datos  -->
					<form action="<?php echo $ruta; ?>reservas" method="post" ><!-- variables post que seran enviadas :  name="id-habitacion"  name="fecha-ingreso"   name="fecha-salida"     -->

					  <input type="hidden" name="id-habitacion" value="<?php echo $_POST["id-habitacion"]; ?>"> <!-- debe ir esta varaible $_POST["id-habitacion"] porque sobre este producto voy a busacar nueva fecha --> <!-- es decir sobre el mismo captado -->

					  <input type="hidden" name="ruta" value="<?php echo $_POST["ruta"]; ?>">

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
			BLOQUE DER              esta columna pareze cuando realmente el producto esta disponible a reservar  
			======================================	-->
           
                                                  <!-- siempre inicie escondido -->			
			<div class="col-12 col-lg-4 colDerReservas" style="display:none">

				<h4 class="mt-lg-5">C??digo de la Reserva:</h4>
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
				  <label>Habitaci??n:</label>
				
				 <!-- ESCENARIO 2 Y 3 DE RESERVAS -->
				 <input type="text" class="form-control tituloReserva" value="" readonly> <!-- aqui mostramos solo titulo de reserva o numero de gabitacion en un planta o matricula del coche etc , no mostramos ni foto ni nada  --> 
                  <!-- readonly input iditable -->
				</div>

				<div class="form-group">
				 <label><a href="#infoPlanes" data-toggle="modal">Escoge tu Plan:</a> <small>(Precio sugerido para 2 personas)</small></label>
				  <select class="form-control elegirPlan">  <!-- su value es value de la opcion seleccionada -->

					<option value="<?php echo $precioContinental;?>,Plan Continental">Plan Continental $<?php echo number_format($precioContinental); ?> 1 d??a 1 noche</option>
					<option value="<?php echo $precioAmericano;?>,Plan Americano">Plan Americano $<?php echo number_format($precioAmericano); ?> 1 d??a 1 noche</option>
					<option value="<?php echo $precioRomantico;?>,Plan Romantico">Plan Rom??ntico $<?php echo number_format($precioRomantico); ?> 1 d??a 1 noche</option>
					<option value="<?php echo $precioLunaDeMiel;?>,Plan Luna de Miel">Plan Luna de Miel $<?php echo number_format($precioLunaDeMiel); ?> 1 d??a 1 noche</option>
					<option value="<?php echo $precioAventura;?>,Plan Aventura">Plan Aventura $<?php echo number_format($precioAventura); ?> 1 d??a 1 noche</option>
					<option value="<?php echo $precioSPA;?>,Plan SPA">Plan SPA $<?php echo number_format($precioSPA); ?> 1 d??a 1 noche</option>

				  </select>
				</div>
				
				<div class="form-group">
				  <label>Personas:</label>
				  <select class="form-control cantidadPersonas"> <!--en clase ponemos  cantidadPersonas : para poder seleccionar el selecctor en javascript para obtener su value y agregar precio en funccion de persona    -->
				                                                  <!-- logica : manipular precio final de manera asincrona gracias a javascript  -->  	
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>

				  </select>
				</div>

				<div class="row py-4">

					<div class="col-12 col-lg-6 col-xl-7 text-center text-lg-left"> 
						<!-- esto lo que viene por defecto al no cambiar el paln  --> <!-- Logica: valores obtenidas por ejeciccion desde la Url hacia abajo php puro  -->
						<h1 class="precioReserva"><span><?php echo number_format($precioContinental*$dias); ?></span><br> MAD</h1> <!-- le ponemos una clase para manipular atraves de javascript en caso de : -que se surga algun cambio en el selecctor
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
	        	<h4 class="modal-title text-uppercase">Habitaci??n <?php echo $reservas[0]["tipo"].' '.$reservas[0]["estilo"]; ?></h4>
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
