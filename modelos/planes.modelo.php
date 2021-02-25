<?php

require_once "conexion.php";

Class ModeloPlanes{

	/*=============================================
	mostrar Planes
	=============================================*/
	
	static public function mdlMostrarPlanes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC LIMIT 4");  /* el html esta diseñado para mostrar 4 planes asi vamos a hacer un limite para los planes devueltos */

		$stmt -> execute();

		return $stmt -> fetchAll(); /* devuelva una collecion de objetos  de peopiedades de img tipo descri precio frcha de la tabla planes  */

		$stmt -> close();

		$stmt = null;

	}

}