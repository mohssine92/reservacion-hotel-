<?php

require_once "../controladores/reservas.controlador.php";
require_once "../modelos/reservas.modelo.php";


class AjaxReservas{

	/*=============================================
	Traer Reserva Habitación - atraves id_habitacion
	=============================================*/

	public $idHabitacion;      

	public function ajaxTraerReserva(){

		$valor = $this->idHabitacion;

		$respuesta = ControladorReservas::ctrMostrarReservas($valor);

		echo json_encode($respuesta);

	}


	/*=============================================
	Traer Reserva a través de Código_reserva
	=============================================*/

	public $codigoReserva;

	public function ajaxTraerCodigoReserva(){

		$valor = $this->codigoReserva;

		$respuesta = ControladorReservas::ctrMostrarCodigoReserva($valor);

		echo json_encode($respuesta);   /* llave: valor Json */

	}

	/*=============================================
	Traer Reserva Habitaciones
	=============================================*/

	public $idHabitaciones;
	public $fechaIngreso;
	public $fechaSalida;
	
	public function ajaxTraerReservas(){

		$valor = $this->idHabitaciones;
		$fechaIngreso = $this->fechaIngreso;
		$fechaSalida = $this->fechaSalida;

		$respuesta = ControladorReservas::ctrMostrarReservas($valor); /* me devuelva todos registros de un id depende de tabla reservas - segnifica toda fechas donde este id_habitacion esta reservado */

		if($respuesta != 0){

			foreach ($respuesta as $key => $value) {  /* hacemos el array de fechas del id_h enlectura  */

				if($fechaIngreso == $value["fecha_ingreso"] || $fechaIngreso > $value["fecha_ingreso"] && $fechaIngreso < $value["fecha_salida"] || $fechaIngreso < $value["fecha_ingreso"] && $fechaSalida > $value["fecha_ingreso"]){

					echo json_encode($value["id_h"]);

					return; 

				} /* esta condicion , cuando se detecta algun cruze logico , me manda el d_ih , es decir todos id capturados en esta condicion seran occupadas en fechas eventos user  */ 
				  
				
			}
		}

		echo json_encode("");   /* if $respuesta == 0 , devuelvo en json vacio  */



		// echo json_encode($respuesta);

	}



} /* clase  AjaxReservas  */



/*=============================================
Traer Reserva Habitación       de aqui mandamos orden a la clase de ajax que es lo que se va ejecutar para devolver resultado a la function de success
=============================================*/

if(isset($_POST["idHabitacion"])){     /* Usada por escenarios : 1 y 2  */

	$idHabitacion = new AjaxReservas();
	$idHabitacion -> idHabitacion = $_POST["idHabitacion"];   /* asignar valor a la propiedad de la clase ajax  */
	$idHabitacion -> ajaxTraerReserva();      /* ejecutar un metodo */

}

/*=============================================
Traer Reserva a través de Código_reserva
=============================================*/

if(isset($_POST["codigoReserva"])){

	$codigoReserva = new AjaxReservas();
	$codigoReserva -> codigoReserva = $_POST["codigoReserva"];
	$codigoReserva -> ajaxTraerCodigoReserva();

}

/* Escenario 2 : */
/*=============================================
Traer Reservas Habitaciones 
=============================================*/

if(isset($_POST["idHabitaciones"])){

	$idHabitaciones = new AjaxReservas();
	$idHabitaciones -> idHabitaciones = $_POST["idHabitaciones"];
	$idHabitaciones -> fechaIngreso = $_POST["fechaingreso"];
	$idHabitaciones -> fechaSalida = $_POST["fechaSalida"];
	$idHabitaciones -> ajaxTraerReservas();

}


