<?php

  $categorias = ControladorCategorias::ctrMostrarCategorias();
   /* echo '<pre class="bg-white">'; print_r($categorias); echo '</pre>'; */

   
    if(isset($_SESSION["validarSesion"])){
    
    	if($_SESSION["validarSesion"] == "ok"){ /* => no nosa sirve captar foto user en modo directo desde variable session , en caso de actualizar desde info-perfil , produzca fallo porque variable sessio sigue con valor ruta foto borrado , haste la cierre de session  */
    
    		$item = "id_u";
			$valor = $_SESSION["id"];

			
			

    
			$usuario = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

			

    
    	}
    
    }



?>  


<!--=====================================
HEADER
======================================-->

<header class="container-fluid p-0 bg-white">
	
	<div class="container p-0">
		
		<div class="grid-container py-2">

			<!-- LOGO -->
			
			<div class="grid-item">

				<a href="<?php echo $ruta;  ?>"> <!-- variable ruta raiz del proyecto  -->
				
					<img src="img/logoPortobelo.png" class="img-fluid">

				</a>

			</div>

			<div class="grid-item d-none d-lg-block"></div>

			<!-- CAMPANA Y RESERVA -->

			<div class="grid-item d-none d-lg-block bloqueReservas">
			  <!--  -->	
			  <div class="py-2 campana-y-reserva mostrarBloqueReservas" modo="abajo">

                <i class="fas fa-concierge-bell lead mx-2"></i>

                <i class="fas fa-caret-up lead mx-2 flechaReserva"></i>
   
              </div>	

				<!--=====================================
				FORMULARIO DE RESERVAS
				======================================-->
                 <!-- nesesito cada vez selecciono una categoria cambie este 2 selecct - primero ponerle los 2 required -->
				
			<form  action="<?php echo $ruta;  ?>reservas" method="post"> <!-- al enviar ya tenemos los siguientes variables :  name="id-habitacion" , name="fecha-ingreso" ,    name="fecha-salida"    -->

				<div class="formReservas py-1 py-lg-2 px-4">
					 <!-- para hacer el primer select dinamico se trata de las categorias  -->
					<div class="form-group my-4"> 
					 <select class="form-control form-control-lg selectTipoHabitacion " required>  <!-- como opcion se inicia su value vacio no deja pasar porque el seleccionador es un campo requerido   -->
                           <option value="">Tipo de habitación</option>  <!-- este necesitamos dejarlo por fuera  -->

					      <?php foreach ($categorias as $key => $value): ?>	
							<option value="<?php echo $value["ruta"]; ?>" ><?php echo $value["tipo"]; ?></option>	
							<!-- gracias a la ruta , con el valor de esa  ruta puedo seleccionar toda informacion de ambas tablas  --> <!-- puedo hacer inner join de tabla categoria y tabla habitaciones entoces necesito enviar la ruta  -->
							<!-- para nos sale los selcct anidado en funccion ed categoria vamos a trabajarlos en reserva.js -->
						  <?php endforeach ?>			
					 </select>

					</div>

					<div class="form-group my-4">
						<select class="form-control form-control-lg selectTemaHabitacion" name="id-habitacion" required>  <!-- segnifica no deja pasar cualquier opcion seleccionada su value es vacio value=" " -->
						
							<option value="" >Temática de habitación</option>  <!-- este value vacio en este caso no es importante porque el primero es vacio no deja pasar obliga seleccionar algun categoria , sabemos las categorias tiene value rellenado  -->
							 <!-- dejamos solo esta opcion para poder adicionar los demas select de manera dinamica usando peticiones ajax en reservas.js --> <!-- estara depende de evento change en la select de categoria -->
						</select>
					</div>

					<input type="hidden" id="ruta" name="ruta">  <!-- valor por javascript  -->

					<div class="row">
						
						 <div class="col-6 input-group input-group-lg pr-1"> 
						
							<input type="text" class="form-control datepicker entrada" autocomplete="off" name="fecha-ingreso" placeholder="Entrada" required>  <!--   autocomplete="off"   para que no me agregue historial al seleccionar fechas  -->
							<div class="input-group-append">
								
								<span class="input-group-text p-2">
									<i class="far fa-calendar-alt small text-gray-dark"></i>
								</span>
							
							</div>

						</div>

						<div class="col-6 input-group input-group-lg pl-1">
						
							<input type="text" class="form-control datepicker salida"  autocomplete="off"  name="fecha-salida" readonly placeholder="Salida" required> <!-- iniciamos con  readonly paraque no se puede tocar   -->

							<div class="input-group-append">
								
								<span class="input-group-text p-2">
									<i class="far fa-calendar-alt small text-gray-dark"></i>
								</span>
							
							</div>

						</div>

					</div>

					<input type="submit" class="btn btn-block btn-lg my-4 text-white" value="Ver disponibilidad">
					

				</div>

			</form>	 <!-- fin de formulario -->	

			</div>

			<!-- INGRESO DE USUARIOS -->

			<div class="grid-item d-none d-lg-block mt-2">

			<?php if (isset($_SESSION["validarSesion"])): ?>
				
				<?php if ($_SESSION["validarSesion"] == "ok"): ?>

                  <a href="<?php echo $ruta.'perfil'; ?>">   <!-- el aconr que llevario al user A LAPAGINA DE PERFIL  -->

				      
				    <?php if($usuario["foto"] == ""): ?>

					
				     	<i class="fas fa-user"></i>  <!-- => poner este icomo de imagen por defecto si el suario logeado no consta de ruta foto -->

			        
					  <?php else: ?>


					    <?php if($usuario["modo"] == "directo"): ?>  <!-- preguntamos ahora en que modo esta logueado , porque : si viene por redes sociales no necisitamos concatenar la ruta foto con ruta de nuestro servidos , viene ruta completa 
					                                                   desde un servidopr externo de redes sociales  -->

						 <img src="<?php echo $servidor.$usuario["foto"]; ?>" class="img-fluid rounded-circle" style="width:30px"> 
					
					    <?php else: ?>
						
						 <img src="<?php echo $usuario["foto"]; ?>" class="img-fluid rounded-circle" style="width:30px">  <!-- modo red social , ruta externa ,  -->

				
					    <?php endif ?>	  <!-- end $_SESSION["modo"] == "directo" -->

				
					<?php endif ?>	 <!-- enf $_SESSION["foto"] == "" -->

                 </a>   <!-- Fin  -->

				<?php endif ?>	     <!--  $_SESSION["validarSesion"] == "ok" -->

			<?php else: ?>      <!--isset($_SESSION["validarSesion"]) -->
              
			  <a href="#modalIngreso" data-toggle="modal"><i class="fas fa-user"></i></a>  <!-- => pues que se coloque la foto que viene por defecto  -->
			   
		
            <?php endif ?>	
				
            
			

			</div>

			<!-- SELECCIÓN DE IDIOMA -->

			<div class="grid-item d-none d-lg-block mt-1 idiomas">
				
				<span class="border border-info float-left p-1 bg-info text-white idiomaEs">ES</span>

				<span class="border border-info float-left p-1 bg-white text-dark idiomaEn">EN</span>

			</div>

			<!-- MENÚ HAMBURGUESA -->

			<div class="grid-item mt-1 mt-sm-3 mt-md-4 mt-lg-2 botonMenu">
				
				<i class="fas fa-bars lead"></i>

			</div>

		</div>

	</div>

