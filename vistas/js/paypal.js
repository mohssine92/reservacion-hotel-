if($(".infoPerfil ").html() != undefined){

/* Capturar Total de la Transaccion */
  var Total = $('#totalOrder').attr('total');  /* => al cargar el dom s capta valor precio - aunque se modifica en herramienta desarolaldor no afecta nada   */
   

  var myVar = setInterval('contador()',10000);   /*  cada segundo verefico valores de cookies y validar los datos que se facilitan al buton de paypal para efectuar el pago */


  /* Validacion antes de jecutar el pago  */
function contador(){
      
   
      var misCookies = document.cookie
      var micookie ="" ;    /* captar mis cookies en javascript  */

      listaCookies = misCookies.split(";");   /* console.log(listaCookies); */

      for (i in listaCookies) {
        busca = listaCookies[i].search("idHabitacion");
        if (busca > -1) {micookie=listaCookies[i]}
      }
      igual = micookie.indexOf("=");    
      id_habitacion = micookie.substring(igual+1);   /* => id de la habitacion */      /*  console.log(id_habitacion);   */

      for (i in listaCookies) {
          busca = listaCookies[i].search("pagoReserva");
          if (busca > -1) {micookie=listaCookies[i]}
      }
      igual = micookie.indexOf("=");
      pago_reserva = micookie.substring(igual+1);   /* => precio a pagar por la resreva  */  /* console.log(pago_reserva); */
    
      for (i in listaCookies) {
          busca = listaCookies[i].search("codigoReserva");
          if (busca > -1) {micookie=listaCookies[i]}
      }
      igual = micookie.indexOf("=");
      codigo_Reserva = micookie.substring(igual+1);   /* => codigo de la resreva  */  /* console.log(codigo_Reserva); */
    
      for (i in listaCookies) {
        busca = listaCookies[i].search("infoHabitacion");
        if (busca > -1) {micookie=listaCookies[i]}
      }
     igual = micookie.indexOf("=");
     info_Habitacion = micookie.substring(igual+1);   /* => descripcion de la habitacion */  /* console.log(info_Habitacion); */
    
      for (i in listaCookies) {
          busca = listaCookies[i].search("fechaIngreso");
          if (busca > -1) {micookie=listaCookies[i]}
      }
      igual = micookie.indexOf("=");
      fecha_Ingreso = micookie.substring(igual+1);   /* => fecha ingreso */   /* console.log(fecha_Ingreso);
     */
       for (i in listaCookies) {
           busca = listaCookies[i].search("fechaSalida");
           if (busca > -1) {micookie=listaCookies[i]}
       }
       igual = micookie.indexOf("=");
       fecha_Salida = micookie.substring(igual+1);   /* => fecha salida */ /*  console.log(fecha_Salida);  */
      
    
       var hoy = moment().format('YYYY-MM-DD');  /* console.log(hoy); */
       
      

      if( hoy >= fecha_Ingreso  || hoy >= fecha_Salida ){  /* validacion antes de efectuar el pago , no permito pagar reserva , del mismo dia en el que se haga .... */  
         
        

         /* al terminar proceso de pago borro las variables cookies , ? darle fechas de expiracion  */ /*  le pngo una fecha antigua negativa _> lego rederigo a la pagina inicio */
         document.cookie = "idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';"; /* => nombre cookie no importa su valor ; fecha de expiracion ; path dominio  */
         document.cookie = "imgHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
         document.cookie = "infoHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
         document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
         document.cookie = "codigoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
         document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
         document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
         
         if(micookie !=""){

          location.reload();


         }
         
      
       
      }

      var opcion1 = [];  
      var opcion2 = [];
      var opcion3 = [];
   
      var validarDisponibilidad = false;
 
      /* Cruze de Fechas */
      var datos = new FormData();
      datos.append("idHabitacion", id_habitacion); 

      $.ajax({
      
        url:urlPrincipal+"ajax/reservas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){   
               
         /*   console.log("respuesta1",respuesta);  */    /* me devuelve una colleccion vacia si no encuentra ningun habitacion atraves de su id en tabla de reservas  */
                                                                                                                         /* es donde estoy mostrando sin problema y sin duda la disponiblidad  */ /* lo logico  */
           if(respuesta.length == 0 ){  

           /*   console.log('se puede reservar'); */

           }else{

            for(var i = 0; i < respuesta.length; i++){

              console.log('NO puede reservar');

              if(fecha_Ingreso == respuesta[i]['fecha_ingreso'] ){
              
                opcion1[i] = false;  
             
              }else{
            
                opcion1[i] = true;  
               
              }; 

              if(fecha_Ingreso > respuesta[i]["fecha_ingreso"] && fecha_Ingreso < respuesta[i]["fecha_salida"]){ 
   
                opcion2[i] = false;            
 
              }else{
 
                opcion2[i] = true;
 
              };

             
             
              if(fecha_Ingreso < respuesta[i]["fecha_ingreso"] &&  fecha_Salida  > respuesta[i]["fecha_ingreso"]){

                opcion3[i] = false;            
  
              }else{
  
                opcion3[i] = true;
  
              }

              if(opcion1[i] == false || opcion2[i] == false ||opcion3[i] == false ){   /* la invalidez de la disponiblida en cazo de ..... */
              
                validarDisponibilidad = false; 
            
              }else{
            
                validarDisponibilidad = true;  
            
              }

              if(!validarDisponibilidad &&  id_habitacion){ 
                 
                /* al terminar proceso de pago borro las variables cookies , ? darle fechas de expiracion  */ /*  le pngo una fecha antigua negativa _> lego rederigo a la pagina inicio */
                document.cookie = "idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';"; /* => nombre cookie no importa su valor ; fecha de expiracion ; path dominio  */
                document.cookie = "imgHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                document.cookie = "infoHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                document.cookie = "codigoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                
                 location.reload(); 
                
                
                

                break;  /* para el ciclo fuera del siclo quedamos con todo inf del siclo haste este punto */


              }






            } /* Fin de ciclofor */




           }

           
          


            



        }

      });

}


 


   

        /* Button  paypal */
    paypal.Buttons({   /* cuando se ejecuta este algoritmo ya es deberia hecho justo antes la validacion */
                    
      createOrder: function(data, actions) {  /* => primer ecenario crear la orden  */ /* lo unico que tengo que traerle total de la transaccion */  /* esta parte encarga de efectuar la transaccion */
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({ 
          purchase_units: [{
            amount: {
                value: Total    /* => ojo con esta parte la forma de pasara la cifra tiene que ser resepecto a la moneda que usamos si dhms o dolares o euros  */
            }
          }]
        });
      },
      onApprove: function(data, actions) {   /* => esta parte encarga de dar respuesta de esta  transaccion  */ /* => lo que suceda despues de aprobar una transaccion */
         // This function captures the funds from the transaction.
        return actions.order.capture().then(function(details) {
            // This function shows a transaction success message to your buyer.
            /*alert('Transaction completed by ' + details.payer.name.given_name); */ /* => */
             
            if(details.status == 'COMPLETED'){   
                console.log("Detailes",details);  /* => detail es objeto de informacion de la transaccion  */ /* => lo que me interesa la prop status  */
            
                  var datos = new FormData();               /* => insertar datos reserva atraves de peticion ajax  */
                  datos.append("id_habitacion", id_habitacion);
                  datos.append("id_usuario", 1);
                  datos.append("pago_reserva", pago_reserva);
                  datos.append("numero_transaccion",details.id);
                  datos.append("codigo_reserva", codigo_Reserva);
                  datos.append("info_habitacion", info_Habitacion);
                  datos.append("fecha_ingreso", fecha_Ingreso);
                  datos.append("fecha_salida", fecha_Salida);
                  
                  $.ajax({
      
                      url:urlPrincipal+"ajax/reservas.ajax.php",
                      method: "POST",
                      data: datos,
                      cache: false,
                      contentType: false,
                      processData: false,
                      dataType:"json",
                      success:function(respuesta){   
                         console.log("responseInsert :",respuesta);
      
                         if(respuesta == 'ok'){  /* =>devuelva ok , cuando se exita en insertar los datos reserva ... pago efectuado */
                          
                           /* al terminar proceso de pago borro las variables cookies , ? darle fechas de expiracion  */ /*  le pngo una fecha antigua negativa _> lego rederigo a la pagina inicio */
                           document.cookie = "idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';"; /* => nombre cookie no importa su valor ; fecha de expiracion ; path dominio  */
                           document.cookie = "imgHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                           document.cookie = "infoHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                           document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                           document.cookie = "codigoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                           document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                           document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';"; 
                            
                              swal({                    /* => alerta suave , me permite recargar la pagina tambien  */ /* ver su documentacion para perfeccionar en dereccionamiento etc */
                                 type:"success",
                                   title: "¡CORRECTO!",
                                   text: "¡La reserva ha sido creada con éxito!",
                                   showConfirmButton: true,
                                 confirmButtonText: "Cerrar" /* => cuando le da click en cerrar recargue la pagina  */ /* regresa a ultima pagina donde estuvo  */ /* esto hace la recarga despues de borrar las cookies lo que es desparece info de reserva ya .. */
                               
                             }).then(function(result){
         
                                     if(result.value){   
                                         history.back();
                                     } 
                             });

                          
                            
                         }
    
                  
                      } 
                  
                  });
                 
            }
            
             
             return false;
        });
      },
      onCancel: function(data) {
       
        fncSweetAlert("error", "The transaccion has been canceled ",null); /* => cuando el usuario cancela la transaccion devolvemos una alerta suave  */
    
        return false;
    
      },
      onError: function(err){
          
         fncSweetAlert("error", "An error occurred while making the transaction",null); /* => cuando se produsca un error en la transaccion  */
    
         return false;
          
      }
    
    }).render('#paypal-button-container');
     // This function displays Smart Payment Buttons on your web page
    






    
 
   
    

     





}













































    











