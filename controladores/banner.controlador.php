<?php

Class ControladorBanner{

	/*=============================================
	Mostrar banner
	=============================================*/
    /* controla la tabla banner */
	static public function ctrMostrarBanner(){

		$tabla = "banner";

		$respuesta = ModeloBanner::mdlMostrarBanner($tabla); /* se ejecuta esta funccion de esta clase modelo de manera statica  */

		return $respuesta;   /* asi que me carga $respuesta de una collecion de objetos de img  */

	}

}