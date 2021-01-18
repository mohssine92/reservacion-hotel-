<?php



Class ControladorRecorrido{

	/*=============================================
	Mostrar Recorrido
	=============================================*/
     /* controla la tabla reecorrido */
	static public function ctrMostrarRecorrido(){

		$tabla = "recorrido";

		$respuesta = ModeloRecorrido::mdlMostrarRecorrido($tabla);  /* sera cargada de la resupuesta del clase modelo recorrido con un objeto sacado de la tabla recorrsido */

		return $respuesta;

	}

}