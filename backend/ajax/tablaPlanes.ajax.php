<?php

require_once "../controladores/planes.controlador.php";
require_once "../modelos/planes.modelo.php";

class TablaPlanes{

	/*=============================================
	Tabla Planes
	=============================================*/ 

	public function mostrarTabla(){

		$planes = ControladorPlanes::ctrMostrarPlanes(null, null);
		
		// $planes = [];  /* aprobar en caso no devueleve nada para saber si todo sustema funcciona bien  */

		if(count($planes)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{    

	 	"data": [ ';

	 	foreach ($planes as $key => $value) {

	 		/*=============================================
			IMAGEN
			=============================================*/	

			$imagen = "<img src='".$value["img"]."' class='img-fluid'>";
			
			/*=============================================
			ACCIONES
			=============================================*/

			$acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm editarPlan' data-toggle='modal' data-target='#editarPlan' idPlan='".$value["id"]."'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarPlan' idPlan='".$value["id"]."' imgPlan='".$value["img"]."'><i class='fas fa-trash-alt'></i></button></div>";	


			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$value["tipo"].'",
						"'.$imagen.'",
						"'.$value["descripcion"].'",
						"Mad '.number_format($value["precio_alta"]).'",
						"Mad '.number_format($value["precio_baja"]).'",
						"'.$acciones.'"
						
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

	}

}

/*=============================================
Tabla Planes
=============================================*/ 

$tabla = new TablaPlanes();
$tabla -> mostrarTabla();