</header>

<!--=====================================
MENÚ
======================================-->

<nav class="menu container-fluid p-0">
	
	<ul class="nav nav-justified py-2">
		
		<li class="nav-item">
			<a class="nav-link text-white" href="#planes">Planes</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white" href="#habitaciones">Habitaciones</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white" href="#pueblo">El pueblo</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white" href="#restaurante">Restaurante</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white" href="#contactenos">Contáctenos</a>
		</li>

		<li class="nav-item">
			
			<ul class="my-2 py-1">
				
				<li>
					<a href="#" target="_blank">
						<i class="fab fa-facebook-f text-white float-left mx-2"></i>
					</a>
				</li>

				<li>
					<a href="#" target="_blank">
						<i class="fab fa-twitter text-white float-left mx-2"></i>
					</a>
				</li>

				<li>
					<a href="#" target="_blank">
						<i class="fab fa-youtube text-white float-left mx-2"></i>
					</a>
				</li>

				<li>
					<a href="#" target="_blank">
						<i class="fab fa-instagram text-white float-left mx-2"></i>
					</a>
				</li>

			</ul>
			
		</li>

	</ul>


</nav>

<!--=====================================
MENÚ MÓVIL
======================================-->
<div class="menuMovil">
	
	<div class="row">
		
		<div class="col-6">
			
			<a href="#modalIngreso" data-toggle="modal">
				<i class=" fas fa-user lead ml-3 mt-4"></i>
			</a>

		</div>	

		<div class="col-6">
			
			<div class="float-right mr-3 mt-3 mr-sm-5 mt-sm-4">
				
				<span class="border border-info float-left p-1 bg-info text-white idiomaEs">ES</span>
				<span class="border border-info float-left p-1 bg-white text-dark idiomaEn">EN</span>

			</div>	

		</div>	

	</div>
	  

   <!-- formualrio  -->

   <form  action="<?php echo $ruta;  ?>reservas" method="post">
	    <div class="formReservas py-1 py-lg-2 px-4">	
    
         	<div class="form-group my-4">
         		<select class="form-control form-control-lg selectTipoHabitacion" required>     
					
				    <option value="">Tipo de habitación</option> 
					     
         			<?php foreach ($categorias as $key => $value): ?>     
         			<option value="<?php echo $value["ruta"]; ?>"><?php echo $value["tipo"]; ?></option>
         			<?php endforeach ?>
         			
         		</select>
	    	 </div>  
	    	    
         	<div class="form-group my-4">
         		<select class="form-control form-control-lg selectTemaHabitacion" name="id-habitacion"  required>     
					 
				   <option value="">Temática de habitación</option>
         			
         		</select>
	    	 </div>
	    	       
	    	 <input type="hidden" id="ruta" name="ruta">   
	    	   
         	<div class="row">
         		
         		 <div class="col-6 input-group input-group-lg pr-1">
			
					<input type="text" class="form-control datepicker entrada" autocomplete="off" name="fecha-ingreso" placeholder="Entrada" required> 
					
         			<div class="input-group-append">
         				
         				<span class="input-group-text p-2">
         					<i class="far fa-calendar-alt small text-gray-dark"></i>
         				</span>
         			
         			</div>     
         		</div>     
         		<div class="col-6 input-group input-group-lg pl-1">
         		
					 <input type="text" class="form-control datepicker salida"  autocomplete="off"  name="fecha-salida" readonly placeholder="Salida" required>     
         			<div class="input-group-append">
         				
         				<span class="input-group-text p-2">
         					<i class="far fa-calendar-alt small text-gray-dark"></i>
         				</span>
         			
         			</div>     
         		</div>     
	    	 </div>
	    	      
         	<input type="submit" class="btn btn-block btn-lg my-4 text-white" value="Ver disponibilidad">
         	
	     </div>
	</form>

	<ul class="nav flex-column mt-4 pl-4 mb-5">
		
		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#planesMovil">Planes</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#habitaciones">Habitaciones</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#pueblo">Recorrido por el pueblo</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#restaurante">Restaurante</a>
		</li>

		<li class="nav-item">
			<a class="nav-link text-white my-2" href="#contactenos">Contáctenos</a>
		</li>

	</ul>

</div>
