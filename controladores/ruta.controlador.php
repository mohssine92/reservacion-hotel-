<?php


 
class ControladorRuta{

	static public function ctrRuta(){

		return "http://localhost/reservas-hotel-copia/";  /* roota para uso frontend */ /* donde ponemos nuestro dominio en caso del desplegue en un vps  */

	}

	static public function ctrServidor(){

		return "http://localhost/reservas-hotel-copia/backend/";   /* roota para uso en backend  */
	}

}