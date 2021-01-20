<?php

Class ControladorReservas{

	/*=============================================
	Mostrar Reservas
	=============================================*/

	static public function ctrMostrarReservas($valor){

		$tabla1 = "habitaciones";  /* en tabla de habitaciones tengo id_categoria es el id de cada categoria en tabla de categorias, es el id de cada categoria al que pertenece cada habitacion  */
		$tabla2 = "reservas";      /* en tabla de reservas tengo id_habitacion es el id de cada habitacion en la tabla habitaciones , es decir la habitacion reservada en ciertas fechas  */
		$tabla3 = "categorias";    /* id de cada categoria esta en la tabla de habitaciones porque cada ciertas  habitaciones pertenecen a una categoria  */

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