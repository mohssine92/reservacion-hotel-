<?php 

$mejorHabitacion = ControladorInicio::ctrMejorHabitacion();  /* => la mas que se repite en columna de descripcion */

$traerFoto = ControladorInicio::ctrTraerFotoHabitacion($mejorHabitacion["mejor"]);

$traerFotoArray = json_decode($traerFoto["galeria"], true);  /* => array */

?>


<div class="card card-success card-outline">

	<div class="card-header">
		<h5 class="m-0">Habitación más reservada</h5>
	</div>

	<div class="card-body">

		<img src="<?php echo $traerFotoArray[0]; ?>" class="img-thumbnail"> <!-- me quedo con la primera  -->

		<h6 class="card-title py-3"><?php echo $mejorHabitacion["mejor"]; ?></h6>

		<a href="reservas" class="btn btn-success">Ver reservas</a>

	</div>

</div>