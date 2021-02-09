/*=============================================
FECHAS RESERVA  : selector de fechas
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
SELECTS ANIDADOS : selector categorias
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
                                                                 
  var idHabitacion = $(".infoReservas").attr("idHabitacion");   /* voy a pedirle a ajax que haga una peticon al controlador y me busque si existe este id de esta habitacion  */   console.log("idaHabitacion", idHabitacion ); 
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
   
    console.log("respuesta1",respuesta);    /* me devuelve una colleccion vacia si no encuentra ningun habitacion atraves de su id en tabla de reservas  */
 
    if(respuesta.length == 0 ){    /* respuesta es un array eso segnifica si viene vacio su length sera igual a zero  */ /* a su vez segnifica que la habitacion esta disponible de primera  */    
                                                                                                                         /* es donde estoy mostrando sin problema y sin duda la disponiblidad  */ /* lo logico  */
       $('#calendar').fullCalendar({  /* calendario grande  */
           
            defaultDate: fechaingreso,  
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
             

                /* se puede meter estas condiciones dentro una condicion se ejecuta apartir del dia actual  */
               /* validar cruzes de fechas  Opcion1 - cando hay coincidendencia en fechas de ingreso  */
                if(fechaingreso == respuesta[i]['fecha_ingreso'] ){
              
                  opcion1[i] = false;  /* si alguno de los indice en su propiedad fecha_ingreso coincida con fecha ingreso usuario surge false en este indice */ /* la logica dice va generar un false porque coincidencia es una  */ 
                 /*  console.log(fechaingreso, respuesta[i]['fecha_ingreso'], respuesta[i]['fecha_salida']); */
               
                }else{
              
                  opcion1[i] = true;  
                 
                };  /* con este filtracion ya tenemos dos valores nos indica si la fechas de ingreso coincidan o no  */
              /*   console.log('opcion1[i]',opcion1[i]); */
                
                /* validar cruzes de fechas  Opcion2 - cuando la fecha de ingreso seleccionada por ususario esta entre fechas reservadas desde ingreso hasta salida - en un indice en que estamos  por supuesto */
                if(fechaingreso > respuesta[i]["fecha_ingreso"] && fechaingreso < respuesta[i]["fecha_salida"]){ 
   
                  opcion2[i] = false;            
   
                }else{
   
                  opcion2[i] = true;
   
                };
               /*  console.log('opcion2[i]',opcion2[i]); */

                /* Validar cruzes de fechas - Opcion3 : Cuando fecha de ingreso sleccionada por usaurio menor que fecha ingreso base de datos y fecha salida seleccionada por usuario mayor que fecha ingreso base de datos aqui produzca otro cruze de fechas  */
                if(fechaingreso  < respuesta[i]["fecha_ingreso"] && fechaSalida > respuesta[i]["fecha_ingreso"]){

                  opcion3[i] = false;            
    
                }else{
    
                  opcion3[i] = true;
    
                }
                /* console.log('opcion3[i]',opcion3[i]); */

                 /* Validar disponiblidad */
                if(opcion1[i] == false || opcion2[i] == false ||opcion3[i] == false ){   /* la invalidez de la disponiblida en cazo de ..... */
              
                  validarDisponibilidad = false; 
              
                }else{
              
                  validarDisponibilidad = true;  
              
                }
                /* console.log('validarDisponibilidad', validarDisponibilidad);
 */
                
              

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
            defaultDate: fechaingreso,  
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

/* funccion que se ancarga de generar codigo de reserva aleatoriamente  */
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
         
        $(".codigoReserva").html(codigoReserva);  /* valor codigoReserva remplazada en html codigoReserva */
       /* $(".pagarReserva").attr("codigoReserva",codigoReserva ); */  /* es forma de dar valor a un atrributo .*/

    
      }else{
    
         $(".codigoReserva").html(codigoReserva+codigoAleatorio(chars, 3));  
        /*  $(".pagarReserva").attr("codigoReserva",codigoReserva+codigoAleatorio(chars, 3)); */
      }
    
      /*=============================================
        CAMBIO DE PLAN  : en el selector se aumenta el precio antes de confirmar la reserva 
      =============================================*/

        $(".elegirPlan").change(function(){    

           var ok = cambioPlanesPersonas();   /* se ejecuta cuando hacemos algun cambio en algun plan */
            console.log(ok);       
        })

        /*=============================================
        CAMBIO DE PERSONAS
        =============================================*/

        $(".cantidadPersonas").change(function(){ 
 
          cambioPlanesPersonas();      /* se ejecuta cuando hacemos algun cambio en numeros de personas  */
          
        })



        function cambioPlanesPersonas(){   /* este codigo lo voy a necesitar obligatoriamente en dos eventos separados pero en la logica estos dos eventos son relacionados obligatoriamenete  */

              /* En caso teber una variables que su valor va tener muchos valores en funccion de la selaccion como en este caso mejor uso un switch */
           switch($('.cantidadPersonas').val()){
            
            case "2":
        
               $(".precioReserva span").html($(".elegirPlan").val().split(",")[0]*dias);  /* => split(,) convierta en array todo separado por , y cogo inidex 0 que es el precio  */ 
               $(".precioReserva span").number(true);

               /* => Actualizar valor de atrributos que voy a mandar infor-perfil */
               $(".pagarReserva").attr("pagoReserva",$(".elegirPlan").val().split(",")[0]*dias)  /* => se repite en todos los casos lo que cambia la operacion matematica */
               $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
               $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());
              
              
               
            break;
        
            case "3":                           /* Logica : sacarle al precio un porcentaje y lo agrega encima del precio total asi logramos precio total Final  */
                                               /* meto las cifras en function Number paraque javascript lo considera como numero no como string */
             $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.25) + Number($(".elegirPlan").val().split(",")[0])*dias ); /* en caso de tres personas pagara 25% mas */
             $(".precioReserva span").number(true);  /* es elprecio de un dia sacar su 25% + precio de un dia por cantidad de dias a reservar  */

             $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split(",")[0]*0.25) + Number($(".elegirPlan").val().split(",")[0])*dias);  /* actualizar atributo a mandar inf-perfil */
             $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);  /* => split() poner string en array accesible */
             $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());  
        
            break;
        
            case "4":
        
             $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.50) + Number($(".elegirPlan").val().split(",")[0])*dias); /* 50+ a pagar */
             $(".precioReserva span").number(true);

             $(".pagarReserva").attr("pagoReserva",Number($(".elegirPlan").val().split(",")[0]*0.50) + Number($(".elegirPlan").val().split(",")[0])*dias);  /* actualizar atributo a mandar inf-perfil */
             $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
             $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());
           
        
            break;
        
            
            case "5": /* => entra aqui cuando value de cantidadPersonas es 5  */
               
             $(".precioReserva span").html(  Number($(".elegirPlan").val().split(",")[0]*0.75) + Number($(".elegirPlan").val().split(",")[0])*dias);  /* 0.75% aparag sobre precio que pagara una persona o dos  */
             $(".precioReserva span").number(true);

             $(".pagarReserva").attr("pagoReserva", Number($(".elegirPlan").val().split(",")[0]*0.75) + Number($(".elegirPlan").val().split(",")[0])*dias);  /* actualizar atributo a mandar inf-perfil */
             $(".pagarReserva").attr("plan",$(".elegirPlan").val().split(",")[1]);
             $(".pagarReserva").attr("personas",$(".cantidadPersonas").val());
      
            break;
            
           }    
           
           return ok = "Hola";
           

        } /* este codico cambia precio apagar en funccion de plan y numero de persona asi que lo incluyo en ddos eventos  */
       

    } /* Fin respuesta peticion ajax  */
 
   }) /* fin ejecuccion ajax  */




};  /* fin funccion  colDerReservas  */


