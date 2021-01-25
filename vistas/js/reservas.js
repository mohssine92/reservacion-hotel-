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
                                                                 
  var idHabitacion = $(".infoReservas").attr("idHabitacion");   /* voy a pedirle a ajax que haga una peticon al controlador y me busque si existe este id de esta habitacion  */ /*  console.log("idaHabitacion", idHabitacion ); */
  var fechaingreso = $(".infoReservas").attr("fechaIngreso"); /*   console.log("fechaIngreso", fechaingreso ); */
  var fechaSalida = $(".infoReservas").attr("fechaSalida"); /*   console.log("fechaSalida", fechaSalida ); */
  var dias = $(".infoReservas").attr("dias");
  

 

   /* iniciamos este array vacio  */  /* uso para eventos del calendario grande   */
   var totalEventos = [];  /* aqui se van a meter los eventos del calendario grande , asi puedo hacer sus lecturas dem manera dinamica */

   /* inicializacion de arrays que vamos a estar usando en el escenario de validacion de cruzes de fechas : donde indentificamos que fechas son reservadas y que fechas son libres en el id_habitacion, es decir en la habitacion  */
   var opcion1 = [];  
   var opcion2 = [];
   var opcion3 = [];

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
 
     
      colDerReservas()   
 
    }else{ 
          
         
           /* respuesta => como es un array puede traer varias respuestas es decir varios indices , entonces lo metemos dentro de un cicloFor para su lectura  */
           for(var i = 0; i < respuesta.length; i++){  /* => por su puesto aqui tengo respuesta.length !=0 es decir me devuelve que hay id_habitacion en tabla reservas : hacemos su lectura */
             

                /* se puede meter estas condiciones dentro una condicion se ejecuta apartir del dia actual  */
               /* validar cruzes de fechas  Opcion1 - cando hay coincidendencia en fechas de ingreso  */
                if(fechaingreso == respuesta[i]['fecha_ingreso'] ){
              
                  opcion1[i] = false;  /* si alguno de los indice en su propiedad fecha_ingreso coincida con fecha ingreso usuario surge false en este indice */ /* la logica dice va generar un false porque coincidencia es una  */ 
                  console.log(fechaingreso, respuesta[i]['fecha_ingreso'], respuesta[i]['fecha_salida']);
               
                }else{
              
                  opcion1[i] = true;  
                 
                };  /* con este filtracion ya tenemos dos valores nos indica si la fechas de ingreso coincidan o no  */
                console.log('opcion1[i]',opcion1[i]);
                
                /* validar cruzes de fechas  Opcion2 - cuando la fecha de ingreso seleccionada por ususario esta entre fechas reservadas desde ingreso hasta salida - en un indice en que estamos  por supuesto */
                if(fechaingreso > respuesta[i]["fecha_ingreso"] && fechaingreso < respuesta[i]["fecha_salida"]){ 
   
                  opcion2[i] = false;            
   
                }else{
   
                  opcion2[i] = true;
   
                };
                console.log('opcion2[i]',opcion2[i]);

                /* Validar cruzes de fechas - Opcion3 : Cuando fecha de ingreso sleccionada por usaurio menor que fecha ingreso base de datos y fecha salida seleccionada por usuario mayor que fecha ingreso base de datos aqui produzca otro cruze de fechas  */
                if(fechaingreso  < respuesta[i]["fecha_ingreso"] && fechaSalida > respuesta[i]["fecha_ingreso"]){

                  opcion3[i] = false;            
    
                }else{
    
                  opcion3[i] = true;
    
                }
                console.log('opcion3[i]',opcion3[i]);

                 /* Validar disponiblidad */
                if(opcion1[i] == false || opcion2[i] == false ||opcion3[i] == false ){   /* la invalidez de la disponiblida en cazo de ..... */
              
                  validarDisponibilidad = false; 
              
                }else{
              
                  validarDisponibilidad = true;  
              
                }
                console.log('validarDisponibilidad', validarDisponibilidad);

                
              

                 /* cuando se detecta este unico false , se entra aqui  */
                  if(!validarDisponibilidad){ 
                      
                     totalEventos.push(  
          
                             {   /* evento base de datos  */
                                /* puede que un id_habitacion  lanza varios eventos es decir un id_habitacion tendra varias fechas reservadas para varios usuarios diferentes , cada usuarios diferente puede reservar una fechas cuanda sera disponibles  */
                                 'start': respuesta[i]['fecha_ingreso'],
                                 'end': respuesta[i]['fecha_salida'],
                                 'rendering': 'background',
                                 'color': '#847059' /* aqui este color indica las fechas occupadas que indica este id_habitacion desde la base de datos desde la tabla reservas : sabemos paraque este id_habitacion en tabla reservas ya ha pasado por varios processos   */
                          
                             }
                     )  
                     
                      
                     $(".colDerReservas").hide();   
                     $(".infoDisponibilidad").html('<h3 class="pb-5 float-left  text-danger">¡Lo sentimos, no hay disponibilidad para esa fecha!<br><br><strong class ="text-dark">¡Eliga Otra Fecha !</strong></h3>');  

                     break;  /* para el ciclo fuera del siclo quedamos con todo inf del siclo haste este punto */


                  }else{ 

                    totalEventos.push(   /* aqui pintamos fechas de ingreso que se han validad recientemente : sabemos que no coincidan con fecha de ingreso de usuario  */
                           {  
                               
                                'start': respuesta[i]['fecha_ingreso'],
                                'end': respuesta[i]['fecha_salida'],
                                'rendering': 'background',
                                'color': '#847059' 
                         
                           }
                    ) 

                    $(".infoDisponibilidad").html('<h1 class="pb-5 float-left text-success">¡Está Disponible! _</h1> ');  
                   
                   
                    colDerReservas(); 
               
               
                  } /* fin else de validacion de disponiblidad */


           };/* Fin de cicloFor ; objetivo lectura del array respuesta */ 



           for(var i = 0; i < respuesta.length; i++){ 
             

            if(fechaingreso == respuesta[i]['fecha_ingreso'] ){
              opcion1[i] = false;
            }
           
          
            if(fechaingreso > respuesta[i]["fecha_ingreso"] && fechaingreso < respuesta[i]["fecha_salida"]){
              opcion2[i] = false;            
            }
           

            if(fechaingreso  < respuesta[i]["fecha_ingreso"] && fechaSalida > respuesta[i]["fecha_ingreso"]){
              opcion3[i] = false;            
            }
           
            
            if(opcion1[i] == false || opcion2[i] == false ||opcion3[i] == false ){  
              validarDisponibilidad = false; 
            }
            
            
             
              if(!validarDisponibilidad){ 
                  
                 totalEventos.push(  
      
                         {   /* evento base de datos  */
                            
                             'start': respuesta[i]['fecha_ingreso'],
                             'end': respuesta[i]['fecha_salida'],
                             'rendering': 'background',
                             'color': '#847059' /* color fecha occupada */
                      
                         }
                 )  
                 
                 
                 
                 $(".colDerReservas").hide();   
                
              }


          };/* Fin de cicloFor ; este ciclo solo para mostrar otra fechas reservadas  */ 
         
         


          if(validarDisponibilidad){  /* si esta variable es true segnifica que se ha aprobado  antes que no hay coincidencia entre fechas de ingreso */

            totalEventos.push(
               {
                  "start": fechaingreso,
                  "end": fechaSalida,
                  "rendering": 'background',
                  "color": '#FFCC29'
               }
            )

          }
            

          /* Clendario grande  */ 
          $('#calendar').fullCalendar({ 
              header: {
                left: 'prev',
                center: 'title',
                right: 'next'
              },
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
     console.log("rand", rand);                                       
     codigo += chars.substr(rand, 1);    /* seleccina posicion *//* ver consola */ /* 9 veces me va incrementar aqui mas igual */  
     console.log("codigo", codigo);    
  }

   return codigo;
  

};
/*=============================================
FUNCIÓN COL.DERECHA RESERVAS
=============================================*/

function colDerReservas(){

    $(".colDerReservas").show();

    var codigoReserva = codigoAleatorio(chars,9);  /* LENGTH CATIDAD DE CARACTERES A DEVOLVER  */
  

     console.log("codigo_reserva", codigoReserva); 
        
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
      console.log("RespuestaCoindenciaCodigoReserva", respuesta); /* cuando no encuentra coincidencia en tabla la base de datos manda respuesta falsa  */

      if(!respuesta){  /* false */
 
        $(".codigoReserva").html(codigoReserva);
    
      }else{
    
         $(".codigoReserva").html(codigoReserva+codigoAleatorio(chars, 3));  
      }
    
      /*=============================================
        CAMBIO DE PLAN  : en el selector se aumenta el precio antes de confirmar la reserva 
      =============================================*/

        $(".elegirPlan").change(function(){    /* siempre halla cambio en planes es decir : el Usuario habia hecho un change en este select  */
          
           /* convertir un cadena de texto separada por comin en un array - en javascript se hace con split */
          /*   $(this).val().split(",");   */                          
           /*  var  precio =  ($(this).val().split(",")[0]*dias); */    /*  console.log("$(this).val().split(\",\")", precio );*/
          
           $(".precioReserva span").html($(this).val().split(",")[0]*dias);                   /* jquery number es un plugin nos permite sacar formato de precios como hace format_number en php  */  
           $(".precioReserva span").number(true);   /*  $(".precioReserva span").number(true,2);  */       /* coger el mismo span y le aplicas la funccio del plugin  */    
         
        })

        /*=============================================
        CAMBIO DE PERSONAS
        =============================================*/

        $(".cantidadPersonas ").change(function(){ 

            /* En caso teber una variables que su valor va tener muchos valores en funccion de la selaccion como en este caso mejor uso un switch */
            switch($(this).val()){
            
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




        })
       













 

    } /* Fin respuesta peticion ajax  */
 
   }) /* fin ejecuccion ajax  */




};  /* fin funccion  colDerReservas  */
 


















