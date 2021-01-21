/*=============================================
FECHAS RESERVA
=============================================*/
$('.datepicker.entrada').datepicker({  /* este es un plugin que estamos usando  */
  startDate: '0d',  /* le estamos diciendo que inicie en el dia cual se encuentra  */ 
  datesDisabled: '0d',   /* desabilito el dia zero es decir no dejo seleccionar el dia actual puede ser que sea tarde . pero yo veo que no pasa nada se el cliente quiere puede seleccionar luego ya veo el caso .. */
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

});

/*=============================================
SELECTS ANIDADOS
=============================================*/

$(".selectTipoHabitacion").change(function(){
  
  var ruta = $(this).val();
  console.log("ruta", ruta);

 
  if(ruta != ""){   /* segnifica : que el value de la opcion seleccionada trae una ruta de base de datos gracias a la peticion al controlador y foreach , gracias al ejecuccion en php que sera de la url hacia abajo , se ejecuta todo,  toda llamadas a conroladores 
                                 escritas en su  traectoria cada vez actualizamos la pagina  */

     $(".selectTemaHabitacion").html("");  /* se vacia y sigue .... */


  }else{  /* pero si llega vacia la ruta  */

    $(".selectTemaHabitacion").html('<option>Temáticas de habitación</option>')  /* aqui no borro porque estoy usando html y html remplaza no como append agrega */


  } /* fin de else  */
 

  /* vamos a mandar el dato a ajax  */
  var datos = new FormData();
  datos.append("ruta", ruta);   /* creamos variable de tipo post par ajax se llama ruta su valor es lo que tarae la variable ruta  */
 
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

  });




}); /* fin del evento change en el seleccionador del formulario de header en seleccionar las categorias paraque luego lanza los estilos de habitaciones disponibles en cada categoria . podemos usar la misma tecnica en listar las habiraciones , chales riad , apartamientos
      disponibles en cada ciudad en marruecos  */

/*=============================================
CALENDARIO BLOQUE   GRANDE 
=============================================*/
  /* este if porque este fichero de js se ejecuta siempre yo no quiero que se ejecute este bloque de codigo  hasta que se carga el div que contiene codigo de info-reserva  */        
if($(".infoReservas").html() != undefined ){       /* este linea de codigo indica que este div de este clase  su html indefinido segnifica que aun no se ha cargado  */                   
                                                                 
  var idHabitacion = $(".infoReservas").attr("idHabitacion");   /* voy a pedirle a ajax que haga una peticon al controlador y me busque si existe este id de esta habitacion  */
 /*  console.log("idaHabitacion", idHabitacion ); */
  var fechaingreso = $(".infoReservas").attr("fechaIngreso");
/*   console.log("fechaIngreso", fechaingreso ); */
  var fechaSalida = $(".infoReservas").attr("fechaSalida");
/*   console.log("fechaSalida", fechaSalida ); */
  
 /* crearcion de variable datos es variable post que vamos a mandar a ajax para hacer peticiones al controlador  */
 var datos = new FormData();
 datos.append("idHabitacion", idHabitacion); 
  

 /* vamos a hacer una solicitud a ajax  */
 $.ajax({

  url:urlPrincipal+"ajax/reservas.ajax.php",
  method: "POST",
  data: datos,
  cache: false,
  contentType: false,
  processData: false,
  dataType:"json",
  success:function(respuesta){
   
    console.log("respuesta",respuesta);   /* me devuelve una colleccion vacia si no encuentra ningun habitacion atraves de su id en tabla de reservas  */

    if(respuesta.length == 0 ){    /* respuesta es un array eso segnifica si viene vacio su length sera igual a zero  */ /* a su vez segnifica que la habitacion esta disponible de primera  */    

      $('#calendar').fullCalendar({  /* calendario grande  */
        header: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        events: [
          {
            start: fechaingreso,
            end: fechaSalida,
            rendering: 'background',
            color: '#FFCC29'    /* el background va ser el color que coloreamos que tu reserva esta disponible  */
          }
        ]

      });  /* fin calendario grande  */

     

    };                                    
           
  } /* fin de success la respuesta que obtenemos de ajax  */

       

 }); /* fin de ejecuccion de ajax => reservas.ajax  */

  
 
 
  

}  /* fin de if  que controla el codigo del modulo de info reserva - donde tenemos el calendario grande  */