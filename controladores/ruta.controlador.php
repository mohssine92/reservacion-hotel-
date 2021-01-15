<?php


 
class ControladorRuta{

	static public function ctrRuta(){

		return "http://localhost/reservas-h/";  /* roota para uso frontend */ /* donde ponemos nuestro dominio en caso del desplegue en un vps  */

	}

	static public function ctrServidor(){

		return "http://localhost/reservas-h/backend/";   /*  returnar la ruta donde esta mi backend   */
	}

}