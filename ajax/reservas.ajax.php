<?php

require_once "../controladores/reservas.controlador.php";
require_once "../modelos/reservas.modelo.php";


class AjaxReservas{

	/*=============================================
	Traer Reserva Habitación
	=============================================*/

	public $idHabitacion;        /* la busqueda sera por id_habitacion */

	public function ajaxTraerReserva(){

		$valor = $this->idHabitacion;

		$respuesta = ControladorReservas::ctrMostrarReservas($valor);

		echo json_encode($respuesta);

	}



	

	
	

} /* clase  AjaxReservas  */

/*=============================================
Traer Reserva Habitación       de aqui mandamos orden a la clase de ajax que es lo que se va ejecutar para devolver resultado a la function de success
=============================================*/

if(isset($_POST["idHabitacion"])){      /* la variable post que hemos creado y lo hemos mandado a ajax dentro de variable data  */

	$idHabitacion = new AjaxReservas();
	$idHabitacion -> idHabitacion = $_POST["idHabitacion"];   /* asignar valor a la propiedad de la clase ajax  */
	$idHabitacion -> ajaxTraerReserva();      /* ejecutar un metodo */

}

