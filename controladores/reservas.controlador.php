<!--  este es el controlador que estoy usando para verificar disponiblidad de habitaciones o cita medicas  -->
						   <!-- 			/* habitaciones  */       /* tabla reserva => escenario1   , tabla reserva2 => escenario 2  -->  <!-- $tablas2 -->
							<!-- 			/* citas medicas    */    /* tabla agendas => escenario1   , tabla reserva2 => escenario 2  -->  <!-- $tabla2 -->																										




<?php

Class ControladorReservas{

	/*=============================================
	Mostrar Reservas
	=============================================*/

	static public function ctrMostrarReservas($valor){

		$tabla1 = "habitaciones"; 
		$tabla2 = "agenda";     /* sustituir con la tabla donde vamos a buscar la disponiblidad  */
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