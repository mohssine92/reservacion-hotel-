<?php

class ControladorAdministradores{

	/*=============================================
	Ingreso Administradores
	=============================================*/

	public function ctrIngresoAdministradores(){

		if(isset($_POST["ingresoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingresoPassword"])){

			

			    $encriptarPassword = crypt($_POST["ingresoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');   

			   	$tabla = "administradores";
			    $item = "usuario";
			    $valor = $_POST["ingresoUsuario"];

				$respuesta = ModeloAdministradores::mdlMostrarAdministradores($tabla, $item, $valor);

			   /* 	echo '<pre>'; print_r($respuesta); echo '</pre>'; */
				
				 if($respuesta["usuario"] == $_POST["ingresoUsuario"] && $respuesta["password"] == $encriptarPassword ){ /* => la contraseña viene de la base de datos increptada  */

					if($respuesta["estado"] == 1){

						$_SESSION["validarSesionBackend"] = "ok";
				 		$_SESSION["idBackend"] = $respuesta["id"]; /* => con este id puedo traer toda infs del usuario cuando se ingresa al systema  */

				 		echo '<script>

							window.location = "'.$_SERVER["REQUEST_URI"].'";

				 		</script>';   /* > lo vamos a inviar nuevamente a donde esatabamos  la misma ruta donde se lanza el formulario */

			 		}else{  /* cuando es == 0  */

			 		      /* 	echo "<div class='alert alert-danger mt-3 small'>ERROR: El usuario está desactivado</div>"; */
					       echo'<script>
      
					                swal({
					               		 type:"success",
					               		   title: "¡CORRECTO!",
					               		   text: "ERROR: El usuario está desactivado",
					               		   showConfirmButton: true,
					               		 confirmButtonText: "Cerrar"
					               	   
					                }).then(function(result){
               
					               		 if(result.value){   
					               			 window.location = "administradores";
					               		   } 
					                });
      
         			      	 </script>';
      
					      	  return;
      
					       
      
			 		}

				}else{

					/* echo "<div class='alert alert-danger mt-3 small'>ERROR: Usuario y/o contraseña incorrectos</div>";
                     */
					echo'<script>

				         	swal({
				         			type:"success",
				         			  title: "¡CORRECTO!",
				         			  text: "ERROR: Usuario y/o contraseña incorrectos",
				         			  showConfirmButton: true,
				         			confirmButtonText: "Cerrar"
				         		  
				         	}).then(function(result){
         
				         			if(result.value){   
				         				window.location = "administradores";
				         			  } 
				         	});
         
				         </script>';
         
				         return;
				}	

			}else{

				/* echo "<div class='alert alert-danger mt-3 small'>ERROR: No se permiten caracteres especiales</div>"; */
				     echo'<script>

				         	swal({
				         			type:"success",
				         			  title: "¡CORRECTO!",
				         			  text: "ERROR: No se permiten caracteres especiales",
				         			  showConfirmButton: true,
				         			confirmButtonText: "Cerrar"
				         		  
				         	}).then(function(result){
         
				         			if(result.value){   
				         				window.location = "administradores";
				         			  } 
				         	});
         
				         </script>';
         
				         return;
				
			}

		}

	}

	/*=============================================
	Mostrar Administradores
	=============================================*/

	static public function ctrMostrarAdministradores($item, $valor){

		$tabla = "administradores";
		/* $item = null */
        /* $valor = null */
		$respuesta = ModeloAdministradores::mdlMostrarAdministradores($tabla, $item, $valor);

		return $respuesta;

	} 

	/*=============================================
	Registro de administrador  - registro se efectua desde al panel dela dministrador 
	=============================================*/

	public function ctrRegistroAdministrador(){

		if(isset($_POST["registroNombre"])){

			if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["registroNombre"]) && /* => ojo nombre podra llevar espacio por eso el permitimos espacio */
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["registroPassword"])){

			  	$encriptarPassword = crypt($_POST["registroPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$'); 


				$tabla = "administradores";

				$datos = array("nombre" => $_POST["registroNombre"],
							   "usuario" =>  $_POST["registroUsuario"],
							   "password" => $encriptarPassword,
							   "perfil" => $_POST["registroPerfil"],
							   "estado" => 0);

							/*    var_dump($datos);
							   die(); */

				
				$respuesta = ModeloAdministradores::mdlRegistroAdministradores($tabla, $datos);
				
				if($respuesta == "ok"){

					echo'<script>

						swal({
								type:"success",
							  	title: "¡CORRECTO!",
							  	text: "El administrador ha sido creado correctamente",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "administradores";
								  } 
						});

					</script>';

				}


			}else{

				/* echo "<div class='alert alert-danger mt-3 small'>ERROR: No se permiten caracteres especiales</div>"; */

				echo'<script>

						swal({
								type:"success",
							  	title: "¡Error!",
							  	text: "El administrador no se ha creado no se permite ni espacio ni caracteres especiales",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "administradores";
								  } 
						});

					</script>';

					return;

			}

		}


	}

	/*=============================================
	Editar administrador
	=============================================*/
 
	public function ctrEditarAdministrador(){

		if(isset($_POST["editarNombre"])){  

			if(preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"])){

			   	if($_POST["editarPassword"] != ""){ /* => en caso se ha editado el password  */

			   		if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

			   			$password = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');  /* => nuevo pass debe incryptarlode nuevo */	

			   		}else{

			   			/* echo "<div class='alert alert-danger mt-3 small'>ERROR: No se permiten caracteres especiales</div>"; */
						   echo'<script>

					         	swal({
					         			type:"success",
					         		  	title: "¡Fallo!",
					         		  	text: "No se permite caracteres especiales en contraseña ",
					         		  	showConfirmButton: true,
					         			confirmButtonText: "Cerrar"
					         		  
					         	}).then(function(result){
         
					         			if(result.value){   
					         			    window.location = "administradores";
					         			  } 
					         	});
         
					         </script>';
						   
							  return;
 
			   		}

			   	}else{

			   		$password = $_POST["passwordActual"]; /* => password actual ya esta encryptado por eso no hace falta encryptarlo */
			   	}

				$tabla = "administradores";

				$datos = array("id"=> $_POST["editarId"],
							   "perfil" => $_POST["editarPerfil"],
							   "nombre" => $_POST["editarNombre"],
							   "usuario" => $_POST["editarUsuario"],
							   "password" => $password);

				
				$respuesta = ModeloAdministradores::mdlEditarAdministrador($tabla, $datos);
				
				if($respuesta == "ok"){

					echo'<script>

						swal({
								type:"success",
							  	title: "¡CORRECTO!",
							  	text: "El administrador ha sido editado correctamente",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    window.location = "administradores";
								  } 
						});

					</script>';

				}


			}else{

				/* echo "<div class='alert alert-danger mt-3 small'>ERROR: No se permiten caracteres especiales</div>"; */
				echo'<script>

					  swal({
					  		type:"success",
					  	  	title: "¡Fallo!",
					  	  	text: "Reviso los caracteres usado no se permiten  ",
					  	  	showConfirmButton: true,
					  		confirmButtonText: "Cerrar"
					  	  
					  }).then(function(result){
  
					  		if(result.value){   
					  		    window.location = "administradores";
					  		  } 
					  });
         
				 </script>';
						   
				return;
 
			}

		}

	}
  
	/*=============================================
	Eliminar Administrador
	=============================================*/

	 static public function ctrEliminarAdministrador($id){

		$tabla = "administradores";

		$respuesta = ModeloAdministradores::mdlEliminarAdministrador($tabla, $id);

		return $respuesta;

	} 



}