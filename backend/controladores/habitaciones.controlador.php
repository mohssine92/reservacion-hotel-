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

          
 
            if($datos["Galeria"] != "" && !empty($datos["Galeria"]) ) {
                
				
				
				$galeria = json_decode($datos["Galeria"], true);  /* viene como string ==>  es un array de galeria trae extensiones jpg y png  */ 

                
                $root = array();   /* aqui empujamos todas imagenes .png en en base 64 */
                for($f = 0; $f < count($galeria); $f++) {
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
            
                      for($i = 0; $i < count($galeriaFinal); $i++) {   /* squi todo lo que es jpg */
      
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

               if(empty($datos["Galeria"])){
				   
				  return "errorGaleria";

			   }
              

			}
				
		
			if(isset($datos["recorrido_virtual"]) && $datos["recorrido_virtual"] != 'undefined' ){

				$foto360 = $datos["recorrido_virtual"];
				$porciones = explode(";", $foto360);
				$porcionA = $porciones[0];
				$typeArr = explode("/", $porcionA);
				$type =  $typeArr[1];

				if($type == 'jpeg' || $type == 'jpg'){

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

					 list($ancho, $alto) = getimagesize($datos["recorrido_virtual"]);
     			     
				     $nuevoAncho = 4030;
				     $nuevoAlto = 1144;
 
					 $directorio = "../vistas/img/".$datos["tipo"];	
     
					 $ruta360 = strtolower($directorio."/".$datos["estilo"]."-360.jpg");
     
				     $origen = imagecreatefrompng($datos["recorrido_virtual"]);   /* roota original */
     
				     $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
     
				     imagealphablending($destino, false);
     
				     imagesavealpha($destino, true);
     
				     imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
     
				     imagepng($destino,  $ruta360);
                   
				

				}
				
				

			}else{

				return "errorRecorridoVirtual";

			}

		 
            if($datos["descripcion"] == '<p><br data-cke-filler="true"></p>'){

             
				return "errorDescripcion";


			}else{
               
		 
				 if(isset($guardarRutaLimpia)){

					   $tabla = "habitaciones";
        
					   $datos = array("tipo_h" => $datos["tipo_h"],
					   				"estilo" => $datos["estilo"],
					   				"Galeria" => ($guardarRutaLimpia),
					   				"video" => $datos["video"],
					   				"recorrido_virtual" => substr($ruta360,3),
					   				"descripcion_h" => $datos["descripcion"]);
		   
					   $respuesta = ModeloHabitaciones::mdlNuevaHabitacion($tabla, $datos);
		   
					   return $respuesta; 





				 }



			}
			

		}else{

			return "error";
		
		}


	}

	/*=============================================
	  Editar habitación
	=============================================*/

	static public function ctrEditarHabitacion($datos){

		if(preg_match('/^[-\\_\\a-zA-Z0-9]+$/', $datos["video"]) && 
		   preg_match('/^[\/\=\\&\\$\\;\\_\\-\\|\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $datos["descripcion"])){
		   	
			//Validamos que la galería no venga vacía

		   	if($datos["galeriaAntigua"] == "" && $datos["Galeria"] == ""){

				return "errorGaleria";

			}
            if($datos["descripcion"] == '<p><br data-cke-filler="true"></p>') {
                
				return "errorDescripcion";

            }  

			//Eliminar las fotos de la galería de la carpeta   /* todos fotos vienen de la base de datos viene en jpeg / jpg  */

			$traerHabitacion = ModeloHabitaciones::mdlMostrarHabitaciones("categorias", "habitaciones", $datos["idHabitacion"]);   /* traer datos de solo esa habitacion */

			if($datos["galeriaAntigua"] != ""){	   /* segnifica que voy a eleminar fotos que ya no voy a utulizar  */

				$galeriaBD = json_decode($traerHabitacion["galeria"], true);   /* json_decode — Decodifica un string de JSON  */ /* lo que esta en base de datos */

				$galeriaAntigua = explode("," , $datos["galeriaAntigua"]);    /* explode — Divide un string en varios string */  /* lo que llego de base de datos pero sufrio unas eleminaciones */

				$guardarRuta = $galeriaAntigua;   /* => tenemos todas rutas de galeria antigua actualizada es decir si sufrio algun eleminacion ya actualizada  en este array  */
		
				$borrarFoto = array_diff($galeriaBD, $galeriaAntigua);  /* Compara array $galeriaBD con uno o más arrays y devuelve los valores de array $galeriaBD que no estén presentes en ninguno de los otros arrays. */

				foreach ($borrarFoto as $key => $valueFoto){
						
					unlink("../".$valueFoto);   /* => elemino las rutas de imagenes  las que ya no estan presentes  */ /* porque usuario la elemino del array que se va a procecer para actualizar , pues la tengo que borrar de mi servidor  */

				}

			}else{

                /* => si viene vacio segnifica se ha borrado todos fotos de la galeria antigua asi elemino las rutas de fotos de galeria antigua todas  */
				$galeriaBD = json_decode($traerHabitacion["galeria"], true);   /* => array */

				foreach ($galeriaBD as $key => $valueFoto){

					unlink("../".$valueFoto);

				}

				
			}
		   	
		   	// Cuando vienen fotos nuevas

		   	if($datos["Galeria"] != ""){


				$guardarRuta = array();    /* aqui se guardan todas routas genaradas para que se guardan en servidor y en base de datos .. */
			  
		
				/* => al final del proceso estos dos array tiene que ir en un array */
				$galeria = json_decode($datos["Galeria"], true);    /* json_decode => Convierte un string codificado en JSON a una variable de PHP. */ /* esta mezclado entre jpeg y png  */
				$galeriaAntigua = explode("," , $datos["galeriaAntigua"]);  /* explode => Devuelve un array de string,  */ /* este en jpg  */


				$root = array();   /* aqui empujamos todas imagenes .png en en base 64 */
                for($f = 0; $f < count($galeria); $f++) {
                   
					$image = $galeria[$f];

                    $porciones = explode(";", $image);
                    $porciones1 = explode("/", $porciones[0]);

                    if ($porciones1[1] == 'png') {
                        array_push($root, $image);   
                    }

                }

				
                
                if($root && isset($root)) {      /* aqui se entra solo cuando es .png  */

					$rutaPng = array();  /* nuevas rootas generadas en proceso de png , se empuan aqui  */

                    for ($r = 0; $r < count($root); $r++) {
                        list($ancho, $alto) = getimagesize($root[$r]);

                        $aleatorio = mt_rand(100, 999);

                        $nuevoAncho = 940;
                        $nuevoAlto = 480;

                        /*=============================================
                         Creamos el directorio donde vamos a guardar la imagen
                        =============================================*/
                        
                        $directorio = "../vistas/img/".$datos["tipo"];

                        array_push($rutaPng, strtolower($directorio."/".$datos["estilo"].$aleatorio.".jpg"));

                        $origen = imagecreatefrompng($root[$r]);   /* roota original */

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagealphablending($destino, false);
       
                        imagesavealpha($destino, true);
     
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $rutaPng[$r]);

                        array_push($guardarRuta, substr($rutaPng[$r], 3));  /* => despues de procesar se empuja al array que se va a la base de datos  */
                    }
                }


				$galeriaFinal = array();   /* empujamos aqui solo jpeg */ /* asi evitamos png que viene por galeria , porque nos va a romper el proceso  */
                for ($a = 0; $a < count($galeria); $a++) {   

                    $imageF = $galeria[$a];

                    $porcione = explode(";", $imageF);
                    $porcione1 = explode("/", $porcione[0]);

                    if($porcione1[1] != 'png') {
                        
						array_push($galeriaFinal, $imageF);

                    }
                }


				if($galeriaFinal && isset($galeriaFinal)){   /* como hemos declarado aqui tenemos solo los jpeg */
                
					$ruta = array();
		   
					 for ($i = 0; $i < count($galeriaFinal); $i++) {   /* squi todo lo que es jpg */
	 
						 list($ancho, $alto) = getimagesize($galeriaFinal[$i]);
	 
						 $nuevoAncho = 940;
						 $nuevoAlto = 480;

						 $aleatorio = mt_rand(1000,9999); 
	 
						 /*=============================================
						 Creamos el directorio donde vamos a guardar la imagen
						 =============================================*/
	 
						 $directorio = "../vistas/img/".$datos["tipo"];
	 
						 array_push($ruta, strtolower($directorio."/".$datos["estilo"].$aleatorio.".jpg"));  /* => aqui se empuja la ruta en el array  */
	 
						 $origen = imagecreatefromjpeg($galeriaFinal[$i]);
	 
						 $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
	 
						 imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
	 
						 imagejpeg($destino, $ruta[$i]);
	 
						 array_push($guardarRuta, substr($ruta[$i], 3));
					 }

					 


			   }


	         	// Agregamos las fotos antiguas

				if($datos["galeriaAntigua"] != ""){

					foreach ($galeriaAntigua as $key => $value) {   
						
						array_push($guardarRuta, $value);  /* $galeriaAntigua => unirla a la galeria nueva a subir a base de datos */ 

					}

				}

			}

			//Cuando viene recorrido virtual nuevo

			if($datos["recorrido_virtual"] != "undefined"){	

               $foto360 = $datos["recorrido_virtual"];
               $porciones = explode(";", $foto360);
			   $porcionA = $porciones[0];
			   $typeArr = explode("/", $porcionA);
			   $type =  $typeArr[1];
			  

			   if($type == 'jpeg' || $type == 'jpg'){

                    unlink("../".$datos["antiguoRecorrido"]);
				    
				    list($ancho, $alto) = getimagesize($datos["recorrido_virtual"]);
    
				    $nuevoAncho = 4030;
				    $nuevoAlto = 1144;
    
				    $directorio = "../vistas/img/".$datos["tipo"];	
    
				    $ruta360 = strtolower($directorio."/".$datos["estilo"]."-360.jpg");
    
				    $origen = imagecreatefromjpeg($datos["recorrido_virtual"]);
    
				    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);	
    
				    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
    
				    imagejpeg($destino, $ruta360);
    
				    $ruta360 = substr($ruta360,3);	


			   }else{
       
			    	 unlink("../".$datos["antiguoRecorrido"]);

				     list($ancho, $alto) = getimagesize($datos["recorrido_virtual"]);
     
				     
				    $nuevoAncho = 4030;
				    $nuevoAlto = 1144;

					$directorio = "../vistas/img/".$datos["tipo"];	
     
					$ruta360 = strtolower($directorio."/".$datos["estilo"]."-360.jpg");
     
				     $origen = imagecreatefrompng($datos["recorrido_virtual"]);   /* roota original */
     
				     $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
     
				     imagealphablending($destino, false);
     
				     imagesavealpha($destino, true);
     
				     imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
     
				     imagepng($destino,  $ruta360);
                   
					$ruta360 = substr($ruta360,3);	 


			   }

				

			}else{

				$ruta360 = $datos["antiguoRecorrido"];
				
			}

			$tabla = "habitaciones";

			$datos = array("id_h" => $datos["idHabitacion"],
						   "tipo_h" => $datos["tipo_h"],
						   "estilo" => $datos["estilo"],
						   "galeria" => json_encode($guardarRuta), /* Devuelve un string con la representación JSON  */
						   "video" => $datos["video"],
						   "recorrido_virtual" => $ruta360,
						   "descripcion_h" => $datos["descripcion"]);

			$respuesta = ModeloHabitaciones::mdlEditarHabitacion($tabla, $datos);

			return $respuesta; 

		}else{
 
			return "error"; 

		}


	}






	


}