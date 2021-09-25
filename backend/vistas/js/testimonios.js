/*=============================================
Tabla Testimonios
=============================================*/

 $.ajax({

     "url":"ajax/tablaTestimonios.ajax.php",
          success: function(respuesta){
      
           console.log("respuesta", respuesta);

     }

 })

 

$(".tablaTestimonios").DataTable({
  "ajax":"ajax/tablaTestimonios.ajax.php",
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
Aprobar o desaprobar Testimonio
=============================================*/

$(document).on("click", ".btnAprobar", function(){

  var idTestimonio = $(this).attr("idTestimonio");             /*   console.log(idTestimonio); */
  var estadoTestimonio = $(this).attr("estadoTestimonio");      /*  console.log(estadoTestimonio); */
  var boton = $(this);                                          /*  console.log(boton);    */              
                                                              
  var datos = new FormData();
  datos.append("idTestimonio", idTestimonio);
  datos.append("estadoTestimonio", estadoTestimonio);

    $.ajax({

      url:"ajax/testimonios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
        
        /*  console.log("respuesta", respuesta);   
         return; */

        if(respuesta == "ok"){

          if(estadoTestimonio == 0){

            $(boton).removeClass('btn-info');
            $(boton).addClass('btn-dark');
            $(boton).html('Aprobar');
            $(boton).attr('estadoTestimonio', 1);

          }else{

            $(boton).addClass('btn-info');
            $(boton).removeClass('btn-dark');
            $(boton).html('Aprobado');
            $(boton).attr('estadoTestimonio',0);

          }

        }    

      }

    })

})