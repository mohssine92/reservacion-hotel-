<?php

class ControladorHabitaciones{

	/*=============================================
	MOSTRAR CATEGORIAS-HABITACIONES CON INNER JOIN
	=============================================*/

	static public function ctrMostrarHabitaciones($valor){

		$tabla1 = "categorias";
		$tabla2 = "habitaciones";

		$respuesta = ModeloHabitaciones::mdlMostrarHabitaciones($tabla1, $tabla2, $valor);

		return $respuesta;

	}

	/*=============================================
	Nueva habitación
	=============================================*/
	static public function ctrNuevaHabitacion($datos){

		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["estilo"]) && 
		   preg_match('/^[_\\a-zA-Z0-9]+$/', $datos["video"]) && 
		   preg_match('/^[\/\=\\&\\$\\;\\_\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcion"])){

            if ($datos["Galeria"] != "") {
                
				
				$galeria = json_decode($datos["Galeria"], true);  /*  es un array de galeria trae extensiones jpg y png  */

            
                $root = array();   /* aqui empujamos todas imagenes .png en en base 64 */

                for ($f = 0; $f < count($galeria); $f++) {
                    $image = $galeria[$f];

                    $porciones = explode(";", $image);
                    $porciones1 = explode("/", $porciones[0]);

                    if ($porciones1[1] == 'png') {
                        array_push($root, $image);   
                    }
                }

                
                
                $guardarRuta = array();    /* aqui se guardan todas routas genaradas para que se guardan en servidor y en base de datos .. */


      
                $rutaPng = array();  /* nuevas rootas generadas en proceso de png , se empuan aqui  */
                
                if($root && isset($root)) {      /* aqui se entra solo cuando es .png  */

                    for ($r = 0; $r < count($root); $r++) {
                        list($ancho, $alto) = getimagesize($root[$r]);

                        $nuevoAncho = 940;
                        $nuevoAlto = 480;

                        /*=============================================
                         Creamos el directorio donde vamos a guardar la imagen
                        =============================================*/
                        
                        $directorio = "../vistas/img/".$datos["tipo"];

                        array_push($rutaPng, strtolower($directorio."/".$datos["estilo"].($r+100).".jpg"));

                        $origen = imagecreatefrompng($root[$r]);   /* roota original */

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagealphablending($destino, false);
       
                        imagesavealpha($destino, true);
     
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $rutaPng[$r]);

                        array_push($guardarRuta, substr($rutaPng[$r], 3));
                    }
                    
                    
                }
              
                
                $galeriaFinal = array();   /* empujamos aqui solo jpeg */ /* asi evitamos png que viene por galeria , porque nos va a romper el proceso  */

                for ($a = 0; $a < count($galeria); $a++) {   

                    $imageF = $galeria[$a];

                    $porcione = explode(";", $imageF);
                    $porcione1 = explode("/", $porcione[0]);

                    if ($porcione1[1] != 'png') {
                        array_push($galeriaFinal, $imageF);
                    }
                }
  
				if($galeriaFinal && isset($galeriaFinal)){   /* como hemos declarado aqui tenemos solo los jpeg */
                
                     $ruta = array();
            
                      for ($i = 0; $i < count($galeriaFinal); $i++) {   /* squi todo lo que es jpg */
      
                          list($ancho, $alto) = getimagesize($galeriaFinal[$i]);
      
                          $nuevoAncho = 940;
                          $nuevoAlto = 480;
      
                          /*=============================================
                          Creamos el directorio donde vamos a guardar la imagen
                          =============================================*/
      
                          $directorio = "../vistas/img/".$datos["tipo"];
      
                          array_push($ruta, strtolower($directorio."/".$datos["estilo"].($i+1).".jpg"));  /* => aqui se empuja la ruta en el array  */
      
                          $origen = imagecreatefromjpeg($galeriaFinal[$i]);
      
                          $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
      
                          imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
      
                          imagejpeg($destino, $ruta[$i]);
      
                          array_push($guardarRuta, substr($ruta[$i], 3));
                      }

					  


                }
               
						
				$guardarRutaString = json_encode($guardarRuta);    /* pues aqui tanto los generados por proceso de jpeg y png  */
				
				$guardarRutaLimpia = str_replace('\/', '/', $guardarRutaString);  /* al convertir se genera dos caracteres de esta forma resolvemos asi  , si no genera no hace falta este proceso */
				
				
			}else{

				echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡La galería no puede estar vacía",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

				</script>';

				return;
			}

			if($datos["recorrido_virtual"] != ""){
				
				list($ancho, $alto) = getimagesize($datos["recorrido_virtual"]);

				$nuevoAncho = 4030;
				$nuevoAlto = 1144;

				$directorio = "../vistas/img/".$datos["tipo"];	

				$ruta360 = strtolower($directorio."/".$datos["estilo"]."-360.jpg");

				$origen = imagecreatefromjpeg($datos["recorrido_virtual"]);

				$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	

				imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

				imagejpeg($destino, $ruta360);	

			}else{

				echo'<script>

						swal({
								type:"error",
							  	title: "¡CORREGIR!",
							  	text: "¡El recorrido virtual no puede estar vacío",
							  	showConfirmButton: true,
								confirmButtonText: "Cerrar"
							  
						}).then(function(result){

								if(result.value){   
								    history.back();
								  } 
						});

				</script>';

				return;
			}

		 

			$tabla = "habitaciones";

			$datos = array("tipo_h" => $datos["tipo_h"],
							"estilo" => $datos["estilo"],
						    "Galeria" => ($guardarRutaLimpia),
							"video" => $datos["video"],
							"recorrido_virtual" => substr($ruta360,3),
							"descripcion_h" => $datos["descripcion"]);

			$respuesta = ModeloHabitaciones::mdlNuevaHabitacion($tabla, $datos);

			return $respuesta; 


		}else{

			echo '<script>

					swal({

						type:"error",
						title: "¡CORREGIR!",
						text: "¡No se permiten caracteres especiales en ninguno de los campos!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							history.back();

						}

					});	

				</script>';
		}


	}



	


}