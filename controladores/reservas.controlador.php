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


}