/* Capturar Total de la Transaccion */
 
var Total = $('#totalOrder').attr('total');  /* => al cargar el dom s capta valor precio - aunque se modifica en herramienta desarolaldor no afecta nada   */

/*console.log(Total); */

paypal.Buttons({
                               
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
          
            misCookies = document.cookie;    /* captar mis cookies en javascript  */
            listaCookies = misCookies.split(";");   console.log(listaCookies);

            for (i in listaCookies) {
                busca = listaCookies[i].search("idHabitacion");
                if (busca > -1) {micookie=listaCookies[i]}
            }
            igual = micookie.indexOf("=");
            id_habitacion = micookie.substring(igual+1);   /* => id de la habitacion */     /* console.log(id_habitacion); */

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
            fecha_Ingreso = micookie.substring(igual+1);   /* => fecha ingreso */  /* console.log(fecha_Ingreso); */

            for (i in listaCookies) {
                busca = listaCookies[i].search("fechaSalida");
                if (busca > -1) {micookie=listaCookies[i]}
            }
            igual = micookie.indexOf("=");
            fecha_Salida = micookie.substring(igual+1);   /* => fecha salida */  /* console.log(fecha_Salida); */

            
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

                    /* al terminar proceso de pago borro las variables cookies , ? darle fechas de expiracion  */ /*  le pngo una fecha antigua negativa _> lego rederigo a la pagina inicio */
                    document.cookie = "idHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';"; /* => nombre cookie no importa su valor ; fecha de expiracion ; path dominio  */
                    document.cookie = "imgHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                    document.cookie = "infoHabitacion=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                    document.cookie = "pagoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                    document.cookie = "codigoReserva=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                    document.cookie = "fechaIngreso=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';";
                    document.cookie = "fechaSalida=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path='.$ruta.';"; 
                     
                    /* Generar la orden en la base de datos */  /* si la transaccion esta aprobada ya puedo comenzar a guardar la  informaciones en base ed datos */ /* guardamos la informacion de la reserva despues de haber pagado */
                    $("#alerta").removeClass("d-none");
                    $("#alerta").addClass("d-block");       
                    $('#alerta').html('La reserva ha sido exitosa');
              







                  
            
                } 
            
            });
           


          
              


          } /* Fin details.status == 'COMPLETED'  */
          
           
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
  // This function displays Smart Payment Buttons on your web page.



  