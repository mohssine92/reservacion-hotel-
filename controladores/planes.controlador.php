<?php

Class ControladorPlanes{

	/*=============================================
	Mostrar Planes
	=============================================*/
    /* controla la tablas planes  */
	static public function ctrMostrarPlanes(){

		$tabla = "planes";

		$respuesta = ModeloPlanes::mdlMostrarPlanes($tabla);

		return $respuesta;  /* esta variable esta cargada de colleccion de objetos de los tipos y fotos y precios y fecha de la habitaciones en este caso  */

	}

}