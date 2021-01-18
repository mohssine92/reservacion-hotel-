<?php
  
Class ControladorHabitaciones{


	/*=============================================
	MOSTRAR CATEGORIAS-HABITACIONES CON INNER JOIN
	=============================================*/

	static public function ctrMostrarHabitaciones($valor){   /* estamos haciendo la seleccion atraves de innerjoin a la base de datos , recurda el parametro valor es esa ruta que captamos atraves $_GET['pagina'] , es una propiedad de de la tabla categoria  */
                                                            /* por eso lo estamos capturando como atributo de elemeto a , lo que es estamos capturando ej fichero habitaciones.js  */
	
	
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