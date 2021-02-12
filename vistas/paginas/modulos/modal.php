<?php

/*=============================================
CREAR EL OBJETO DE LA API GOOGLE
=============================================*/

$cliente = new Google_Client();      /* => dentro esta clase yengp codigo motor interectuarme conapi google */
$cliente->setAuthConfig('modelos/client_secret.json');  /* => paso como params las cerdenciales de autorizacion creados en app de google  */
$cliente->setAccessType("offline");
$cliente->setScopes(['profile','email']);   /* => los ecopes que necesirasmos  */
  /* => eso me va ayudar a generar la ruta del form  de la app de google */
/*=============================================
RUTA PARA EL LOGIN DE GOOGLE
=============================================*/

$rutaGoogle = $cliente->createAuthUrl();   /* =>  rura abra form google  */  /* la ponemos como ruta en nuestros form de nuestra aplicacion dende usuario da click para ingresarse atraves de google  */

/*=============================================
RECIBIMOS LA VARIABLE GET DE GOOGLE LLAMADA CODE , y otro variables , como paramertros en nuestra roota de aterrizaje 
=============================================*/
if(isset($_GET["code"])){  

	$token = $cliente->authenticate($_GET["code"]);    /* => sacar el token de este code  */

	$_SESSION['id_token_google'] = $token;   /* => crear la variable de session de google  */

	$cliente->setAccessToken($token);     /* pedimos  setAccessToken paraque nos devuelva el scopes  */



}

/*=============================================
RECIBIMOS LOS DATOS CIFRADOS DE GOOGLE EN UN ARRAY
=============================================*/
if($cliente->getAccessToken()){  /* => si es verdadero permitimos almacenar datos de usuario en $item  */

	$item = $cliente->verifyIdToken();   /* => este metedo me traega toda la verificacion de este token  */   /* => en $item  tengo toda informacion que necesito , paraque un usuario podra iniciar seesion en mi aplicacion ... */

	$datos = array("nombre"=>$item["name"],    /* => capto solo datos que me hacen falta , los organizo respecto al modelo de insert atraves de reder sociales , asi la validacion una validacion para redes sociales me vale ,  */
				   "email"=>$item["email"],
				   "foto"=>$item["picture"],
				   "password"=>"null",
				   "modo"=>"google",
				   "verificacion"=>1,
				   "email_encriptado"=>"null");

	$respuesta = ControladorUsuarios::ctrRegistroRedesSociales($datos);

	$verificarExistenciaUsuario = ControladorUsuarios:: ctrvVerificaccionEmailMode($datos); 

	if($verificarExistenciaUsuario == "existe"){

		echo ' <script>
		swal({
			type: "error",
            title: "¡ERROR!",
            text: "¡El correo electrónico ya está registrado con un método diferente a Google!",
            showConfirmButton: false,
			confirmButtonText: "Cerrar",
			allowOutsideClick: false
	
		}).then(function(result){

		  
			if(result.value){   
			  
				history.back();
			} 

             
		  });
		  
		  setTimeout(function(){
					
			window.location="http://localhost/reservas-h/";

	      },3000)
		
			
		</script>';



	}


	if($respuesta == "google-connect"){

			echo '<script>

			setTimeout(function(){
				
				window.location = "'.$ruta.'perfil";

			},1000);

			</script>';

	}

        
}






?>



<!--=====================================
VENTANA MODAL PLANES
======================================-->

<div class="modal" id="modalPlanes">
	
	 <div class="modal-dialog">
			
		<div class="modal-content">
			
	      	<div class="modal-header">
	        	<h4 class="modal-title text-uppercase"></h4>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>
			
	 		<div class="modal-body">
       			
       			<img src="" class="img-thumbnail">
    			
    			<p class="py-3"></p>
       			
       			<div class="text-center">
        			<a href="#habitaciones" class="btn btn-primary text-center  btnModalPlan" data-dismiss="modal">Separat tu habitacion Dt</a>
        		</div>

      		</div>

  		 	<div class="modal-footer">
        		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      		</div>

		</div> 	

	 </div>

</div>

<!--=====================================
VENTANA MODAL INGRESO
======================================-->

