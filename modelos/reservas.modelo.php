<?php
 
require_once "conexion.php";
 
Class ModeloReservas{                                                                         /* la tabla principal aqui es la labla a 1 es decir a ella se hace la condicion el where   $tabla1 = "habitaciones";    
                                                                                                                                                                                         $tabla2 = "reservas";  agenda
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

	/*=============================================
	Guardar Reserva
	=============================================*/

	static public function mdlGuardarReserva($tabla, $id_habitacion, $pago_reserva, $numero_transaccion, $codigo_reserva, $descripcion_reserva, $fecha_ingreso, $fecha_Salida){   /*  $id_usuario, */

		session_start(); 
		$user_id = $_SESSION["id"];  

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_habitacion, id_usuario, pago_reserva, numero_transaccion, codigo_reserva, descripcion_reserva, fecha_ingreso, fecha_salida) VALUES (:id_habitacion, :id_usuario, :pago_reserva, :numero_transaccion, :codigo_reserva, :descripcion_reserva, :fecha_ingreso, :fecha_salida)");

		$stmt->bindParam(":id_habitacion", $id_habitacion, PDO::PARAM_STR);
	    $stmt->bindParam(":id_usuario", $user_id, PDO::PARAM_STR);   /*  , */
		$stmt->bindParam(":pago_reserva", $pago_reserva, PDO::PARAM_STR);
		$stmt->bindParam(":numero_transaccion", $numero_transaccion, PDO::PARAM_STR);
		$stmt->bindParam(":codigo_reserva", $codigo_reserva, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_reserva", $descripcion_reserva, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $fecha_ingreso, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_salida", $fecha_Salida, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Mostrar Reservas por Usuario
	=============================================*/

	static public function mdlMostrarReservasUsuario($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario ORDER BY id_reserva DESC LIMIT 5");

		$stmt -> bindParam(":id_usuario", $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
		
	}





}