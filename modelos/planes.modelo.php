<?php

require_once "conexion.php";

Class ModeloPlanes{

	/*=============================================
	mostrar Planes
	=============================================*/
	
	static public function mdlMostrarPlanes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll(); /* devuelva una collecion de objetos  de peopiedades de img tipo descri precio frcha de la tabla planes  */

		$stmt -> close();

		$stmt = null;

	}

}