<?php

require_once "modelos/restaurante.modelo.php";  

Class ControladorRestaurante{

	/*=============================================
	Mostrar Restaurante
	=============================================*/
    /* controla la tabla restaurante  */
	static public function ctrMostrarRestaurante(){

		$tabla = "restaurante";

		$respuesta = ModeloRestaurante::mdlMostrarRestaurante($tabla); /* la variable sera cargada de una coleccion de objetos de typo restaurante  */

		return $respuesta;

	}

}

  