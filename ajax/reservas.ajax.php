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


	public $id_habitacion;
	public $id_usuario;
	public $pago_reserva;
	public $numero_transaccion;
	public $codigo_reserva;
	public $descripcion_reserva;
	public $fecha_ingreso;
	public $fecha_Salida;

	public function ajaxInsertarDatosReserva(){

		
		$id_habitacion = $this->id_habitacion;
	/* 	$id_usuario = $this->id_usuario; */
		$pago_reserva = $this->pago_reserva;
		$numero_transaccion = $this->numero_transaccion;
		$codigo_reserva = $this->codigo_reserva;
		$descripcion_reserva = $this->descripcion_reserva;
		$fecha_ingreso = $this->fecha_ingreso;
		$fecha_Salida = $this->fecha_Salida;
		

		$respuesta = ControladorReservas::ctrGuardarReserva($id_habitacion,$pago_reserva,$numero_transaccion,$codigo_reserva,$descripcion_reserva,$fecha_ingreso,$fecha_Salida);  /* $id_usuario, */

		echo json_encode($respuesta);   /* llave: valor Json */

	}

	/*=============================================
	Traer Testimonios
	=============================================*/

	public $id_h;

	public function ajaxTraerTestimonios(){

		$item = "habitacion_id";
		$valor = $this->id_h;

		$respuesta = ControladorReservas::ctrMostrarTestimonios($item, $valor);  /* => devuelveme todoa testimonis relacionados con este  id habitacion   */

		echo json_encode($respuesta);

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


if(isset($_POST["id_habitacion"])){
   
  $datosReserva = new AjaxReservas();	
  $datosReserva-> id_habitacion = $_POST["id_habitacion"];
 /*  $datosReserva-> id_usuario =  1; */
  $datosReserva-> pago_reserva =  $_POST["pago_reserva"];
  $datosReserva-> numero_transaccion =  $_POST["numero_transaccion"];
  $datosReserva-> codigo_reserva =  $_POST["codigo_reserva"];
  $datosReserva-> descripcion_reserva =  $_POST["info_habitacion"];
  $datosReserva-> fecha_ingreso =  $_POST["fecha_ingreso"];
  $datosReserva-> fecha_Salida =  $_POST["fecha_salida"];
  $datosReserva-> ajaxInsertarDatosReserva();
	
   
}

/*=============================================
Traer Testimonios
=============================================*/

if(isset($_POST["id_h"])){

	$id_h = new AjaxReservas();
	$id_h -> id_h = $_POST["id_h"];
	$id_h -> ajaxTraerTestimonios();

}



