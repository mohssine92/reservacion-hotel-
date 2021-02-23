<?php 


require_once "../controladores/administradores.controlador.php";
require_once "../modelos/administradores.modelo.php";

class TablaAdmin{

	/*=============================================
	Tabla Administradores
	=============================================*/ 

	public function mostrarTabla(){


        $respuesta = ControladorAdministradores::ctrMostrarAdministradores(null, null);
	
	 	if(count($respuesta) == 0){   /* => si ese array de respuessta igual a zero es decir tabla vacia no devuelve el fech all nada  */

			$datosJson ='[]';     /* cuando la tabla de la base de datos vacia debo pasar esto vacio asi paraque no dar error  */

			echo $datosJson; 

		   return;  /* cancelar cualquier procedimiento */

	   } 

	    $datosJson = '[';   /* => necesito que se repita solo los objetos de json dentro la coleccion no la colleccion por eso la pongo fuera del foreach  */
       
        foreach ($respuesta as $key => $value) {
           
		    $acciones = "<div class='btn-group'><button class='btn btn-warning btn-sm'><i class='fas fa-pencil-alt text-white'></i></button><button class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button></div>";
  
            $estado = "<button class='btn btn-info btn-sm'>Activo</button>";
  
           /* => es obligatorio declara la columnas de la tabla donde insertamos aqui y  en la peticion ajax en js , escritura exacta evitando errores  */
    
            $datosJson .=   /* => contuniar agregando mas cadenas de textos ... */
                
               '{         
					"id": "'.($key+1).'",                    
					"Nombre": "'.$value["nombre"].'",
					"Usuario": "'.$value["usuario"].'",
					"Perfil": "'.$value["perfil"].'",
					"Estado": "'.$value["estado"].'",
					"Acciones": "'.$acciones.'"
				},';		

        } 

		$datosJson = substr($datosJson, 0, -1);    /* >= el ultimo caratere los quitamos es , porque el ultimo json debe ir sin , y la ' la necesitamos para separar objetos json */

		$datosJson .= ']';  /* cierre de la coleeccion despues de agregar todos objetos  */
            
        echo $datosJson;
		
    }


}

/*=============================================
Tabla Administradores
=============================================*/ 

$tabla = new TablaAdmin();
$tabla -> mostrarTabla();



