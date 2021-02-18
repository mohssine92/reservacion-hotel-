<?php


 
class ControladorRuta{

	static public function ctrRuta(){        /* para hacer la prueba con registro con facebook , ponemos https nos lo exige , google no  */

		return "https://localhost/reservas-h/";  /* roota para uso frontend */ /* donde ponemos nuestro dominio en caso del desplegue en un vps  */

	}

	static public function ctrServidor(){

		return "https://localhost/reservas-h/backend/";   /*  returnar la ruta donde esta mi backend   */
	}

}