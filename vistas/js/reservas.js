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

       $(".selectTemaHabitacion").append('<option value="'+respuesta[i]["id_h"]+'">'+respuesta[i]["estilo"]+'</option>') /* en value adiciono el id de la habitacion que voy a enviar */ /* uso append : es decir voy agregando lista tras lista  */
                                                                                                                                                                                         /* no eso html : html no me agrega se reemplaza escribe lista en lugar de lista */
 
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


   /* iniciamos este array vacio  */  /* uso para eventos del calendario grande   */
   var totalEventos = [];  /* aqui se van a meter los eventos del calendario grande , asi puedo hacer sus lecturas dem manera dinamica */

   /* inicializacion de arrays que vamos a estar usando en el escenario de validacion de cruzes de fechas : donde indentificamos que fechas son reservadas y que fechas son libres en el id_habitacion, es decir en la habitacion  */
   var opcion1 = [];
  
   var validarDisponibilidad = [];

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
  success:function(respuesta){   /* respuesta => va ser un array */
   
    console.log("respuesta",respuesta);   /* me devuelve una colleccion vacia si no encuentra ningun habitacion atraves de su id en tabla de reservas  */
 
    if(respuesta.length == 0 ){    /* respuesta es un array eso segnifica si viene vacio su length sera igual a zero  */ /* a su vez segnifica que la habitacion esta disponible de primera  */    
                                                                                                                         /* es donde estoy mostrando sin problema y sin duda la disponiblidad  */ /* lo logico  */
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
 
     
 
    }else{ /* en caso al revez si viene con informacion quiere decir mi busqueda en la tabla de reservas me detecto la existencia de este id_habitacion eso quiere decir que la habitacion esta reservada por ciertas fechas es lo que voy a INVISTIGAR APARTIR DE AHORA : */
           /* asi que se viene con informacion tengo que mostrar al cliente las fechas que me trae la base de datos para informarle al usuario que estas fechas estan occupadas  */
          
         
           /* respuesta => como es un array puede traer varias respuestas es decir varios indices , entonces lo metemos dentro de un cicloFor para su lectura  */
           for(var i = 0; i < respuesta.length; i++){  /* => por su puesto aqui tengo respuesta.length !=0 es decir me devuelve que hay id_habitacion en tabla reservas : hacemos su lectura */
               
               /* validar cruzes de fechas  */
                if(fechaingreso == respuesta[i]['fecha_ingreso'] ){
              
                  opcion1[i] = false;  /* si alguno de los indice en su propiedad fecha_ingreso coincida con fecha ingreso usuario surge false en este indice */ /* la logica dice va generar un false porque coincidencia es una  */ 
                  console.log(fechaingreso, respuesta[i]['fecha_ingreso'], respuesta[i]['fecha_salida']);
               
                }else{
              
                  opcion1[i] = true;    /* sino no coinciden fechas de ingreso  le damos un valor true  */ /* la logica dice puede generar varios true */

                 
                };  /* con este filtracion ya tenemos dos valores nos indica si la fechas de ingreso coincidan o no  */
                console.log('opcion1[i]',opcion1[i]);

                 /* Validar disponiblidad */
                if(opcion1[i] == false ){   /* en los indices de opcion1[i] se va generar un false por que coincidencia es unica  */
              
                 validarDisponibilidad[i] = false;  /* eso quiere decir se genera un false en  validarDisponibilidad[i]   */
              
                }else{
              
                  validarDisponibilidad[i] = true;  /* se generar variso true */
              
                }
                console.log('validarDisponibilidad[i]', validarDisponibilidad[i]);

                 /* cuando se detecta este unico false , se entra aqui  */
                  if(!validarDisponibilidad[i]){ /* es diferente a true segnifica que es falso : se genera en caso que la fechas de ingreso se coincidan  */ /* eso segnifica que la habitacion no esta disponible en la fecha de ingreso  */
                      
                     totalEventos.push(  /*a este array le voy a empujar unos indices dentro de su array , es rellenar el array inicializado vacio *//* estos indices van a ser la catidad de eventos que puedan suceder sobre el Calendario grande  */
                  
                       /*En este caso solo me muestre las fechas que trae la tabla, no me muestre la fechas seleccionada por usuario  */ /* porque no hay disponiblidad  */
                
                       /*index*/ /* "" le ponemos propiedades como se debe escribir propiedad de tipo objeto example 'satart' ... llave , valor */
                
                       /*i*/ {  /* este conjunto de evento de calendario manipulado dinamicamente por fechas de ingreso y salida lograda desde la base de datos de la habitacion encontrada en la seleccion de la tabla de reservas   */ /* evento base de datos  */
                                /* puede que un id_habitacion  lanza varios eventos es decir un id_habitacion tendra varias fechas reservadas para varios usuarios diferentes , cada usuarios diferente puede reservar una fechas cuanda sera disponibles  */
                                 'start': respuesta[i]['fecha_ingreso'],
                                 'end': respuesta[i]['fecha_salida'],
                                 'rendering': 'background',
                                 'color': '#847059' /* aqui este color indica las fechas occupadas que indica este id_habitacion desde la base de datos desde la tabla reservas : sabemos paraque este id_habitacion en tabla reservas ya ha pasado por varios processos   */
                          
                            }
                     )  /* a este array le voy a empujar unos in
                     
                     
                       dices  es decir agregar unos indices dentro de su array , es rellenar el array inicializado vacio */
                       /* lo mas importante que  totalEventos se convierta en un array  */
                
                     $(".infoDisponibilidad").html('<h5 class="pb-5 float-left ">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong>¡Vuelve a intentarlo!</strong></h5>');  
                     
                       break;  /*romper el ciclo for para no continuar con mas informacion */ /* porque si sigue recorrer todos indices y va seguir con validacion de fechas sabemos que la fecha de coincidencia es una y nosotros nos importa cuando coincidan
                              paramos el ciclo para el uso de esta s informaciones por el que estamos aqui - sino sigua el siclo y pasmos de esta resultado  */
               
                  }else{ /* aqui al reves cuando validarDisponibilidad[i]  es true , generado cuando las fechas de ingreso no coincidan , quiere decir que la habitacion esta disponible en el fecha de ingreso  */

                    totalEventos.push(  /*a este array le voy a empujar unos indices dentro de su array , es rellenar el array inicializado vacio *//* estos indices van a ser la catidad de eventos que puedan suceder sobre el Calendario grande  */
                  
                      /*index*/ /* "" le ponemos propiedades como se debe escribir propiedad de tipo objeto example 'satart' ... llave , valor */
                      /* 0 */ {  /* este conjunto de evento manipulado dinamicamente por variables que traen fechas de ingreso y salida que selecciona el usuario  */ /* evento usuario */ /* de este conjunto evento usuario vamos a tener una version */
                                 'start': fechaingreso,
                                 'end': fechaSalida,
                                 'rendering': 'background',
                                 'color': '#FFCC29'    /* el background va ser el color que coloreamos que tu reserva esta disponible  */
                         
                            }, 
                      /*i*/ {  /* este conjunto de evento de calendario manipulado dinamicamente por fechas de ingreso y salida lograda desde la base de datos de la habitacion encontrada en la seleccion de la tabla de reservas   */ /* evento base de datos  */
                               /* puede que un id_habitacion  lanza varios eventos es decir un id_habitacion tendra varias fechas reservadas para varios usuarios diferentes , cada usuarios diferente puede reservar una fechas cuanda sera disponibles  */
                                'start': respuesta[i]['fecha_ingreso'],
                                'end': respuesta[i]['fecha_salida'],
                                'rendering': 'background',
                                'color': '#847059' /* aqui este color indica las fechas occupadas que indica este id_habitacion desde la base de datos desde la tabla reservas : sabemos paraque este id_habitacion en tablar reservas ya ha pasado por varios processos   */
                         
                           }
                    )  /* a este array le voy a empujar unos indices  es decir agregar unos indices dentro de su array , es rellenar el array inicializado vacio */
                      /* lo mas importante que  totalEventos se convierta en un array  */
               
                      $(".infoDisponibilidad").html('<h1 class="pb-5 float-left text-success">¡Está Disponible! _</h1> ');     
               
               
               
                  } /* fin else de validacion de disponiblidad */

           

             
              
              

           };/* Fin de cicloFor ; objetivo lectura del array respuesta */ /* estas es la manera mas facil de tratar con indices de array para validacion etcc -  */
            

          /* este es calendario sus eventos van depende de Validacion que debemos hacer antes entre eventos ususario y comparacion con evento tabla reservas   */ 
          $('#calendar').fullCalendar({  /* calendario grande  */
              header: {
                left: 'prev',
                center: 'title',
                right: 'next'
              },
              events:totalEventos   /*este es el array de eventos que encarga de manipular el calendario - sus informaciones son dinamicas  depende la validacion sobre el asunto que comunicamos  */
              
          });  /* fin  calenadario */


         
          
           




      
 
    }; /* fin else  */
 
   
 
  }  /* fin success  */
 
 
 });  /* fin ajax */






















          
};/* end if  infoReservas  */