<?php


Class ControladorBanner{

	/*=============================================
	Mostrar banner
	=============================================*/
	/* controla la tabla banner */  /* el controlador es el que se va ejecutar ese metodo del modelo  */
	
	static public function ctrMostrarBanner(){ /* cuando se ejcute haga una peticion al modelo  */

		$tabla = "banner";  /* es una tabla */

		$respuesta = ModeloBanner::mdlMostrarBanner($tabla); /* trae respuesta del modelo banner   */

		return $respuesta;   /* este controlador va ser ejecutado desde la vista entces vamos a returnas la respuesta que nos traega el modelo  */

	}

}