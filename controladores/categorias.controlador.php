<?php

Class ControladorCategorias{

	/*=============================================
	Mostrar Categorias
	=============================================*/
    /* controla la tabla categorias  */
	static public function ctrMostrarCategorias(){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla);  /* cargada de collecion de objetos de categoria  */

		return $respuesta;

	}

}