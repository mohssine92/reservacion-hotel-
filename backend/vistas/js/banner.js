/*=============================================
Tabla Banner
=============================================*/

/*  $.ajax({

     "url":"ajax/tablaBanner.ajax.php",
     success: function(respuesta){
      
      console.log("respuesta", respuesta);

     }

 }) */

 $(".tablaBanner").DataTable({

       "aProcessing":true,
	     "aServerSide":true,
        "language": {  
     
	     	"sProcessing":     "Procesando...",
	     	"sLengthMenu":     "Mostrar _MENU_ registros",
	     	"sZeroRecords":    "No se encontraron resultados",
	     	"sEmptyTable":     "Ningún dato disponible en esta tabla",
	     	"sInfo":           "Mostrando registros del _START_ al _END_",
	     	"sInfoEmpty":      "Mostrando registros del 0 al 0",
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
     
	     },
	     "ajax": {     /* => es obligatorio declara la columnas de la tabla donde insertamos aqui y  en la peticion ajax en js , escritura exacta evitando errores  */

        "url":"ajax/tablaBanner.ajax.php",
	     	"dataSrc":""

	     },
	     "columns": [    /* => impor */
        { "data": "id" },
        { "data": "img" },
        { "data": "Acciones" }
      ],
	     "resonsieve":"true",
	     "bDestroy":true,
	     "iDisplayLength":10,
	     "order":[[0,"asc"]]
	

}); 

/*=============================================
Subir imagen temporal Banner
=============================================*/

 $("input[name='subirBanner'], input[name='editarBanner']").change(function(){   /* cualquier cambio en el input ejcutamos la funccion */

  var imagen = this.files[0];  /* para capturar imagen la que estoy sub se usar files con index 0  */
   
  /*=============================================
  VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  =============================================*/

/*   console.log(imagen["size"]); */

   if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

    $("input[name='subirBanner'], input[name='editarBanner']").val("");  /* vacia inputs  */

     swal({
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });

  }else if(imagen["size"] > 2000000){   /* mayor que 2 megas */  /* 2 millones de bits */

    $("input[name='subirBanner'], input[name='editarBanner']").val("");

     swal({
        title: "Error al subir la imagen",
        text: "¡La imagen no debe pesar más de 2MB!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });

  }else{  /* ya se cumple */  /* a logrado pasar por esto 2 filtros tanto formato y peso */

    var datosImagen = new FileReader;  /* hacemos una clase de js, para poder crear una imagen temporal */
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event){

      var rutaImagen = event.target.result;

      $(".previsualizarBanner").attr("src", rutaImagen);

    })

  }

})

/*=============================================
Editar Banner
=============================================*/

$(document).on("click", ".editarBanner", function(){  /* aplica la funccion despues de cargar el docuemento aseguramos que funccione en dipositivo movil que se abra ventanas de segundo grado  */

  var idBanner = $(this).attr("idBanner");    /* se refiere al button */

  var datos = new FormData();
  datos.append("idBanner", idBanner);

  $.ajax({

    url:"ajax/banner.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){

     /*   console.log(respuesta); */

      $('input[name="idBanner"]').val(respuesta["id"]);   /* se refiere al button del modal  */
      $('input[name="bannerActual"]').val(respuesta["img"]);
      $('.previsualizarBanner').attr("src", respuesta["img"]);
  
    }

  })  

}) 

/*=============================================
Eliminar Banner
=============================================*/

 $(document).on("click", ".eliminarBanner", function(){   /* aplicar despues de cargar el documento aseguramos que lo toma en dipositivos moviles  */

  var idBanner = $(this).attr("idBanner");
  var rutaBanner = $(this).attr("rutaBanner");
 
  swal({
    title: '¿Está seguro de eliminar este banner?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar banner!'
  }).then(function(result){

    if(result.value){
       
        var datos = new FormData();
        datos.append("idEliminar", idBanner);
        datos.append("rutaBanner", rutaBanner);

        $.ajax({

          url:"ajax/banner.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success:function(respuesta){

             if(respuesta == "ok"){   /* despues de eleminar este id de la base de datos */
               swal({
                  type: "success",
                  title: "¡CORRECTO!",
                  text: "El banner ha sido borrado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "banner";

                    }
                })

             }

          }

        })

      }

    })

})
 

