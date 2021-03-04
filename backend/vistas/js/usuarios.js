/*=============================================
Tabla Usuarios
=============================================*/

// $.ajax({

//     "url":"ajax/tablaUsuarios.ajax.php",
//     success: function(respuesta){
      
//      console.log("respuesta", respuesta);

//     }

// })

$(".tablaUsuarios").DataTable({
  "ajax":"ajax/tablaUsuarios.ajax.php",
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "language": {

     "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }

   }

})


/*=============================================
SUMAR RESERVAS
=============================================*/

$(".tablaUsuarios").on("draw.dt", function(){   /* => cuando la tabla esta terminada de pintar  */

  var sumarReservas = $(".sumarReservas");  console.log(sumarReservas);
  var idUsuario = [];
  var sumar = [];

  for(var i = 0; i < sumarReservas.length; i++){

    idUsuario.push($(sumarReservas[i]).attr("idUsuario"));  /* => empujo todos ids de usuarios */

    var datos = new FormData();
    datos.append("idUsuarioR", idUsuario[i]);  /* enviar uno por uno */

    $.ajax({

      url:"ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){   

        console.log(respuesta);
        
         sumar.push(respuesta.length);  console.log(sumar);  /* en cada respuesta su lenght es catidad de reservas que hizo el usuario  */ /* obtieniendo al final indices con catidad reservas en cada indice */
         
         for(var f = 0; f < sumar.length; f++){

           $(sumarReservas[f]).html(sumar[f]);   /* se suma cuantidades de reservas en el indice 0 y lo muestra , luego suma indice 0 y el indice 1 , y lo muesta el  en le o y el uno en el uno asi funcciona el systema va recoriendo hasta terminar */

         }
      
      }

    })  
   
  }

 /*  console.log(idUsuario); */

})

/*=============================================
SUMAR TESTIMONIOS
=============================================*/

$(".tablaUsuarios").on("draw.dt", function(){

  var sumarTestimonios = $(".sumarTestimonios");   console.log(sumarTestimonios);
  var idUsuario = [];
  var sumar = [];

  for(var i = 0; i < sumarTestimonios.length; i++){

    idUsuario.push($(sumarTestimonios[i]).attr("idUsuario"));   console.log(idUsuario);

    var datos = new FormData();
    datos.append("idUsuarioT", idUsuario[i]);
     
    $.ajax({

      url:"ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success:function(respuesta){      

        sumar.push(respuesta.length);

        for(var f = 0; f < sumar.length; f++){

          $(sumarTestimonios[f]).html(sumar[f]);
        
        }
    
      }

    })

  }

})
