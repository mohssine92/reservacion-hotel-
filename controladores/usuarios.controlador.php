
<?php

use PHPMailer\PHPMailer\PHPMailer;   /* => coloco el uso de la libreria de php mailer para correos en php  */
use PHPMailer\PHPMailer\Exception;   /* =>  para mirar las excepcciones en caso que haya errores , asi como indica el creador en github */




 Class ControladorUsuarios{


   /*=============================================
    REGISTRO DE USUARIO
   =============================================*/
   public function ctrRegistroUsuario(){
 
	  if(isset($_POST["Registrarnombre"])){ 

	   
		if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["Registrarnombre"]) &&   /* => caracteres permitidos cuando se trata de coolocar el nombre espacio en blanco tambien est apermitido  */
		preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["registroEmail"]) && /* => caracteres permitidos cuando se trata de coolocar el email  */ 
		preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"]))   /* => caracteres permitidos cuando se trata de coolocar el password   */
		{

			   $encriptarEmail = md5($_POST["registroEmail"]); /* md5() => es funccion de php me encrypta cualquier dato quiero  */  /* pero no es tan seguro facil de decifrar  */
			 
			   $encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');  /* => encryptando contraseña de manera solida  */

			   $tabla = "usuarios";

			   /* almacenamiento la informacion que se va al modelo . es decir que vamos a subir a base de datos  */
			   $datos = array(  "nombre" => $_POST["Registrarnombre"],
								"password" => $encriptarPassword,
								"email"=> $_POST["registroEmail"],
								"foto" => "",       
								"modo" => "directo",   /* => modo directo es decir registro atraves de modo directo  */
								"verificacion" => 0,    /* 0 para lo correos que aun no estan registrados  */
								"email_encriptado" => $encriptarEmail
			   );

			   /*  echo '<pre class="bg-white">'; print_r($datos); echo '</pre><br>';   */

				/* cuando espero una respuesta pongo clasee estatica */ /* voy a esperar una respuesta del modelo */ /* registrar datos */
				$respnse = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

				

			   if($respnse == "ok") {    /* ok es una respuesta del controlador cuando inserta datos de un usuario con exito  */
				  
				   /*=============================================
					 VERIFICACIÓN CORREO ELECTRÓNICO
				   ============================================*/

				   date_default_timezone_set("Africa/Casablanca"); 

				   $ruta = ControladorRuta::ctrRuta();   /* => ruta del dominio , ruta fronrend , ruta pagina principal  */
				   
				   $mail = new PHPMailer;    /* => instaciando la clase de php mailer , lo busca autoload.php y lo incluye en este fichero paraque la usamos  */

				   $mail->CharSet = 'UTF-8';   /* => pedimos que los caracteres  sean latinos  */

				   $mail->isMail();    /* => para poder inviar correos directos  */

				   $mail->setFrom('mohcineikkou@gmail.com', 'mobmaroc');   /* => Le seteamos De donde viene el correo  */ /* aqui colocamos correo del systema mobmaroc ,  */

				   $mail->addReplyTo('mohcineikkou@gmail.com', 'mobmaroc');  /* => en caso la persona que reciba correo necesita responder este correo , pongamos esta clase, para responda a este mismo correo y misma persona    */

				   $mail->Subject = "Por favor verifique su dirección de correo electrónico";  /* => cual va ser el asunto de correo :  pasamos texto a esta propiedad de la clase phpMailer */

				   $mail->addAddress($_POST["registroEmail"]);  /* => aque direccion enviamos este correo ? : a la que viene por variable post en el momento de registrar */
				   
				   /* AHORA CUAL VA SER EL CONTENIDO DEL CORREO QUE VAMOS A ENVIAR :  */ /* como ves pasamos texto por paramtro al funccion de la clase phpMailer  */ /* esta funccion requiere una estructura en html  */
				   /* Importante las imagenens que utulizamos en estas plantilas deben estar ya subidas en  internet  */
				   $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

						   <center>
							   
							   <img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">

						   </center>

						   <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							   
							   <center>

								   <img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-email.png">

								   <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

								   <hr style="border:1px solid #ccc; width:80%">

								   <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta, debe confirmar su dirección de correo electrónico</h4>

								   <a href="'.$ruta.$encriptarEmail.'" target="_blank" style="text-decoration:none">
									   
									   <div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

								   </a>

								   <br>

								   <hr style="border:1px solid #ccc; width:80%">

								   <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>


							   </center>


						   </div>

					   </div>'
				   
				   
				   );  /* todo va dentro de comilla simple , porque dentro estoy usando comillas dobles */ /* se redericciona a la pagina pricipal porque esta config al tenemos en rutas amigables  */

				   $envio = $mail->Send();   /* => esta funccion manda el correo, asi que $envio sera true valida */

				   if(!$envio){

					   echo'<script>

						   swal({
								   type:"error",
									 title: "¡ERROR!",
									 text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["registroEmail"].$mail->ErrorInfo.', por favor inténtelo nuevamente",
									 showConfirmButton: true,
								   confirmButtonText: "Cerrar",
								   allowOutsideClick: false
								 
						   }).then(function(result){

								   if(result.value){   
									   history.back();
									 } 
						   });

					   </script>';

				   }else{


					   echo'<script>

						   swal({
								   type:"success",
									 title: "¡SU CUENTA HA SIDO CREADA CORRECTAMENTE!",
									 text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
									 showConfirmButton: true,
								   confirmButtonText: "Cerrar",
								   allowOutsideClick: false
								 
						   }).then(function(result){

								   if(result.value){   
									   history.back();
									 } 
						   });

					   </script>';
					   

				   }

					  
			   


			   }

			 
	   }else{
		 
		   echo'<script>

				   swal({
						   type:"error",
							 title: "¡CORREGIR!",
							 text: "¡No se permiten caracteres especiales en el nombre!",
							 showConfirmButton: true,
						   confirmButtonText: "Cerrar",
						   allowOutsideClick: false
						 
				   }).then(function(result){

						   if(result.value){   
							   history.back();
							 } 
				   });

			   </script>';

	   }
		   


   }
   

   }
   

   /*=============================================
   MOSTRAR USUARIO
   =============================================*/

   static public function ctrMostrarUsuario($item, $valor){

	   $tabla = "usuarios";

	   $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

	   return $respuesta;

   }

   /*=============================================
   ACTUALIZAR USUARIO
   =============================================*/
   static public function ctrActualizarUsuario($id, $item, $valor){

	   $tabla = "usuarios";

	   $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

	   return $respuesta;

   }

   /*=============================================
   INGRESO DE USUARIO DIRECTO
   =============================================*/

   public function ctrIngresoUsuario(){

	   if(isset($_POST["ingresoEmail"])){   /* => cuando lanza el formulario alli justo se crean las variables post */
		  /* 
		   echo $_POST["ingresoEmail"] ;
		   echo "<br>";
		   echo $_POST["ingresoPassword"] ;
		   echo "<br>";
		  */

		   if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])){

			   $encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
			   
			   $tabla = "usuarios";
			   $item = "email";
			   $valor = $_POST["ingresoEmail"];
			   
			   $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);   /* => recuerda no permitimos repitir email se va traer un registro de un usuario hahahaha  */
			   
			   if($respuesta["email"] ==  $_POST["ingresoEmail"] && $respuesta["password"] == $encriptarPassword){
			   
				   if($respuesta["verificacion"] == 0){
			   
						   echo'<script>
			   
							   swal({
									   type:"error",
										 title: "¡ERROR!",
										 text: "¡El correo electrónico aún no ha sido verificado, por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico para verificar la cuenta!",
										 showConfirmButton: true,
									   confirmButtonText: "Cerrar",
									   allowOutsideClick: false
			   
							   }).then(function(result){
			   
									   if(result.value){   
										   history.back();
										 } 
							   });
			   
						   </script>';
			   
						   return;   /* => return no deja la maquina compila lo siguiente es decir para la ejecuccion  */ /* cancela cualquier proceso que podra ejecutarse luego  */
			   
				   }else{
			   
					   $_SESSION["validarSesion"] = "ok";             /* => si ya esta validado se inicia la session justo de aqui  */
					   $_SESSION["id"] = $respuesta["id_u"];
					   $_SESSION["nombre"] = $respuesta["nombre"];
					   $_SESSION["foto"] = $respuesta["foto"];       /* => la ruta de foto es depende del modo  */
					   $_SESSION["email"] = $respuesta["email"];
					   $_SESSION["modo"] = $respuesta["modo"];	    /* => modo como inicio session en el sistema */
			   
					   $ruta = ControladorRuta::ctrRuta();
				 
					   /* => Redireccionar atraves de javascript */
					   echo '<script>
				   
						   window.location = "'.$ruta.'perfil";	
			   
					   </script>';
			   
				   }
			   
			   
			   }else{
			   
			   echo'<script>
			   
				   swal({
						   type:"error",
							 title: "¡ERROR!",
							 text: "¡El email o contraseña no coinciden!",
							 showConfirmButton: true,
						   confirmButtonText: "Cerrar"
						 
				   }).then(function(result){
			   
						   if(result.value){   
							   history.back();
							 } 
				   });
			   
			   </script>';
			   
			   }
			   
		   }else{
			   
			   echo'<script>
			   
				   swal({
						   type:"error",
							 title: "¡CORREGIR!",
							 text: "¡No se permiten caracteres especiales!",
							 showConfirmButton: true,
						   confirmButtonText: "Cerrar",
						   allowOutsideClick: false
													 
				   }).then(function(result){
			   
						   if(result.value){   
							   history.back();
							 } 
				   });
			   
			   </script>';
		   }



	   }

   }

   /*=============================================
   REGISTRO CON REDES SOCIALES
   =============================================*/

   static public function ctrRegistroRedesSociales($datos){

	   $tabla = "usuarios";
	   $item = "email";
	   $valor = $datos["email"];
	   $emailRepetido = false;
		

	   $verificarExistenciaUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);   /* => verificar si email existe en mi base de datos  */

	   if($verificarExistenciaUsuario){    /* => en caso que es verdadero es decir devuelva un registro  */

		   $emailRepetido = true;
		   
	   }else{

		   $registrarUsuario = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);   /* => entonces hacemos registro en nuestra base de datos ,coñoo hhh  */
		   
	   }

	   if($emailRepetido || $registrarUsuario == "ok"){   /* => no entro aqui esta que me encuentro registrado o me registra el systema con exito  */

		   $traerUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);	  /* => entonces traerme usuario  */

		   if($traerUsuario["modo"] == "facebook"){

			   session_start();  /* => con facebook conectamos atraves ajax , y al crear variables session tenemos quetener dusparada esta funccion si o si , cuestion de forma de ejecuccion entre php y javascript  */

			   $_SESSION["validarSesion"] = "ok";             /* => si ya esta validado se inicia la session justo de aqui  */
			   $_SESSION["id"] = $traerUsuario["id_u"];
			   $_SESSION["nombre"] = $traerUsuario["nombre"];
			   $_SESSION["foto"] = $traerUsuario["foto"];       /* => la ruta de foto es depende del modo  */
			   $_SESSION["email"] = $traerUsuario["email"];
			   $_SESSION["modo"] = $traerUsuario["modo"];	    /* => modo como inicio session en el sistema */
		   
			   return "facebook-connect";
		   
		   }else if($traerUsuario["modo"] == "google"){

			   $_SESSION["validarSesion"] = "ok";             /* => si ya esta validado se inicia la session justo de aqui  */
			   $_SESSION["id"] = $traerUsuario["id_u"];
			   $_SESSION["nombre"] = $traerUsuario["nombre"];
			   $_SESSION["foto"] = $traerUsuario["foto"];       /* => la ruta de foto es depende del modo  */
			   $_SESSION["email"] = $traerUsuario["email"];
			   $_SESSION["modo"] = $traerUsuario["modo"];	    /* => modo como inicio session en el sistema */

			   return "google-connect";

		   }else{

			   echo "";
		   }

		   
	   }


   }

   /*=============================================
	 COMPROBAR SI EMAIL RECIEN REGISTRADO POR OTRO METODO - AL MOMENTO DE CONECTAR CON GOOGLE
   =============================================*/
   
   static public function ctrvVerificaccionEmailMode($datos){

	   $tabla = "usuarios";
	   $item = "email";
	   $valor = $datos["email"];
	   
		
	   $verificarExistenciaUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);   /* => verificar si email existe en mi base de datos  */

	   if($verificarExistenciaUsuario && $verificarExistenciaUsuario['modo'] != "google" ){    /* => en caso que es verdadero es decir devuelva un registro  */

			return true;  
		   
	   }else{

		   return false;
	   }



   }

   
   /*=============================================
   CAMBIAR FOTO PERFIL
   =============================================*/

   public function ctrCambiarFotoPerfil(){

	  
	if(isset($_POST["idUsuarioFoto"]) && $_POST["idUsuarioFoto"] == $_SESSION["id"]){
	 

		   $fotoActual = $_POST["fotoActual"];   
		  
		   $ruta = "backend/".$_POST["fotoActual"];

		   if(isset($_FILES["cambiarImagen"]["tmp_name"]) && !empty($_FILES["cambiarImagen"]["tmp_name"])){

			   list($ancho, $alto) = getimagesize($_FILES["cambiarImagen"]["tmp_name"]);

			   $nuevoAncho = 500;
			   $nuevoAlto = 500;

			   /*=============================================
			   CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
			   =============================================*/

			   $directorio = "backend/vistas/img/usuarios/".$_POST["idUsuarioFoto"];

			   /*=============================================
			   PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
			   =============================================*/

			   if($fotoActual != "" && $_FILES["cambiarImagen"]["type"] == "image/jpeg" || $_FILES["cambiarImagen"]["type"] == "image/png" ){
				   
				   unlink($ruta);  /* => borrame la foto antigua */ /* para remplazarla con la nueva */ 

			   }else{

				   if(!file_exists($directorio)){	

					   mkdir($directorio, 0755);

				   }

			   }

			   /*=============================================
			   DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
			   =============================================*/

			  

			   if($_FILES["cambiarImagen"]["type"] == "image/jpeg"){

				   $aleatorio = mt_rand(100,999);

				   $rutanueva = $directorio."/".$aleatorio.".jpg";


				   $origen = imagecreatefromjpeg($_FILES["cambiarImagen"]["tmp_name"]);

				   $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

				   imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				   imagejpeg($destino, $rutanueva);	

			   }

			   else if($_FILES["cambiarImagen"]["type"] == "image/png"){

				   $aleatorio = mt_rand(100,999);

				   $rutanueva = $directorio."/".$aleatorio.".png";

				   $origen = imagecreatefrompng($_FILES["cambiarImagen"]["tmp_name"]);						

				   $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

				   imagealphablending($destino, FALSE);
	   
				   imagesavealpha($destino, TRUE);

				   imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				   imagepng($destino, $rutanueva);

			   }else{

           
           				echo'<script>
                   
           				swal({
           						type:"error",
           						  title: "¡CORREGIR!",
           						  text: "¡No se permiten formatos diferentes a JPG y/o PNG!",
           						  showConfirmButton: true,
           						confirmButtonText: "Cerrar"
           					  
           				}).then(function(result){
           
           						if(result.value){   
           							history.back();
           						  } 
           				});
           
           			</script>';
           
                   return;





			   }
			   $rutaAsubir = substr($rutanueva, 8);

	       }



	     	
		
	       $tabla = "usuarios";
		   $id = $_POST["idUsuarioFoto"];
		   $item = "foto";
			 
		    $valor =  $rutaAsubir;
		

		    $actualizarFotoPerfil = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

		    if($actualizarFotoPerfil == "ok"){

			   echo '<script>

				   swal({
					   type:"success",
						 title: "¡CORRECTO!",
						 text: "¡La foto de perfil ha sido actualizada!",
						 showConfirmButton: true,
					   confirmButtonText: "Cerrar"
					 
				   }).then(function(result){

						   if(result.value){   
							   history.back();
							 } 
				   });

			   </script>';

		   }

        }	

   }

   	/*=============================================
	  CAMBIAR PASSWORD
	=============================================*/

	public function ctrCambiarPassword(){

		if(isset($_POST["editarPassword"]) &&  $_POST["idUsuarioPassword"] ==  $_SESSION["id"] ){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

				$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";
				$id = $_POST["idUsuarioPassword"];
				$item = "password";
				$valor = $encriptar;

				$actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);   /* => este es metodo sirve para actualizar cualquier campo en tabla usuarios , segun item que pasamos */

				if($actualizarPassword == "ok"){

					echo '<script>

						swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡Sus datos han sido actualizados!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}

			}else{

				echo'<script>

					swal({
						type:"error",
					  	title: "¡CORREGIR!",
					  	text: "¡No se permiten caracteres especiales!",
					  	showConfirmButton: true,
						confirmButtonText: "Cerrar"
					  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';

		 	}


		}


	}

	
	/*=============================================
	RECUPERAR CONTRASEÑA
	=============================================*/
    public function ctrRecuperarPassword(){
	
		if(isset($_POST["emailRecuperarPassword"])){

		   if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["emailRecuperarPassword"])) {
			  
                /*=============================================
                  GENERAR CONTRASEÑA ALEATORIA
                =============================================*/
                
                function generarPassword($longitud){
                
                    $password = "";
					$patron = "1234567890abcdefghijklmnopqrstuvwxyz";
					
					 $max = strlen($patron)-1; 
                
                    for($i = 0; $i < $longitud ; $i++){
                
					   $password .= substr($patron,rand(0,$max),1);
					  
                    }
                
                    return $password;
                
				}
				
				$nuevaPassword = generarPassword(6);  /* => obtendra password generado  */

				$encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');    /* => llevar la contraseña aleatoria a la base de datos  */ /* => remplazarla por la que se ha olvidado señor don  */

				$tabla = "usuarios";
                $item = "email";
                $valor = $_POST["emailRecuperarPassword"];
                
				$traerUsuario = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);
				
				/* var_dump($traerUsuario); */

				if($traerUsuario){

					$id = $traerUsuario["id_u"];
					$item = "password";
					$valor = $encriptar;
					
					if($traerUsuario['modo'] == 'directo'){
						
						$actualizarPassword = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);  /* => actualizar contraseña en base de datos  */

					}else{

						echo'<script>

						     swal({
						     		type:"error",
						     		  title: "¡ERROR!",
						     		  text: " El correo introducido esta registrado recientemente atraves de redes sociales ",
						     		  showConfirmButton: true,
						     		  confirmButtonText: "Cerrar"
						     	  
						     }).then(function(result){
     
						     		if(result.value){   
						     			history.back();
						     		  } 
						     });

				     	</script>';


					}
					

					if($actualizarPassword  == "ok"){   /* => segnifica actualizo la base de datos correctamente  */

						/*=============================================
						VERIFICACIÓN CORREO ELECTRÓNICO
						=============================================*/

						date_default_timezone_set("Africa/Casablanca"); 

						$ruta = ControladorRuta::ctrRuta();

						$mail = new PHPMailer;

						$mail->CharSet = 'UTF-8';

						$mail->isMail();

						$mail->setFrom('mohcineikkou@gmail.com', 'mobmaroc');

						$mail->addReplyTo('mohcineikkou@gmail.com', 'mobmaroc');

						$mail->Subject = "Por favor verifique su dirección de correo electrónico";

						$mail->addAddress($_POST["emailRecuperarPassword"]);

						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
							<center>
								
								<img style="padding:20px; width:10%" src="https://tutorialesatualcance.com/tienda/logo.png">

							</center>

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							
								<center>
								
								<img style="padding:20px; width:15%" src="https://tutorialesatualcance.com/tienda/icon-pass.png">

								<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>

								<a href="'.$ruta.'" target="_blank" style="text-decoration:none">

								<div style="line-height:30px; background:#0aa; width:60%; padding:20px; color:white">			
									Haz click aquí
								</div>

								</a>

								<h4 style="font-weight:100; color:#999; padding:0 20px">Ingrese nuevamente al sitio con esta contraseña y recuerde cambiarla en el panel de perfil de usuario</h4>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

								</center>

							</div>

						</div>');

						$envio = $mail->Send();

						if(!$envio){

							echo'<script>

								swal({
										type:"error",
									  	title: "¡ERROR!",
									  	text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["emailRecuperarPassword"].$mail->ErrorInfo.', por favor inténtelo nuevamente",
									  	showConfirmButton: true,
										confirmButtonText: "Cerrar"
									  
								}).then(function(result){

										if(result.value){   
										    history.back();
										  } 
								});

							</script>';

						}else{


							echo'<script>

								swal({
									type:"success",
								  	title: "¡SU SOLICITUD HA SIDO RECIBIDA!",
								  	text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["emailRecuperarPassword"].' para su cambio de contraseña!",
								  	showConfirmButton: true,
									confirmButtonText: "Cerrar"
								  
								}).then(function(result){

										if(result.value){   
										    history.back();
										  } 
								});

							</script>';

						}	


					}


				}else{

					echo '<script>

						swal({
							type:"error",
						  	title: "¡ERROR!",
						  	text: "¡El correo no existe en el sistema, puede registrase nuevamente con ese correo!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar"
						  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

					</script>';

				}

			    
			
		   }else{

		        echo'<script>
        
		        	swal({
		        		type:"error",
		        		  title: "¡CORREGIR!",
		        		  text: "¡No se permiten caracteres especiales!",
		        		  showConfirmButton: true,
		        		confirmButtonText: "Cerrar"
		        	  
		        	}).then(function(result){
		        
		        			if(result.value){   
		        				history.back();
		        			  } 
		        	});
		        
		        </script>';
   
		   }	


		}


	}


	





















}