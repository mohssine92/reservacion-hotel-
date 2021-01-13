<?php

require_once "conexion.php";

Class ModeloBanner{

	/*=============================================
	mostrar banner
	=============================================*/
	
	static public function mdlMostrarBanner($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();   /* devuelve coleccion de objetos de la base de datos de la tabla banner  */

		$stmt -> close();

		$stmt = null;

	}

}