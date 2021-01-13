<?php

require_once "conexion.php";

Class ModeloRestaurante{

	/*=============================================
	mostrar Restaurante
	=============================================*/
	
	static public function mdlMostrarRestaurante($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();  /* saca  una colleccion de objetos de tipo restaurante  */

		$stmt -> close();

		$stmt = null;

	}

}