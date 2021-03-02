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
    $habitacion -> video = $_POST["video"];
    $habitacion -> recorrido_virtual = $_POST["recorrido_virtual"];
    $habitacion -> descripcion = $_POST["descripcion"];
    $habitacion -> ajaxNuevaHabitacion();

  
  
}
     

