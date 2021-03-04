<?php

require_once "../controladores/testimonios.controlador.php";
require_once "../modelos/testimonios.modelo.php";

class TablaTestimonios{

	/*=============================================
	Tabla Testimonios
	=============================================*/ 

	public function mostrarTabla(){

		$testimonios = ControladorTestimonios::ctrMostrarTestimonios(null, null);   /* trear todos resgistros de tabla testimonios */

		
		if(count($testimonios)== 0){

 			$datosJson = '{"data": []}';

			echo $datosJson;

			return;

 		}

 		$datosJson = '{

	 	"data": [ ';

	 	foreach ($testimonios as $key => $value) {

	 		$reservaUsuario = ControladorTestimonios::ctrMostrarTestimoniosInnerJoin("id_test", $value["id_test"]);   /* => testimonios - reservas - usuarios  (id_test) */

			/*=============================================
			ESTADO
			=============================================*/	

			if($value["aprobado"] == 0){

				$estado = "<button class='btn btn-dark btn-sm btnAprobar' estadoTestimonio='1' idTestimonio='".$value["id_test"]."'>Aprobar</button>";

			}else{

				$estado = "<button class='btn btn-info btn-sm btnAprobar' estadoTestimonio='0' idTestimonio='".$value["id_test"]."'>Aprobado</button>";
			}
			
			$datosJson.= '[
							
						"'.($key+1).'",
						"'.$reservaUsuario["codigo_reserva"].'",
						"'.$reservaUsuario["nombre"].'",
						"'.$reservaUsuario["descripcion_reserva"].'",
						"'.$value["testimonio"].'",
						"'.$estado.'",
						"'.$value["fecha_test"].'"
					
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson.=  ']

		}';

		echo $datosJson;

	}

}

/*=============================================
Tabla Testimonios
=============================================*/ 

$tabla = new TablaTestimonios();
$tabla -> mostrarTabla();

