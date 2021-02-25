/*=============================================
Tabla Planes
=============================================*/

// $.ajax({

//     "url":"ajax/tablaPlanes.ajax.php",
//     success: function(respuesta){
      
//      console.log("respuesta", respuesta);

//     }

// })

$(".tablaPlanes").DataTable({     /* los datos se insertan de una manera respectar orden de las columnas al momento de crear el objet json al resebir datos desde la llamada al controlador   */
  "ajax":"ajax/tablaPlanes.ajax.php",
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "language": {

     "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_",  /* si fallo de un total en pantalla movil podremos quitarlo */
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

   }

});

/*=============================================
Subir imagen temporal ImgPlan
=============================================*/

$("input[name='subirImgPlan'], input[name='editarImgPlan']").change(function(){   /* cuando cambie algo en el input  */

  var imagen = this.files[0];   /* capturar imagen */
  
  /*=============================================
	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
	=============================================*/

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

	  $("input[name='subirImgPlan'], input[name='editarImgPlan']").val("");

	   swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen debe estar en formato JPG o PNG!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	}else if(imagen["size"] > 2000000){

	  $("input[name='subirImgPlan'], input[name='editarImgPlan']").val("");

	   swal({
	      title: "Error al subir la imagen",
	      text: "¡La imagen no debe pesar más de 2MB!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	}else{

	  var datosImagen = new FileReader;
	  datosImagen.readAsDataURL(imagen);   /* => crear la imagen temporal la que vamos a subir o editar */ /* transformar en base 64 */

	  $(datosImagen).on("load", function(event){

	    var rutaImagen = event.target.result;

	    $(".previsualizarImgPlan").attr("src", rutaImagen);   /* si se cumple los filtros anteriores ponemos la imagen en el atr paraque visualiza  */

	  })

	}

})

/*=============================================
Plugin ckEditor   : paraque parezca textarea de la forma del plugin , necesitamos ccapturar su id y le aplicamos estos funcciones 
=============================================*/

ClassicEditor.create(document.querySelector('#descripcionPlan'), {

  toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']   /*  | devicion para poner otro bloque de herramientas  */  

}).then(function (editor) {
  
    $(".ck-content").css({"height":"200px"})   /* con alturo lo doy mas espacio para escribir si la quito me queda a una altura minima  */

}).catch(function (error) {  /* en caso pasara algun error en la integracion  */

	// console.log("error", error);

})

/*=============================================
Editar Plan
=============================================*/
 



$(document).on("click", ".editarPlan", function(){
  
  var idPlan = $(this).attr("idPlan");

  var datos = new FormData();
  datos.append("idPlan", idPlan);

  $.ajax({

    url:"ajax/planes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){

      	$('input[name="idPlan"]').val(respuesta["id"]);
      	$('input[name="editarPlan"]').val(respuesta["tipo"]);
      	$('input[name="imgPlanActual"]').val(respuesta["img"]);
      	$('.previsualizarImgPlan').attr("src", respuesta["img"]);
      	$('#editarDescripcionPlan').val(respuesta["descripcion"]);
      	$('input[name="editar_precio_alta"]').val(respuesta["precio_alta"]);
      	$('input[name="editar_precio_baja"]').val(respuesta["precio_baja"]);

      	ClassicEditor.create(document.querySelector('#editarDescripcionPlan'), {

          toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

        }).then(function (editor) {                   /* https://ckeditor.com/ckeditor-5/#classic */
          
          $(".ck-content").css({"height":"200px"})

        }).catch(function (error) {

           // console.log("error", error);
        
        })
           
    }
   


  })  

 

})

$(document).on("click", ".cerrarModal", function(){


  location.reload();   /* evitando el error de que se triplica la textarea tambien hemos evitar el cierre desde fuera del modal  */


})

/*=============================================
Eliminar Plan
=============================================*/

$(document).on("click", ".eliminarPlan", function(){  /* evento calase funccion , lo toma despues de cargar el documento , asi aseguramos su funcciionamiento en dispositivos moviles  */

  var idPlan = $(this).attr("idPlan");
  var imgPlan = $(this).attr("imgPlan");
 
  swal({
    title: '¿Está seguro de eliminar este plan?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar plan!'
  }).then(function(result){

    if(result.value){
       
        var datos = new FormData();
        datos.append("idEliminar", idPlan);  /* id borral el registro de la tabla de base de datos  */
        datos.append("imgPlan", imgPlan);   /* ruta imagen borra del servidor */

        $.ajax({

          url:"ajax/planes.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success:function(respuesta){

             if(respuesta == "ok"){
               swal({
                  type: "success",
                  title: "¡CORRECTO!",
                  text: "El plan ha sido borrado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "planes";

                    }
                })

             }

          }

        })

      }

    })

})

