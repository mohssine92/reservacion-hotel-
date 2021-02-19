<?php

Class ControladorReservas{

	/*=============================================
	Mostrar Reservas
	=============================================*/

	static public function ctrMostrarReservas($valor){

		$tabla1 = "habitaciones"; 
		$tabla2 = "reservas";     /* sustituir con la tabla donde vamos a buscar la disponiblidad  */ /* reservas - reservas2 - agenda */
		$tabla3 = "categorias";    

		$respuesta = ModeloReservas::mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor);

		return $respuesta;   /* la lectura del array sera en el orden de las tablas al momento de hacer consulta  */ 

	}


	/*=============================================
	Mostrar Código Reserva Singular
	=============================================*/
	
	static public function ctrMostrarCodigoReserva($valor){

		$tabla = "reservas";

		$respuesta = ModeloReservas::mdlMostrarCodigoReserva($tabla, $valor);

		return $respuesta;

	}

	/*=============================================
	Guardar Reserva
	=============================================*/
	
	static public function ctrGuardarReserva($id_habitacion,$pago_reserva,$numero_transaccion,$codigo_reserva,$descripcion_reserva,$fecha_ingreso,$fecha_Salida){     /* ,$id_usuario */

		session_start(); 
		$user_id = $_SESSION["id"];  

		$tabla = "reservas";

		$respuesta = ModeloReservas::mdlGuardarReserva($tabla, $id_habitacion, $user_id, $pago_reserva, $numero_transaccion, $codigo_reserva, $descripcion_reserva, $fecha_ingreso, $fecha_Salida); /* => esperando last id insertado de reserva */ 
		/* problema mercado de pago */

		if($respuesta != ""){  /* => me devuelve last_id insertado */

			$tablaTestimonios = "testimonios";

			$datos = array("reserva_id" => $respuesta,
						   "usuario_id" => $user_id,
						   "habitacion_id" => $id_habitacion,
						   "testimonio" => "",
						   "aprobado" => 0);

			$crearTestimonio = ModeloReservas::mdlCrearTestimonio($tablaTestimonios, $datos);

			return $crearTestimonio;   /* => debe returnar ok para devolverlo a info perfil al mercado de pago  */
		}

		

	}

	/*=============================================
	Mostrar Reservas por usuario
	=============================================*/

	static public function ctrMostrarReservasUsuario($valor){

		$tabla = "reservas";

		$respuesta = ModeloReservas::mdlMostrarReservasUsuario($tabla, $valor);

		return $respuesta;
		
	}

	/*=============================================
	Mostrar Testimonios
	=============================================*/

	static public function ctrMostrarTestimonios($item, $valor){

		$tabla1 = "testimonios";
		$tabla2 = "habitaciones";
		$tabla3 = "reservas";
		$tabla4 = "usuarios";

		$respuesta = ModeloReservas::mdlMostrarTestimonios($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	Actualizar Testimonio
	=============================================*/

	public function ctrActualizarTestimonio(){

		if(isset($_POST["actualizarTestimonio"])){
			/* ?\\¿\\!\\¡\\:\\,\\.\\ */

			if(preg_match('/^[.a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["actualizarTestimonio"])){   /* va permitir pasar solo [] los caracteres declarados dentro */

				$tabla = "testimonios";

				$datos = array("id_test"=>$_POST["idTestimonio"],
							   "testimonio"=>$_POST["actualizarTestimonio"]);

				$respuesta = ModeloReservas::mdlActualizarTestimonio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

							swal({
									type:"success",
								  	title: "¡CORRECTO!",
								  	text: "El testimonio ha sido actualizado correctamente",
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