/*=============================================
FUNCIÓN PARA GENERAR COOKIES 
=============================================*/
 /*diasExpedicion es la cantidad de dias que voy a permitir que  esta variable quede viva para ser usada */ /* => es decir le vas a peremitir cuanto tiempo al usuario va tener la reserva alli habilitada para pagarla */
 /* el profesor aconseja que le dejamos al usuario un dia ,paraque el usuario el siguiente dia efectua el pago , igual se la habitacion ha sido reservada por otro usuario igual vamos a validar nuevamente antes de guardar en base de datos   */
 /* si el usuario llega a este proceso y se ha ido a commer antes de terminar el pago  gracias a las cookies le damos vida a su paquete de iformacion  de reserva , pero si la misma habitacion se ha resevado en este periodo para otra persona nosotros 
 no vamos a preocupar porque volvemos a validar antes de guardar en base de datos asi da cuenta se todavia disponible la fecha o lo halla perdido   */
 
 function crearCookie(nombre, valor, diasExpedicion){    /* nombre = nombre de la variable cookie */ /* valor presenta el valor que porta esta variable cookie */
  
  var hoy = new Date();   /* => forma de capturar fecha de hoy en javascript */
  

 
  hoy.setTime(hoy.getTime() + (diasExpedicion  * 24 * 60 * 60 * 1000)); 
  var fechaExpedicion = "expires=" + hoy.toUTCString();

  document.cookie = nombre + "=" + valor + "; " + fechaExpedicion; /* => es la sintaxis como se crea una cookie en Javascript  */ /* ; => tener cuidado hay que dejar un espacio despues del comin */

}




