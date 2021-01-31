/* va traer todo de resrevas2 - si el systema el que va devolver el medico que eliga el systema  */
/* si el usuario el que eliga el medico tenemos que usar lo de archivo reserva.js */
/* nosotros vamos hacer los dos escenarios  */  /*  => cuando el usuario eliga el medico , => cuando el systema devuelva el medico el que esta disponible  */
/* Escenario 2 => reservas.js => agendas.js */


/*=============================================
FECHAS RESERVA  - esta parte del plugin presenta la forma de seleccionar la fecha y la hora - se cambia depende del plugin
=============================================*/
   $.datetimepicker.setLocale('fr');   /* para trabajar con este plug primer pongo que idioma voy a trabajar  */

   $('.datepicker.entrada').datetimepicker({    /* cambiamos la funccionalidad : datepicker => datetimepicker */
      format:'Y-m-d H:00:00', /* trabajamos el formato como lo va guardar base de datos - como no trabajamos min dejemos 00 00 */  
      minDate: 0,   /* empieze por dia actual  */
      defaultTime:(new Date().getHours()+1)+":00", /* indicar la hora desde el que voy a comenzar a seleccionar  */  /* lo miramos en detalle despues  */
      allowTimes:[
        '08:00',
        '09:00',
        '10:00',
        '11:00',
        '12:00',
        '13:00',
        '14:00',
        '15:00',
        '16:00', 
        '17:00',
        '18:00',
      ], /* allowtimes es lo que me permitir dentro de este array , decir en que horarios se trabajan  en esta empreza */
      disabledWeekDays: [0, 6], /* desabilitar los dias que no se puede trabajar dentro de la semana , solo  */
      closeOnDateSelect:false /* cuando selecciono una fecha se cierre el calendario */
   });
  
    $('.datepicker.entrada').change(function(){      /*hasta que no cambie el date picker de entrada no habilitamos el date picker de salida   */
                                                     /* porque le fecha de entrada la que va dar inicio a la opcion */ /* vamos a decirle que las citas medicas durann 60 min . cada medico lo ajusta como quiera  */
    
      $('.datepicker.salida').attr('readonly',false);   /* => pasa a ser habilita la fecha de salida */ 
    
      var fechaEntrada = $(this).val().split(" ");  /* fecha de entrada en string separado por espacio . le aplico split convierta todo seperado a array con indexes */
     
    

    
      console.log(valorEntrada);
      console.log("fechaRntrada",fechaEntrada);

      var fechaEscogida = new Date($(this).val());  /* => me convierta la fecha seleccionada en modelo de fecha de javascript  */
      console.log(fechaEscogida);   /* => mira consola para entender  */  /* si queremos manipular por minutos lo agregamos desde el principio asi con get min empezemos a agregar */

      var valorEntrada =  $(this).val(); /* => si viene vacio reescribimos mismo valor  */
      if(valorEntrada == ""){
         $('.datepicker.salida').val("Salida");
      }else{
        $('.datepicker.salida').val(fechaEntrada[0] +" "+(fechaEscogida.getHours()+1)+":00:00"); /* ver plugin de hora javascript , getear hora o minutos y agregarle lo que dure la cita  */ /* se quieres incrementar minutos lo haces de la misma forma */
        /* Recuerda para saber mas sobre la propiedad de new date de javascript ver :   */    /*  https://www.w3schools.com/js/js_dates.asp*/ 
      }
      
    });
  /*=============================================
  SELECTS ANIDADOS  - esta es la parte donde seleccionamos una categoria y nos devuelve opciones de cada categortia , Aplicado sobre formulario de Header 
  =============================================*/
  $(".selectTipoHabitacion").change(function(){
    
    var ruta = $(this).val();
    console.log("ruta", ruta);
  
   
    if(ruta != ""){   /* segnifica : que el value de la opcion seleccionada trae una ruta de base de datos gracias a la peticion al controlador y foreach , gracias al ejecuccion en php que sera de la url hacia abajo , se ejecuta todo,  toda llamadas a conroladores 
                       escritas en su  traectoria cada vez actualizamos la pagina  */
  
       $(".selectTemaHabitacion").html("");  /* se remplaza el valor por vacio  */
  
  
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
  
  
        $("input[name='ruta']").val(respuesta[0]["ruta"]); /* porque todas tipos de habitaciones seleccionados pertenecen al msimo crupo de ruta  */ 
        
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
                                                                   
    var idHabitacion = $(".infoReservas").attr("idHabitacion");       /* => id medico */  console.log("id_madico", idHabitacion ); 
    var fechaingreso = $(".infoReservas").attr("fechaIngreso");     /* => fecha y hora a coger cita */ console.log("dia-hora-cita", fechaingreso ); 
    var fechaSalida =  $(".infoReservas").attr("fechaSalida");       /*  => una hora despues de le seleccion  */  console.log("dia-hora-fin-cita",  fechaSalida ); 
    
    var fechaEscogida = new Date(fechaingreso);     console.log("fechaIngreso-En-formato-jacascript :",fechaEscogida); 
    /* var dias = $(".infoReservas").attr("dias"); */

    var nombreMedico = "";
    

     /* iniciamos este array vacio  */  /* uso para eventos del calendario grande   */
     var totalEventos = [];  /* aqui se van a meter los eventos del calendario grande , asi puedo hacer sus lecturas dem manera dinamica */

     /* inicializacion de un array vacio  en espera pasarle valores  */
     var opcion1 = [];  
  
  
     var validarDisponibilidad = false;
  
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
       
      console.log("respuesta",respuesta);    
   
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
   
        $(".infoDisponibilidad").html('<h1 class="pb-5 float-left text-success">¡Está Disponible! _</h1> ');  
        
        colDerReservas()   
   
      }else{ 
            
           
             /* respuesta => como es un array puede traer varias respuestas es decir varios indices , entonces lo metemos dentro de un cicloFor para su lectura  */
             for(var i = 0; i < respuesta.length; i++){  /* => por su puesto aqui tengo respuesta.length !=0 es decir me devuelve que hay id_habitacion en tabla reservas : hacemos su lectura */
               
  
                 
                  if(fechaingreso == respuesta[i]['fecha_ingreso'] ){
                
                    opcion1[i] = false;
                 
                 
                  }else{
                
                    opcion1[i] = true;  
                   
                  };

                  if(opcion1[i] == false ){  

                    validarDisponibilidad = false; 

                  }else{
                 
                    validarDisponibilidad = true; 

                  }
  
                   /* cuando se detecta este unico false , se entra aqui  */
                    if(!validarDisponibilidad){ 
                        
                       totalEventos.push(  
            
                               {   
                                   "title": respuesta[i]["estilo"],   /* estilo equvale nombre de medico  */ /* qui se muestra el nombre del medico  */
                                   'start': respuesta[i]['fecha_ingreso'],
                                   'end': respuesta[i]['fecha_salida'],
                                   'color': '#847059' /* aqui este color indica las fechas occupadas que indica este id_habitacion desde la base de datos desde la tabla reservas : sabemos paraque este id_habitacion en tabla reservas ya ha pasado por varios processos   */
                            
                               }
                       )  
                       
                        
                       $(".colDerReservas").hide();   
                       $(".infoDisponibilidad").html('<h3 class="pb-5 float-left  text-danger">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong class ="text-dark">¡Selecciona otra hora !</strong></h3>');  
  
                       break;  /* para el ciclo fuera del siclo quedamos con todo inf del siclo haste este punto */
  
  
                    }else{ 
  
                      totalEventos.push(  /* aunque no hay cruze de citas quiero ver la cita occupada apartir de mi dia actual   */
                             {  
                                  "title": respuesta[i]["estilo"],   /* estilo equvale nombre de medico  */ /* qui se muestra el nombre del medico  */
                                  'start': respuesta[i]['fecha_ingreso'],
                                  'end': respuesta[i]['fecha_salida'],
                                  'color': '#847059' 
                           
                             }
                      ) 

                      nombreMedico = respuesta[i]["estilo"]; /* aqui aprovecho la memoria temporal de compilacion */
  
                      $(".infoDisponibilidad").html('<h1 class="pb-5 float-left text-success">¡Está Disponible! _</h1> ');  
                     
                     
                      colDerReservas(); 
                 
                 
                    } /* fin else de validacion de disponiblidad */
  
  
             };/* Fin de cicloFor ; objetivo lectura del array respuesta */ 
  
  
            if(validarDisponibilidad){  /* si esta variable es true segnifica que se ha aprobado  antes que no hay coincidencia entre fechas de ingreso */
  
              totalEventos.push(
                 {
                    /* "title": respuesta[0]["estilo"], */   /* estilo equvale nombre de medico  */ /* qui se muestra el nombre del medico  */ /* esta opcion tambien funcciona  */
                    "title": nombreMedico,  
                    "start": fechaingreso,
                    "end": fechaSalida,
                    "color": '#FFCC29'
                 }
              )
  
            }
              
  
            /* Vista Calendario _ aqui nesitamoos vista por horas no porer dias   */  /* https://fullcalendar.io/docs/  */
            $('#calendar').fullCalendar({ 
                defaultDate:  fechaingreso,  /* => el primer dia a parecer en calendario por default es el fecha de ingreso */
                defaultView: 'agendaFourDay',
                allDaySlot:false,
                scrollTime:fechaEscogida.getHours()+":00:00",  /* => vamos a decirle el scroll de ese calendario parezca en la fecha escogida  */
                header: {
                  left: 'prev',
                  center: 'title',
                  right: 'next'
                },
                views: {
                    agendaFourDay: {
                       type: 'agenda',
                       duration: { days: 5 }   
                    }
                }, /*  => va parecer 5 dias en el calendario apartir del dia escogido */
                events:totalEventos  
                
            });  /* fin  calenadario */
   
  
  
  
  
  
      }; /* fin else  */
   
     
   
    }  /* fin success  */
   
   
   });  /* fin ajax */
  
  
  
  }; /* end if  infoReservas  */
  
  
  
  /*=============================================
  CODIGO ALEATORIO _ Uso en  COL.DERECHA RESERVAS
  =============================================*/
  var chars = "0123456789ABCDEFGHIJKLMOPQRSTUVWXYZ";  /* caracteres alfanumericos  */ 
  
  function codigoAleatorio(chars, length) {
   
    codigo = "";
  
    for(var i = 0; i < length ; i++ ){
                                           
       rand = Math.floor(Math.random()*chars.length);   /* returna un numero */      
      /*  console.log("rand", rand);    */                                    
       codigo += chars.substr(rand, 1);    /* seleccina posicion *//* ver consola */ /* 9 veces me va incrementar aqui mas igual */  
      /*  console.log("codigo", codigo);   */  
    }
  
     return codigo;
    
  
  };
  /*=============================================
  FUNCIÓN COL.DERECHA RESERVAS
  =============================================*/
  
  function colDerReservas(){
  
      $(".colDerReservas").show();
  
      var codigoReserva = codigoAleatorio(chars,9);  /* LENGTH CATIDAD DE CARACTERES A DEVOLVER  */
    
  
      /*  console.log("codigo_reserva", codigoReserva);  */
          
      /* Estructura ajax*/
      var datos = new FormData();
      datos.append("codigoReserva", codigoReserva);
   
     $.ajax({
   
      url:urlPrincipal+"ajax/reservas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
       /*  console.log("RespuestaCoindenciaCodigoReserva", respuesta); */ /* cuando no encuentra coincidencia en tabla la base de datos manda respuesta falsa  */
  
        if(!respuesta){  /* false */
   
          $(".codigoReserva").html(codigoReserva);
      
        }else{
      
           $(".codigoReserva").html(codigoReserva+codigoAleatorio(chars, 3));  
        }
      
        /*=============================================
          CAMBIO DE PLAN  : en el selector se aumenta el precio antes de confirmar la reserva 
        =============================================*/
  
          $(".elegirPlan").change(function(){    
  
            cambioPlanesPersonas();  /* por defecto case es 2 => 2personas */
                   
          })
  
          /*=============================================
          CAMBIO DE PERSONAS
          =============================================*/
  
          $(".cantidadPersonas").change(function(){ 
   
            cambioPlanesPersonas();    
  
          })
  
          function cambioPlanesPersonas(){   /* este codigo lo voy a necesitar obligatoriamente en dos eventos separados pero en la logica estos dos eventos son relacionados obligatoriamenete  */
  
                /* En caso teber una variables que su valor va tener muchos valores en funccion de la selaccion como en este caso mejor uso un switch */
             switch($('.cantidadPersonas').val()){
              
              case "2":
          
                 $(".precioReserva span").html($(".elegirPlan").val().split(",")[0]*dias);
                 $(".precioReserva span").number(true);
          
              break;
          
              case "3":                              /* Logica : sacarle al precio un porcentaje y lo agrega encima del precio total asi logramos precio total Final  */
                                                 /* meto las cifras en function Number paraque javascript lo considera como numero no como string */
               $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.25) + Number($(".elegirPlan").val().split(",")[0])*dias); /* en caso de tres personas pagara 25% mas */
               $(".precioReserva span").number(true);
          
              break;
          
              case "4":
          
               $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.50) + Number($(".elegirPlan").val().split(",")[0])*dias); /* 50+ a pagar */
               $(".precioReserva span").number(true);
          
              break;
          
              case "5":
          
               $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.75) + Number($(".elegirPlan").val().split(",")[0])*dias);  /* 0.75% aparag sobre precio que pagara una persona o dos  */
               $(".precioReserva span").number(true);
          
              break;
      
             }                                  
     
  
          } /* este codico cambia precio apagar en funccion de plan y numero de persona asi que lo incluyo en ddos eventos  */
         
  
  
  
  
  
  
  
  
  
  
  
  
  
   
  
      } /* Fin respuesta peticion ajax  */
   
     }) /* fin ejecuccion ajax  */
  
  
  
  
  };  /* fin funccion  colDerReservas  */
   
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
 


