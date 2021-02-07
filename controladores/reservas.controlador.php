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
	
	static public function ctrGuardarReserva($id_habitacion,$id_usuario,$pago_reserva,$numero_transaccion,$codigo_reserva,$descripcion_reserva,$fecha_ingreso,$fecha_Salida){   

		$tabla = "reservas";

		$respuesta = ModeloReservas::mdlGuardarReserva($tabla,$id_habitacion,$id_usuario,$pago_reserva,$numero_transaccion,$codigo_reserva,$descripcion_reserva,$fecha_ingreso,$fecha_Salida);

		return $respuesta;  /* => esta la respuesta que nos traega modelo la retornamos  */

	}



}