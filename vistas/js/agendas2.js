/* Escenario 2 , donde el systema eliga el medico el que  esta disponible , en la categoria a consultrar  */
/*  reservas2.js => agendas.js */

/*=============================================
FECHAS RESERVA  en este archivo dende damos ejemplo a escenario 2 
=============================================*/
$.datetimepicker.setLocale('es');   /* para trabajar con este plug primer pongo que idioma voy a trabajar  */

$('.datepicker.entrada').datetimepicker({    /* cambiamos la funccionalidad : datepicker => datetimepicker */
   format:'Y-m-d H:00:00', /* trabajamos el formato como lo va guardar base de datos - como no trabajamos min dejemos 00 00 */  
   minDate: 0,   /* empieze por dia actual  */
   defaultTime:(new Date().getHours()+1)+":00",  /* indicar la hora desde el que voy a comenzar a seleccionar  */  /* lo miramos en detalle despues  */
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
  SELECTS ANIDADOS
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
CALENDARIO
=============================================*/

if($(".infoReservas").html() != undefined ){

  var idHabitacion = $(".infoReservas").attr("idHabitacion");     console.log("idaHabitacion", idHabitacion );    /* los ids captados como string seperados por comin */
  var arrayHabitacion = JSON.parse("["+idHabitacion +"]");    console.log("idaHabitacion-array", arrayHabitacion ); /*Todos ids_producto de habitaciones existen en una categorias*/
  var fechaingreso = $(".infoReservas").attr("fechaIngreso");   /*son las fechas que ingresa ususarios en formularios  */     console.log("fechaIngreso",  fechaingreso  ); 
  var fechaSalida = $(".infoReservas").attr("fechaSalida");                                                                   console.log("fechaSalida", fechaSalida ); 
  var fechaEscogida = new Date(fechaingreso);                                                                                  console.log("fechaIngreso-En-formato-jacascript :",fechaEscogida);     
  var nuevoArray = [];                                                                            
  var dias = $(".infoReservas").attr("dias");    /* calculo de la diferencias de dias a resrevar - total dia a reservar */
  
  for (var i = 0; i < arrayHabitacion.length; i++) {  /* este ciclo encierra todo codigo que hisimos para reservas  */ /* paraque repita este proceso toda la veces que tenemos indices en este array de habitaciones  */
   
    var totalEventos = [];
    var opcion1 = [];
    var opcion2 = [];
    var opcion3 = [];
    var validarDisponibilidad = false;
 
    var datos = new FormData();
    datos.append("idHabitaciones", arrayHabitacion[i]);
    datos.append("fechaingreso", fechaingreso);
    datos.append("fechaSalida", fechaSalida);


    $.ajax({

      url:urlPrincipal+"ajax/reservas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){  

        console.log("esteId:esta_occupado", respuesta);
             
        if(respuesta != ""){   /* si me llega un id  */
          
          function quitarHabitaciones (objeto){  /* el objeto comunicadoo en este caso  arrayHabitacion  */
             
             return objeto == respuesta;  /* cuando un valor en el objeto sera igual al valor respuesta , returnamos este valor donde findIndex coje si index , en el objeto */

          }
          
         arrayHabitacion.splice(arrayHabitacion.findIndex(quitarHabitaciones), 1); 
           /* findInbdex me manda el indice del valor en el objeto donde sera igual a respuesta   */ /* luego splice borra el valor completo de este index en su array  */ /* esto es todo  */
       
       } /* con este codigo he borrado todos ids que me indico php que esta reservados y me he quedado con los ids disponibles  */
       console.log(arrayHabitacion); 
       

        var datosHabitacion = new FormData();
        datosHabitacion.append("idHabitacion", arrayHabitacion[0]);

        $.ajax({   /* => esta peticion para traer datos de la habitacion que presenta  index 0  del arreglo de la habitaciones disponible  */
            
          url:urlPrincipal+"ajax/reservas.ajax.php",
          method: "POST",
          data: datosHabitacion,
          cache: false,
          contentType: false,
          processData: false,
          dataType:"json",
          success:function(respuesta){     /* respuesta => informacion de id habitacion consultada */
            console.log(respuesta);   /* => aqui el systema me devuelve un medico de los medicos que esta disponible en la especialidad  */
    
            if(respuesta.length != 0){
    
              $(".infoDisponibilidad").html('<h1 class="pb-5 float-left">¡Está Disponible_Escenario 2 !</h1>'); 
             
    
              /* aqui mostramos el calendario con los dias que selecciono  */ /* porque le hemos encontrado un coche o una habitacion disponible  */
              $('#calendar').fullCalendar({
    
                  defaultDate:  fechaingreso,  /* => el primer dia a parecer en calendario por default es el fecha de ingreso */
                  defaultView: 'agendaFourDay',  /* estilo agenda por dia y horas */
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
                  events: [{
                   title: respuesta[0]['estilo'], /* => es el nombre del medico disponible en la especialidad */
                   start: fechaingreso,
                   end: fechaSalida,
                  /*  rendering: 'background', */  /* => en este calendario o hace falta backgound   */
                   color: '#FFCC29'
                  }]
    
              });
    
              colDerReservas(respuesta[0]["tipo"],respuesta[0]["estilo"]) /* col derecha nesecita inf del producto dispo asi voy a pasar datos necesarios por parameteros */  /* en este caso estilo otro caso sera 303 en planta 3 , matricula coche ,,, */
              
    
    
            }else{
              
              $('#calendar').html("");
              $(".colDerReservas").hide();
              $(".infoDisponibilidad").html('<h1 class="pb-5 float-left">¡No hay coches disponibles en esta marca_Escenario 2 !</h1>'); 
              
    
            }
                   
          }  /* fin success  */
         
         
        });  /* fin ajax */
       
      }

    })

  }

}/* end if  infoReservas  */



/*=============================================
  FUNCIÓN COL.DERECHA RESERVAS
  =============================================*/
  
  function colDerReservas(tipo, estilo){
  

       $(".tituloReserva").val("Habitación "+tipo+" "+estilo); 
        $(".colDerReservas").show();
   
  
    var codigoReserva = codigoAleatorio(chars,9);  /* LENGTH CATIDAD DE CARACTERES A DEVOLVER  */
  

    /*  console.log("codigo_reserva", codigoReserva);  */
        
    /* Estructura ajax*/
    var datos = new FormData();
    datos.append("codigoReserva", codigoReserva);
    console.log("codigoReserva", codigoReserva);
   $.ajax({
 
    url:urlPrincipal+"ajax/reservas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
     

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
 


















