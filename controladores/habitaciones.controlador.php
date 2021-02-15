<?php
  
Class ControladorHabitaciones{


	/*=============================================
	MOSTRAR CATEGORIAS-HABITACIONES CON INNER JOIN
	=============================================*/

	static public function ctrMostrarHabitaciones($valor){   
	
	
		/* 2 tablas relacionadas  */ /* treaer   */
		$tabla1 = "categorias";
		$tabla2 = "habitaciones";

		$respuesta = ModeloHabitaciones::mdlMostrarHabitaciones($tabla1, $tabla2, $valor);  /* 3 parametros, dos tablas relacionadas y valor es una propiedad irrepetible de la tabla categorias  */

		return $respuesta;  /* ASI CON ESTA COLLECCION DE INFS PUEDO CONVERTIR EL MODULO INFO-HABITACIONES - EN MODULO DINAMICOS  */


	}  

	/*=============================================
	Mostrar Habitación Singular
	=============================================*/
	
	static public function ctrMostrarHabitacion($valor){

		$tabla = "habitaciones";

		$respuesta = ModeloHabitaciones::mdlMostrarHabitacion($tabla, $valor);

		return $respuesta;

	}


}    

  