/*=============================================
CAPTURAR DATOS DE LA RESERVA : para uso en  info-perfil
=============================================*/
/* VAMOS A UTULIZAR  UNA HERRAMIENTA QUE LOS NAVIGADORES NOS FACILITA EL TRSALADO DE INFORMACIONES ENTRE PAGINAS O ENTRE ARCHIVOS Y  ESAS HERRAMIENTAS SON LAS COOKIES   */  /* Codigo de procerso de pago   */
/* => entoces vamos a crear unas cookies apartir de javascript */ /* => capturar esas cookies en info-perfil.php , y poderlas meter en los datos que se van inviar a la tabla reservas en la base de datos */
  $(".pagarReserva").click(function(){
     
          
         function PrecioPagar(){  
            
            switch($('.cantidadPersonas').val()){
             
             case "2":

                Price = $(".elegirPlan").val().split(",")[0]*dias;
                
             break;
         
             case "3":                          
              
              Price = Number($(".elegirPlan").val().split(",")[0]*0.25) + Number($(".elegirPlan").val().split(",")[0])*dias;
            
              break;
         
             case "4":
      
              Price = Number($(".elegirPlan").val().split(",")[0]*0.50) + Number($(".elegirPlan").val().split(",")[0])*dias;

             break;
         
             
             case "5": 
                
              Price =  Number($(".elegirPlan").val().split(",")[0]*0.75) + Number($(".elegirPlan").val().split(",")[0])*dias;
       
             break;
             
            }    
            
            return Price; 
         
    
        } /* Fin  cambioPlanesPersonas */
      
        function Presonas(){  
            
            switch($('.cantidadPersonas').val()){
             
             case "2":
  
               Personas = 2;
                
             break;
         
             case "3":                          
              
               Personas =3;
            
              break;
         
             case "4":
      
               Personas =4;
  
             break;
         
             
             case "5": 
                
               Personas = 5;
       
             break;
             
            }    
            
            return  Personas; 
       
  
        } /* Fin  Personas */

        var precioPagar =  PrecioPagar();   /* se ejecuta cuando hacemos algun cambio en algun plan */ /*  console.log(PrecioPagar);*/
        var personas =  Presonas();  /*  console.log(personas); */  
        var infoHabitacion = $("#planHabitacion").val()+" - "+$(".elegirPlan").val().split(",")[1]+" - "+personas+" Personas";   console.log(infoHabitacion);
        var CodigoReserva =  $(".codigoReserva").html(); 
        var idHabitacion = $(this).attr("idHabitacion");
        var imgHabitacion = $(this).attr("imgHabitacion");
        var fechaIngreso = $(this).attr("fechaIngreso");  console.log('fechaIngreso',fechaIngreso);  
        var fechaSalida = $(this).attr("fechaSalida");       console.log('fechaSalida',fechaSalida);  
        
      
     /* => pasar informaciones a variables de tipo cookies , que nos ofrece los navigadores  */  
    
       crearCookie("idHabitacion", idHabitacion, 1);  /* console.log(ids);  */      /* a la funccion le pasamos sus parametros , 1 => referimos a 1 dia  */
       crearCookie("imgHabitacion", imgHabitacion, 1);
       crearCookie("infoHabitacion", infoHabitacion, 1);
       crearCookie("pagoReserva", precioPagar, 1);   /* => el precio que viene por attributos actualizado por el switch */
       crearCookie("codigoReserva",  CodigoReserva, 1);
       crearCookie("fechaIngreso", fechaIngreso, 1);
       crearCookie("fechaSalida", fechaSalida, 1);


      

   
 
  })


 



















