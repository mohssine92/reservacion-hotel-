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

	static public function mdlGuardarReserva($tabla, $id_habitacion, $user_id, $pago_reserva, $numero_transaccion, $codigo_reserva, $descripcion_reserva, $fecha_ingreso, $fecha_Salida){   /*  $id_usuario, */

		$connection = Conexion::conectar();

		$stmt = $connection->prepare("INSERT INTO $tabla(id_habitacion, id_usuario, pago_reserva, numero_transaccion, codigo_reserva, descripcion_reserva, fecha_ingreso, fecha_salida) VALUES (:id_habitacion, :id_usuario, :pago_reserva, :numero_transaccion, :codigo_reserva, :descripcion_reserva, :fecha_ingreso, :fecha_salida)");

		$stmt->bindParam(":id_habitacion", $id_habitacion, PDO::PARAM_STR);
	    $stmt->bindParam(":id_usuario", $user_id, PDO::PARAM_STR);   /*  , */
		$stmt->bindParam(":pago_reserva", $pago_reserva, PDO::PARAM_STR);
		$stmt->bindParam(":numero_transaccion", $numero_transaccion, PDO::PARAM_STR);
		$stmt->bindParam(":codigo_reserva", $codigo_reserva, PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_reserva", $descripcion_reserva, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_ingreso", $fecha_ingreso, PDO::PARAM_STR);
		$stmt->bindParam(":fecha_salida", $fecha_Salida, PDO::PARAM_STR);

		if($stmt->execute()){

			
			$id = $connection->lastInsertId();  /* => para que nos funccina la funccion que returna last_id , tenemos que pasar la figura de conexion en una variable  */

			return $id;

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

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_usuario = :id_usuario ORDER BY id_reserva DESC LIMIT 20");

		$stmt -> bindParam(":id_usuario", $valor, PDO::PARAM_INT);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
		
	}

	/*=============================================
	Crear testimonio Vacío
	=============================================*/
	static public function mdlCrearTestimonio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(reserva_id, usuario_id, habitacion_id, testimonio, aprobado) VALUES (:id_res, :id_us, :id_hab, :testimonio, :aprobado)");

		$stmt->bindParam(":id_res", $datos["reserva_id"], PDO::PARAM_STR);
		$stmt->bindParam(":id_us", $datos["usuario_id"], PDO::PARAM_STR);
		$stmt->bindParam(":id_hab", $datos["habitacion_id"], PDO::PARAM_STR);
		$stmt->bindParam(":testimonio", $datos["testimonio"], PDO::PARAM_STR);
		$stmt->bindParam(":aprobado", $datos["aprobado"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok"; 

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	Mostrar testimonios
	=============================================*/

	static public function mdlMostrarTestimonios($tabla1, $tabla2, $tabla3, $tabla4, $item, $valor){


		$tabla1 = "testimonios";
		$tabla2 = "habitaciones";
		$tabla3 = "reservas";
		$tabla4 = "usuarios";

		$stmt = Conexion::conectar()->prepare("SELECT $tabla1.*, $tabla2.*, $tabla3.*,  $tabla4.* FROM $tabla1 INNER JOIN $tabla2 ON $tabla1.habitacion_id = $tabla2.id_h  INNER JOIN $tabla3 ON $tabla1.reserva_id = $tabla3.id_reserva  INNER JOIN $tabla4 ON $tabla1.usuario_id = $tabla4.id_u WHERE $item = :$item ORDER BY id_test DESC");

		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;
	}

	/*=============================================
	 Actualizar testimonio
	=============================================*/

	static public function mdlActualizarTestimonio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET testimonio = :testimonio WHERE id_test = :id_testimonio");

		$stmt -> bindParam(":testimonio", $datos["testimonio"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_testimonio", $datos["id_test"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt-> close();

		$stmt = null;

	}

	/*=============================================
	Mostrar Notificaciones
	=============================================*/

	static public function mdlMostrarNotificaciones($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo = :tipo");

		$stmt -> bindParam(":tipo", $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();

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