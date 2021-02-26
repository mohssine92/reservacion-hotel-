<?php

require_once "conexion.php";

Class ModeloCategorias{

	/*=============================================
	mostrar Categorias
	=============================================*/
	
	static public function mdlMostrarCategorias($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_cat DESC LIMIT 3");  /* aqui dueño de la pagina debe decidir como debe mostrar , para tener un diseño agradable de la pagina  */ 
                                                                                                    /* como tiene un deseño solo para tres le mandamos solos los 3 categorias a la vista de los clientes  */
		$stmt -> execute();

		return $stmt -> fetchAll();  /* colleccion de objetos de tabla categoria  */

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Categoria Singular
	=============================================*/

	static public function mdlMostrarCategoria($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_cat = :id");

		$stmt -> bindParam(":id", $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	
	}


}