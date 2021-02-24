<?php

require_once "../controladores/banner.controlador.php";
require_once "../modelos/banner.modelo.php";

class TablaBanner{

	/*=============================================
	Tabla Banner
	=============================================*/ 

	public function mostrarTabla(){

		$banner = ControladorBanner::ctrMostrarBanner(null, null);   /* => parametros nulos paraque me traega todo lo que se  encuentra en tabla banner en base de datos */

		if(count($banner)== 0){

 			$datosJson = '[]';

			echo $datosJson;

			return;

 		}

 		$datosJson = '[';  /* abrir la coleccion donde van a ir objetos json */

	 

	 	foreach ($banner as $key => $value) {

	 		/*=============================================
			IMAGEN
			=============================================*/	
			$imagen = "<img src='".$value['img']."' class='img-fluid'>";  /* cuedado con la imagenes no deben tener espacio en base de dastos  */
			
			/*=============================================
			ACCIONES
			=============================================*/
			 $acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm editarBanner' data-toggle='modal' data-target='#editarBanner' idBanner='".$value["id"]."'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm eliminarBanner' idBanner='".$value["id"]."' rutaBanner='".$value["img"]."'><i class='fas fa-trash-alt'></i></button></div>";	

			$datosJson .=   /* => objetos json recuperados de la tabla banner... */
                
				'{         
					 "id": "'.($key+1).'",                    
					 "img": "'.$imagen.'",
					 "Acciones":"'.$acciones.'"
					
				},';		
	 

		}

		$datosJson = substr($datosJson, 0, -1);  /* eleminar el ultimo caracter */

            
		$datosJson .= ']';  /* cierre de la coleeccion despues de agregar todos objetos  */

		echo $datosJson;

	}

}

/*=============================================
Tabla Banner
=============================================*/ 

$tabla = new TablaBanner();
$tabla -> mostrarTabla();