<div class="modal formulario" id="modalIngreso">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h4 class="modal-title">Ingresar</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->
       
      	<div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor:pointer">
					<i class="fab fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<div class="px-2 flex-fill">
                 <!-- https://console.cloud.google.com/apis/credentials?authuser=1&project=reservas-h-304520&supportedpurview=project -->
			    <!-- https://github.com/googleapis/google-api-php-client -->  <!-- codigo => motor que nos ayuda a conectar a la api de google desde lado del cliente . -->

			 <a href="<?php echo $rutaGoogle ;?>">   
				<p class="p-2 bg-danger text-center text-white" style="cursor:pointer">
					<i class="fab fa-google"></i>
					Ingreso con Google
				</p>
			 </a>		

			</div>

      	</div>

      	<!--=====================================
		INGRESO DIRECTO
		======================================-->

		<hr class="mt-0">

		<form method="post"> 

			<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
			      	<i class="far fa-envelope"></i>

			      </span>

			    </div>

			    <input type="email" class="form-control" placeholder="Email" name="ingresoEmail" required>

		  	</div>

		  	<div class="input-group mb-3">

			    <div class="input-group-prepend">

			      <span class="input-group-text">
			      	
					<i class="fas fa-unlock-alt"></i>

			      </span>

			    </div>

			    <input type="password" class="form-control" placeholder="Contraseña"  name="ingresoPassword" required>

		  	</div>
			

			<input type="submit" class="btn btn-dark btn-block" value="Ingresar">

			<?php

				$ingresoUsuario = new ControladorUsuarios();
				$ingresoUsuario -> ctrIngresoUsuario();

			?>

		</form>

      </div>


      <div class="modal-footer">
        
		¿No tiene una cuenta registrada? | 

		<strong>

			<a href="#modalRegistro" data-toggle="modal" data-dismiss="modal">
				Registrarse
			</a>

		</strong>

      </div>

    </div>

  </div>

</div>

<!--=====================================
VENTANA MODAL REGISTRO  
======================================-->

<div class="modal formulario" id="modalRegistro">	

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header bg-info text-white">
        <h4 class="modal-title">Registarse</h4>
        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">

      	<!--=====================================
		INGRESO CON REDES SOCIALES
		======================================-->
       
      	<div class="d-flex">
      		
			<div class="px-2 flex-fill">

				<p class="p-2 bg-primary text-center text-white facebook" style="cursor:pointer">
					<i class="fab fa-facebook"></i>
					Ingreso con Facebook
				</p>

			</div>

			<div class="px-2 flex-fill">
			<a href="<?php echo $rutaGoogle ;?>">   <!-- derige al form de la app de google , para ingresera rapidamente , recient configurado arriba del fichero  -->  <!-- google developper -->
				<p class="p-2 bg-danger text-center text-white" style="cursor:pointer">
					<i class="fab fa-google"></i>
					Ingreso con Google
				</p>
		   </a>		

			</div>

      	</div>
    
    <!--=====================================
    REGISTRO DIRECTO
    ======================================-->
    <hr class="mt-0">

			<form id="ok" method="post">        <!-- action="<?php $ruta; ?>./paginas/modulos/user.php" -->  <!-- => formulario de registro directo  -->
            
            	 <div class="input-group mb-3">
             
            	 	<div class="input-group-prepend">
             
            	 	  <span class="input-group-text">
            	 		  
            	 		  <i class="far fa-user"></i>
             
            	 	  </span>
             
            	 	</div>
             
            	 	<input type="text" class="form-control" placeholder="Nombre" name="Registrarnombre" required>
             
            	   </div>
            
            
            	  <div class="input-group mb-3">
              
            	  	<div class="input-group-prepend">
              
            	  	  <span class="input-group-text">
            	  		  
            	  		  <i class="far fa-envelope"></i>
              
            	  	  </span>
              
            	  	</div>
            
            		<input type="email" class="form-control" placeholder="Email" name="registroEmail" required>
            
            	  </div>
            
            	  <div class="input-group mb-3">
            
            		<div class="input-group-prepend">
            
            		  <span class="input-group-text">
            			  
            			<i class="fas fa-unlock-alt"></i>
            
            		  </span>
            
            		</div>
            
            		<input type="password" class="form-control" placeholder="Contraseña" name="registroPassword" required>
            
            	  </div>
            	
            
            	<input type="submit" class="btn btn-dark btn-block" value="Registrarse">
            
            	<?php
            
                  $registroUsuario = new ControladorUsuarios();
	       	   $registroUsuario -> ctrRegistroUsuario();
	           
            
            	?>
            
            </form>
     
     </div>
     
     
     <div class="modal-footer">
     
         ¿Ya tienes una cuenta registrada? | 
     
		<strong>

     	  <a href="#modalIngreso" data-toggle="modal" data-dismiss="modal">
     	     	Ingresar
          </a>
     
        </strong>
     
     </div>
     
    </div>
     
   </div>
     
</div>