<?php 

error_reporting(0);  /* paraque no me moleste loes errores de notice  */

$respuesta = ControladorReservas::ctrMostrarReservas(null, null);  /* => todas reservas que existan */

$arrayFechas = array();
$sumaPagosMes = array();

foreach ($respuesta as $key => $value){   /* => quiero trabajar con mes y año */

	#Capturamos año y mes
	 $fecha = substr($value["fecha_reserva"],0,7);  /* => mas facil dejar solo los primeros 7 */   /* 2018/09 */

	#Introducir las fechas en arrayFechas
	array_push($arrayFechas, $fecha);
	
	#Capturamos las ventas
	$arrayVentas = array($fecha => $value["pago_reserva"]);  /* $key => $fecha , $value => pago_reserva  */
	
	#Sumamos los pagos que ocurrieron el mismo mes

	foreach ($arrayVentas as $key2 => $value2) {
    
      /*    echo '<pre>';print_r($key2);echo'</pre>'; */
		$sumaPagosMes[$key2] += $value2;   /* lo que ocurra cuando un key estarepetido se asuma todos valores en el mismo y yasta asi conseguimos las suma pagada por un key  */
		/* echo '<pre>';print_r($sumaPagosMes);echo'</pre>';   */
	
	}
	
}


$noRepetirFechas = array_unique($arrayFechas);  /* al principio no pasa nada con la repiticion de fechas he calculado total facturado en un mes , pero ahora , no quiero que se repitan fechas en el araay aplico esta funccion */

/*  echo '<pre>';print_r($noRepetirFechas);echo'</pre>';  */ 

 ?>


<div class="card bg-gradient-info m-2">

	<div class="card-header no-border">
		
		<h3 class="card-title">
			<i class="fas fa-th mr-1"></i>
			Línea de Ventas
		</h3>

	</div>

	<div class="card-body">
		
		<div class="chart" id="line-chart-ventas"></div>

	</div>

</div>

<script>   /* intervenir js con php */

var line = new Morris.Line({
    element          : 'line-chart-ventas',  /* => es el id  */
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

    	 foreach($noRepetirFechas as $key){
           
    	    echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },"; 

    	 }

    }else{
 
    	 echo "{ y: '0', ventas: '0' }";  /* => en caso que no hay ventas  */
 
    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#efefef'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#fff',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#efefef'],
    gridLineColor    : '#efefef',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10

});



</script>