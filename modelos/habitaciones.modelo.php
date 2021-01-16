<?php

require_once "conexion.php";   

Class ModeloHabitaciones{

	/*=============================================
	MOSTRAR CATEGORIAS-HABITACIONES CON INNER JOIN
	=============================================*/

	static public function mdlMostrarHabitaciones($tabla1, $tabla2, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_cat = $tabla2.categoria_id WHERE ruta = :ruta");

		$stmt -> bindParam(":ruta", $valor, PDO::PARAM_STR);  /* asignar valor a parametro sql :ruta - darle valor que viene por parametro  */

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();         

		$stmt = null;

	}

  
}

  /* aqui tengo la respuesta : como sabemos que las rutas no deben coincidir cada ruta presenta una categoria del producto en este caso es habitacion , asi que usamos valor ruta en seleccionar el registro correspondiente en tabla categorias 
    por su puesto se va seleccionar su id .
    que a su vez es autoincremental es el factor importante que estamos usando en relacionarnos con tabla habitaciones , asi sabemos que este id de categoria tiene varios registros en tabla de habitaciones asi que como ya tenemos el id de categoria 
	con inner join podemos seleccionar todos registros en tabla de habitaciones con el id que tenemos asi ya ya tendremos respuesta trae todos objetos es decir todos registros en tabla habitaciones con este id seleccionado esto es todo  */
	/* asi ya tenemos disponible todo el registro de la tabla categoria + registros de la tabla habitaciones de la categoria elegida  */