<?php

require_once "../controladores/habitaciones.controlador.php";
require_once "../modelos/habitaciones.modelo.php";

class AjaxHabitaciones{

	public $tipo_h;
	public $tipo;
    public $estilo;
    public $galeria; 
    public $video;
    public $recorrido_virtual;
    public $descripcion;
	public $idHabitacion;           /* => se usa al actualizar habitacion  */
    public $galeriaAntigua;        /* => se usa al actualizar habitacion  */
    public $antiguoRecorrido;     /* => se usa al actualizar habitacion  */


	/*=============================================
	Nueva habitación
	=============================================*/	
    
	public function ajaxNuevaHabitacion(){
	
		$datos = array( "tipo_h" => $this->tipo_h,
						"tipo" => $this->tipo,
						"estilo" => $this->estilo,
					    "Galeria" => $this->galeria,
						"video" => $this->video,
						"recorrido_virtual" => $this->recorrido_virtual,
						"descripcion" => $this->descripcion);

		$respuesta = ControladorHabitaciones::ctrNuevaHabitacion($datos);

		echo $respuesta;

	}

	/*=============================================
	  Editar habitación
	=============================================*/	

	public function ajaxEditarHabitacion(){
	
		$datos = array( "idHabitacion" => $this->idHabitacion,
						"tipo_h" => $this->tipo_h,
						"tipo" => $this->tipo,
						"estilo" => $this->estilo,
						"Galeria" => $this->galeria,
						"galeriaAntigua" => $this->galeriaAntigua,
						"video" => $this->video,
						"recorrido_virtual" => $this->recorrido_virtual,
						"antiguoRecorrido" => $this->antiguoRecorrido,
						"descripcion" => $this->descripcion);

		$respuesta = ControladorHabitaciones::ctrEditarHabitacion($datos);

		echo $respuesta;

	}
	 

	
 
	

}

/*=============================================
Guardar habitación
=============================================*/	
if(isset($_POST["tipo"])){

	$habitacion = new AjaxHabitaciones();
	$habitacion -> tipo_h = $_POST["tipo_h"];
	$habitacion -> tipo = $_POST["tipo"];
    $habitacion -> estilo = $_POST["estilo"];
    $habitacion -> galeria = $_POST["Galeria"]; 
	$habitacion -> galeriaAntigua = $_POST["galeriaAntigua"];       /* de uso en actualizar  */
    $habitacion -> video = $_POST["video"];
    $habitacion -> recorrido_virtual = $_POST["recorrido_virtual"];
	$habitacion -> antiguoRecorrido = $_POST["antiguoRecorrido"];     /* de uso en actualizar  */
    $habitacion -> descripcion = $_POST["descripcion"];
   
	if($_POST["idHabitacion"] != ""){

    	$habitacion -> idHabitacion = $_POST["idHabitacion"];
    	$habitacion -> ajaxEditarHabitacion();

    }else{

    	$habitacion -> ajaxNuevaHabitacion();

    }
  

  
  
}
     

