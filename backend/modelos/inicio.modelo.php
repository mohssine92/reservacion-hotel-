<?php

require_once "conexion.php";

class ModeloInicio{

	/*=============================================
	Sumar Ventas
	=============================================*/

	static public function mdlSumarVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(pago_reserva) as total FROM $tabla");   /* => utulizo la funccion sum que es uan funccion de sql , paraque me sume todo valores que encuentre en la columna pagoreserva */
		                                                                                          /* y lo devuelva en una propiedad lo llame total para el consumo */

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mejor Habitación
	=============================================*/

	static public function mdlMejorHabitacion($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT MAX(descripcion_reserva) as mejor FROM $tabla");  /* funccionn sql, me devueleve cual es la discripcion reserva mas se repite en la columna , y el resultado devielto lo guardo en una prop mejor */

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Peor Habitación
	=============================================*/

	static public function mdlPeorHabitacion($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT MIN(descripcion_reserva) as peor FROM $tabla");  /* la descripcion menos se repita en su columna funccion de sql */ /* quizas hay mucha en mismo nivel , pero tomara la primera que encuentrem */

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Traer Foto Habitación
	=============================================*/

	static public function mdlTraerFotoHabitacion($tabla1, $tabla2, $valor){    /* reservas - habitaciones */

		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.id_habitacion = $tabla2.id_h WHERE descripcion_reserva = :descripcion_reserva");

		$stmt -> bindParam(":descripcion_reserva", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Notificaciones
	=============================================*/

	static public function mdlMostrarNotificaciones($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	Actualizar notificaciones
	=============================================*/

	static public function mdlActualizarNotificaciones($tabla, $tipo, $cantidad){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET cantidad = :cantidad WHERE tipo = :tipo");

		$stmt -> bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
		$stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			echo "\nPDO::errorInfo():\n";
    		print_r(Conexion::conectar()->errorInfo());

		}

		$stmt -> close();

		$stmt = null;


	}	


}