<?php

/* necesito requirer el modelo y el controlador a donde voy a hacer las peticiones porque todo se hace de forma asincrona , sabes no esta asincronizado al index sino esta por separado , sabemos el index el que se requiere los modelos y controladores 
pero ARCHIVO ajax no esta conectado al index esta totalmente Separado , solo lo esta solicitando javascript entones necesito volver a requerir el modelo y el controlador de habitaciones en ajax    */
require_once "../modelos/habitaciones.modelo.php";
require_once "../controladores/habitaciones.controlador.php";


class AjaxHabitaciones{

	public $ruta;  

	public function ajaxTraerHabitacion(){

		$valor = $this->ruta;

		$respuesta = ControladorHabitaciones::ctrMostrarHabitaciones($valor);

		echo json_encode($respuesta);

	}

}

if(isset($_POST["ruta"])){   /* este es el objeto , el objeto se crea fuera de la classe - preguntanto si viene o no la variable post - la variable post que estamos enviando se llama ruta -   */

	$ruta = new AjaxHabitaciones();
	$ruta -> ruta = $_POST["ruta"];
	$ruta -> ajaxTraerHabitacion();

}

