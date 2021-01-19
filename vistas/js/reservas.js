/*=============================================
FECHAS RESERVA
=============================================*/
$('.datepicker.entrada').datepicker({
	startDate: '0d',
	format: 'dd-mm-yyyy',
	todayHighlight:true
});

$('.datepicker.entrada').change(function(){

	var fechaEntrada = $(this).val();

	$('.datepicker.salida').datepicker({
		startDate: fechaEntrada,
		datesDisabled: fechaEntrada,
		format: 'dd-mm-yyyy'
	});

})

/*=============================================
SELECTS ANIDADOS
=============================================*/

$(".selectTipoHabitacion").change(function(){
  
  var ruta = $(this).val();
  console.log("ruta", ruta);

 
  if(ruta != "Tipo de habitación" ){

    $(".selectTemaHabitacion").html("");  /* se vacia y sigue .... */

  }else{

    $(".selectTemaHabitacion").html('<option>Temática de habitación</option>')  /* aqui no borro porque estoy usando html y html remplaza no como append agrega */

  }
 
  /* vamos a mandar el dato a ajax  */
  var datos = new FormData();
  datos.append("ruta", ruta);
 
   /* estructura ajax  */
  $.ajax({

    url:urlPrincipal+"ajax/habitaciones.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){   /* manipular select  anidados gracias a peticion ajax nos trae los datos  para manipular de manera asincrona */

     console.log("respuesta", respuesta );  /* solo en prueba  */
      
      
     for( var i = 0; i < respuesta.length; i++ ){


                                                  
      $(".selectTemaHabitacion").append('<option value="'+respuesta[i]["id_h"]+'">'+respuesta[i]["estilo"]+'</option>') /* en value adiciono el id del producto que voy a enviar */

     }

    }

  })






})

/*=============================================
CALENDARIO
=============================================*/

$('#calendar').fullCalendar({
	header: {
    	left: 'prev',
    	center: 'title',
    	right: 'next'
  },
  events: [
    {
      start: '2019-03-12',
      end: '2019-03-15',
      rendering: 'background',
      color: '#847059'
    },
    {
      start: '2019-03-22',
      end: '2019-03-24',
      rendering: 'background',
      color: '#FFCC29'
    }  
  ]


});