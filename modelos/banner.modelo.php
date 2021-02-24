<?php

require_once "conexion.php";

Class ModeloBanner{

	/*=============================================
	mostrar banner
	=============================================*/
	
	static public function mdlMostrarBanner($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC "); 

		$stmt -> execute();

		return $stmt -> fetchAll();   /* devuelve coleccion de objetos de la base de datos de la tabla banner  */ /*cuanto returnamos solo una fila usamo fetch  y varias filas con fetchall */

		$stmt -> close();  /* por seguridad - cerrar la sentencias isql   */

		$stmt = null;   /* vaciar el objeto  darle valor nulo*/

	}

}