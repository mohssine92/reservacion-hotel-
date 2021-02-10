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




}