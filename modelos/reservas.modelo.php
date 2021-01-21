<?php

require_once "conexion.php";
 
Class ModeloReservas{                                                                         /* la tabla principal aqui es la labla a 1 es decir a ella se hace la condicion el where   $tabla1 = "habitaciones";    
                                                                                                                                                                                         $tabla2 = "reservas";  
                                                                                                                                                                                         $tabla3 = "categorias";
                                                                                                 */
                                            
	/*=============================================
	MOSTRAR HABITACIONES-RESERVAS-CATEGORIAS CON INNER JOIN
	=============================================*/
	
	static public function mdlMostrarReservas($tabla1, $tabla2, $tabla3, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_h = $tabla2.id_habitacion INNER JOIN $tabla3 ON $tabla1.categoria_id = $tabla3.id_cat WHERE id_h = :id_h");

		$stmt -> bindParam(":id_h", $valor, PDO::PARAM_STR);      

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Codigo Reserva Singular
	=============================================*/

	static public function mdlMostrarCodigoReserva($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE codigo_reserva = :codigo_reserva");

		$stmt -> bindParam(":codigo_reserva", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
	
	}


}