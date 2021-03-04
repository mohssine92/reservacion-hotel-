<?php

require_once "../controladores/reservas.controlador.php";
require_once "../modelos/reservas.modelo.php";

require_once "../controladores/testimonios.controlador.php";
require_once "../modelos/testimonios.modelo.php";

class AjaxUsuarios{

	/*=============================================
	Sumar reservas de usuarios
	=============================================*/	

	public $idUsuarioR;

	public function ajaxSumarReservas(){

		$respuesta = ControladorReservas::ctrMostrarReservas("id_u", $this->idUsuarioR);

		echo json_encode($respuesta);

	}

	/*=============================================
	Sumar testimonios de usuarios
	=============================================*/	

	public $idUsuarioT;

	public function ajaxSumarTestimonios(){

		$respuesta = ControladorTestimonios::ctrMostrarTestimonios("usuario_id", $this->idUsuarioT);

		echo json_encode($respuesta);

	}

}

/*=============================================
Sumar reservas de usuarios
=============================================*/	

if(isset($_POST["idUsuarioR"])){

	$sumaReserva = new AjaxUsuarios();
	$sumaReserva -> idUsuarioR = $_POST["idUsuarioR"];
	$sumaReserva -> ajaxSumarReservas();

}

/*=============================================
Sumar reservas de usuarios
=============================================*/	

if(isset($_POST["idUsuarioT"])){

	$sumaTestimonio = new AjaxUsuarios();
	$sumaTestimonio -> idUsuarioT = $_POST["idUsuarioT"];
	$sumaTestimonio -> ajaxSumarTestimonios();

}