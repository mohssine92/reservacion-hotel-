<?php


 
class ControladorRuta{

	static public function ctrRuta(){

		return "http://localhost/reservas-hotel/";  /* roota para uso frontend */ /* donde ponemos nuestro dominio en caso del desplegue en un vps  */

	}

	static public function ctrServidor(){

		return "http://localhost/reservas-hotel/backend/";   /*  returnar la ruta donde esta mi backend   */
	}

}