/*=============================================
FECHAS RESERVA
=============================================*/
$('.datepicker.entrada').datepicker({  /* este es un plugin que estamos usando  */
	startDate: '0d',  /* le estamos diciendo que inicie en el dia cual se encuentra  */
	format: 'yyyy-mm-dd',    /* cambiamos forma de fecha segun el modelo seguido en base de datos  */
	todayHighlight:true
});

$('.datepicker.entrada').change(function(){      /*hasta que no cambie el date picker de entrada no habilitamos el date picker de salida   */
                                                 /* porque le fecha de entrada la que va dar inicio a la opcion */

  $('.datepicker.salida').attr('readonly',false);  

	var fechaEntrada = $(this).val();

	$('.datepicker.salida').datepicker({
		startDate: fechaEntrada,                 /* fecha entrada  */ 
		datesDisabled: fechaEntrada,            /* desabilitaremos dia de entrada eso obliga seleccionar un dia despues  */
		format: 'yyyy-mm-dd'                   /* seguir forma de fecha en base de datos paraque se guarden correctamente  */ /* paraque podemos comparar  */
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
CALENDARIO BLOQUE 
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