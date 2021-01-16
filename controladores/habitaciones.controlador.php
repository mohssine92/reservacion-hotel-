<?php
  
require_once "modelos/habitaciones.modelo.php";  /*  este modelo se conecta a la base de datos y la base de datos dispone a estos 2 tablas que necesita este modelo asi que no hace falta incluir modelo de categorias que a su vez solicita tabla de categoria 
                                                  a la base de datos   */ 



Class ControladorHabitaciones{


	/*=============================================
	MOSTRAR CATEGORIAS-HABITACIONES CON INNER JOIN
	=============================================*/

	static public function ctrMostrarHabitaciones($valor){

		/* 2 tablas relacionadas  */ /* aqui puedas crear tercera tabla si hay tercera coincidencia sin problema  */
		$tabla1 = "categorias";
		$tabla2 = "habitaciones";

		$respuesta = ModeloHabitaciones::mdlMostrarHabitaciones($tabla1, $tabla2, $valor);  /* 3 parametros, dos tablas relacionadas y valor es una propiedad irrepetible de la tabla categorias  */

		return $respuesta;  /* ASI CON ESTA COLLECCION DE INFS PUEDO CONVERTIR EL MODULO INFO-HABITACIONES - EN MODULO DINAMICOS  */

	}  


}    

  /* aqui tengo la respuesta : como sabemos que las rutas no deben coincidir cada ruta presenta una categoria del producto en este caso es habitacion , asi que usamos valor ruta en seleccionar el registro correspondiente en tabla categorias 
    por su puesto se va seleccionar su id .
    que a su vez es autoincremental es el factor importante que estamos usando en relacionarnos con tabla habitaciones , asi sabemos que este id de categoria tiene varios registros en tabla de habitaciones asi que como ya tenemos el id de categoria 
	con inner join podemos seleccionar todos registros en tabla de habotaciones con el id que tenemos asi ya ya tendremos respuesta trae todos objetos es decir todos registros en tabla habitaciones con este id seleccionado esto es todo  */
  /* asi ya tenemos disponible todo el registro de la tabla categoria + registros de la tabla habitaciones de la categoria elegida  */