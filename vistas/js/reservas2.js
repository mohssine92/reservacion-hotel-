/*=============================================
FECHAS RESERVA  en este archivo dende damos ejemplo a escenario 2 
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
        
if($(".infoReservas").html() != undefined ){                         
                                                 
    
    var idHabitacion = $(".infoReservas").attr("idHabitacion");     console.log("idaHabitacion", idHabitacion );    /* los ids captados como string seperados por comin */

    var arrayHabitacion = JSON.parse("["+idHabitacion +"]");    console.log("idaHabitacion-array", arrayHabitacion ); /*Todos ids_producto de habitaciones existen en una categorias*/

    var fechaingreso = $(".infoReservas").attr("fechaIngreso");   /*son las fechas que ingresa ususarios en formularios  */    console.log("fechaIngreso",  fechaingreso  ); 
    var fechaSalida = $(".infoReservas").attr("fechaSalida");                                                                  console.log("fechaSalida", fechaSalida ); 
    var dias = $(".infoReservas").attr("dias");   /* calculo de la diferencias de dias a resrevar - total dia a reservar */


    for (var i = 0; i < arrayHabitacion.length; i++) {  /* este ciclo encierra todo codigo que hisimos para reservas  */ /* paraque repita este proceso toda la veces que tenemos indices en este array de habitaciones  */
                                                        /* si son 5 ids entonces 5 procesos  */
        
        var totalEventos = [];  
        var opcion1 = [];  
        var opcion2 = [];
        var opcion3 = [];
     
        var validarDisponibilidad = false;
     
       
       var datos = new FormData();
       datos.append("idHabitaciones", arrayHabitacion[i]); 
       /* tambien enviamos a ajax dos variables por post - paraque ajax nos haga el trabajo de buscar coincidencias con la que traegamos de la tabla reservas 2  */
       datos.append("fechaingreso", fechaingreso);      
       datos.append("fechaSalida", fechaingreso);    
       
     
    

   
        /* vamos hacer cruze fechas desde php . paraque php nos devuelva las habitaciones que no se puede usar , asi que  la que sobra si se puede usar   */
         $.ajax({
        
          url:urlPrincipal+"ajax/reservas.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType:"json",
          success:function(respuesta){   
           
             /* en esta peticion . segun la filtracion de la consulta . obtengo los ids que cruzcan con las fechas seleccionadas , es decir la habitaciones que estan occupadas  */
             console.log("respestaNoDisp", respuesta);

                      
          }  /* fin success  */
         
         
         });  /* fin ajax */
      
   

    } /* este ciclo se va ejuctando hasta pasar todos ids de habitaciones que tenemso en una categoria   */
    

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
   
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  