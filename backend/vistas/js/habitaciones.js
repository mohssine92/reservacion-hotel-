/*=============================================
360 GRADOS
=============================================*/

$(".360Antiguo").pano({
	img: $(".360Antiguo").attr("back")
});

/*=============================================
Plugin ckEditor
=============================================*/

ClassicEditor.create(document.querySelector('#descripcionHabitacion'), {

   toolbar: [ 'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', '|', 'undo', 'redo']

}).then(function (editor) {
  
    $(".ck-content").css({"height":"400px"})

}).catch(function (error) {

	// console.log("error", error);

})

/*=============================================
Tabla Habitaciones
=============================================*/
/* 
 $.ajax({

     "url":"ajax/tablaHabitaciones.ajax.php",
     success: function(respuesta){
      
      console.log("respuesta", respuesta);

     }

 }) */

$(".tablaHabitaciones").DataTable({
  "ajax":"ajax/tablaHabitaciones.ajax.php",
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
ARRASTRAR VARIAS IMAGENES GALERÍA Y DAR CLICK
=============================================*/


var ArchivosTemporales = [];  /* donde almacenamos todos archivos que arrastramos para mandarlos a base de datos a guardar   */

$(".subirGaleria").on("dragenter", function(e){  /* clase de label donde se van a caer los archivos imagenes  */

	e.preventDefault();   /* evitar cualquier accion que tenga el navigador por defecto  */
  	e.stopPropagation();

  	$(".subirGaleria").css({"background":"url(vistas/img/plantilla/pattern.jpg)"}) /* cabia background para experiencia user para darse cuenta que esta encima de la zona para soltar la imegen */

})

$(".subirGaleria").on("dragleave", function(e){  /* lo que pasar cuando quitamos el maus imagen encima de la zona de caeda */

  e.preventDefault();
  e.stopPropagation();

  $(".subirGaleria").css({"background":""})

})

$(".subirGaleria").on("dragover", function(e){  /* para decir que vamos a soltar las imagenes  */

  e.preventDefault();
  e.stopPropagation();

})

$("#galeria").change(function(){  /* para que funcciona al dar clcik seleccionar o arrastrar */ /* se le aplica al input file multi  */

	var archivos = this.files;  /* captar todo ....  y mandarlos a la siguiente funccion .. */

	multiplesArchivos(archivos);

})

$(".subirGaleria").on("drop", function(e){

  e.preventDefault();
  e.stopPropagation();

  $(".subirGaleria").css({"background":""})

  var archivos = e.originalEvent.dataTransfer.files;  /* aqui esoy capturando todos archivos arrastradsos  */    console.log("archivos ==>",archivos);    
 
        
  multiplesArchivos(archivos);  

})

function multiplesArchivos(archivos){

	for(var i = 0; i < archivos.length; i++){          /* recorro los archivos captados y empiezo a validar */

		var imagen = archivos[i];  /* pasar cada archivo individualmente , refieri a los que generaron al soltar en la vista   */
		
		if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

			swal({
	          title: "Error al subir la imagen",
	          text: "¡La imagen debe estar en formato JPG o PNG!",
	          type: "error",
	          confirmButtonText: "¡Cerrar!"
	        });

	        return;

		}else if(imagen["size"] > 2000000){

			swal({
	          title: "Error al subir la imagen",
	          text: "¡La imagen no debe pesar más de 2MB!",
	          type: "error",
	          confirmButtonText: "¡Cerrar!"
	        });

	        return;

		}else{

			var datosImagen = new FileReader;                      /* => vamos a mostrar los archivos en la vista  */  /* como hemos dicho estamos pasado cada archivo individualmente */
      		datosImagen.readAsDataURL(imagen);

      		$(datosImagen).on("load", function(event){   

      			var rutaImagen = event.target.result;     /* => imagen temporal */  
				   
                    
      			$(".vistaGaleria").append(`   

					<li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">
                      
	                    <img class="card-img-top" src="`+rutaImagen+`">

	                    <div class="card-img-overlay p-0 pr-3">
	                      
	                       <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoNueva" temporal>
	                         
	                         <i class="fas fa-times"></i>

	                       </button>

	                    </div>

	                </li>

      			`)


        		if(ArchivosTemporales.length != 0){  /* en caso quiero agregar mas imagenes convierto en array para poder agregar mas archivos , */

        			ArchivosTemporales = JSON.parse($(".InputNuevaGaleria").val());   /* lo convierta a un array paraque le empuja ,luego y lo convierta en string otra vez */

        		}

        		ArchivosTemporales.push(rutaImagen);  /* agrefarle cada ruta temporal de imagenes */

				$(".InputNuevaGaleria").val(JSON.stringify(ArchivosTemporales));  /* despues de cargar el array - convierto en string y lo paso como valor al input occulto */

  
      		})

		}	

	}	

}

/*=============================================
QUITAR IMAGEN DE LA GALERÍA
=============================================*/

$(document).on("click", ".quitarFotoNueva", function(){

	var listaFotosNuevas = $(".quitarFotoNueva");  /* almacenamiento de todo fotos que tenga galeria en ese momento*/ 
   
	
	var listaTemporales = JSON.parse($(".InputNuevaGaleria").val());  /* realmente esta en string pero lo voy conveertir en un array  */  /* rutas de imagenes temporal */  /* la galeria a subir  */

	for(var i = 0; i < listaFotosNuevas.length; i++){

		$(listaFotosNuevas[i]).attr("temporal", listaTemporales[i]);  /* cada button en su atrributo temporal le agrego su ruta imagen temporal en formato 64   */

		var quitarImagen = $(this).attr("temporal"); /* se captura valor de ese atributo al que estoy dando click  */

		if(quitarImagen == listaTemporales[i]){  /* pues si el valor que estoy capturando es == a un valor de los valores que tengo temporlmente  */

			listaTemporales.splice(i, 1);  /* => quitar ese indice del array  */

			$(".InputNuevaGaleria").val(JSON.stringify(listaTemporales)); /* array actualizado con un indice menos y convertido en cadena texto de json  */

			 $(this).parent().parent().remove();  /* borra la imagen de la vista , salir del button , salir del div y remove li  */

		}

	}

})

/*=============================================
AGREGAR VIDEO
=============================================*/

$(".agregarVideo").change(function(){

	var codigoVideo = $(this).val();

	$(".vistaVideo").html(
    
    `<iframe width="100%" height="320" src="https://www.youtube.com/embed/`+codigoVideo+`" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`

  )


})

/*=============================================
AGREGAR IMAGEN 360
=============================================*/

$("#imagen360").change(function(){

	var imagen = this.files[0];  /* captura la imagen en su indice zero porque solamente viene una */

	/*=============================================
	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
	=============================================*/

	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

		$("#imagen360").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen debe estar en formato JPG o PNG!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else if(imagen["size"] > 2000000){

		$("#imagen360").val("");

		swal({
			title: "Error al subir la imagen",
			text: "¡La imagen no debe pesar más de 2MB!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});

	}else{

		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen); 

		$(datosImagen).on( "load", function(event){

			var rutaImagen = event.target.result;  /* imagen temporal de de 360 grados  */

			 $(".ver360").html(  /* añado este div poque no aparece cuando no hay imagen */

			 	`<div class="pano 360Nuevo" back="`+rutaImagen+`">

                    <div class="controls">
                      <a href="#" class="left">&laquo;</a>
                      <a href="#" class="right">&raquo;</a>
                    </div>

                  </div>`

			)

			$(".360Nuevo").pano({  /* se le aplica al div nuevo es decir el div temporal la clase pano del plugin paraque se muestra imagen panoramica */
		        img: $(".360Nuevo").attr("back")
		    });

		})

	}

})

/*=============================================
QUITAR IMAGEN VIEJA GALERÍA
=============================================*/

$(document).on("click", ".quitarFotoAntigua", function(){

	var listaFotosAntiguas = $(".quitarFotoAntigua"); 

	var listaTemporales = $(".inputAntiguaGaleria").val().split(",");

	for(var i = 0; i < listaFotosAntiguas.length; i++){

		quitarImagen = $(this).attr("temporal");

		if(quitarImagen == listaTemporales[i]){

			listaTemporales.splice(i, 1);

			$(".inputAntiguaGaleria").val(listaTemporales.toString());

			$(this).parent().parent().remove();

		}

	}
})


/*=============================================
GUARDAR HABITACIÓN
=============================================*/
$(".guardarHabitacion").click(function(){

/* 	var idHabitacion = $(".idHabitacion").val(); */

	var tipo = $(".seleccionarTipo").val().split(",")[1];      console.log(tipo);
	var tipo_h = $(".seleccionarTipo").val().split(",")[0];   console.log(tipo_h);

	var estilo = $(".seleccionarEstilo").val();      console.log(estilo);
    
	
	var galeria = $(".InputNuevaGaleria").val();        console.log(galeria);          /* archivos en formato 64 strings */
	/* var galeriaAntigua = $(".inputAntiguaGaleria").val(); */


	var video = $(".agregarVideo").val();      console.log(video);    

	var recorrido_virtual = $(".360Nuevo").attr("back");   console.log(recorrido_virtual);
	/* var antiguoRecorrido = $(".antiguoRecorrido").val(); */

	var descripcion = $(".ck-content").html();          console.log(descripcion);


	if(tipo == "" || tipo_h == ""){

		swal({
	        title: "Error al guardar",
	        text: "El campo 'Elija Categoría' no puede ir vacío",
	        type: "error",
	        confirmButtonText: "¡Cerrar!"
	      });

    	return;

	}else if(estilo == ""){

	    swal({
	        title: "Error al guardar",
	        text: "El campo 'Nombre habitación' no puede ir vacío",
	        type: "error",
	        confirmButtonText: "¡Cerrar!"
	      });

	    return;

	}else if(video == ""){

	    swal({
	        title: "Error al guardar",
	        text: "El campo de 'Vídeo' no puede ir vacío",
	        type: "error",
	        confirmButtonText: "¡Cerrar!"
	      });

	    return;

	}else if(descripcion == ""){

	    swal({
	        title: "Error al guardar",
	        text: "El campo de 'Descripción' no puede ir vacío",
	        type: "error",
	        confirmButtonText: "¡Cerrar!"
	      });

	    return;

  	}else{

    	var datos = new FormData();
    	datos.append("tipo_h", tipo_h);
    	datos.append("tipo", tipo);
    	datos.append("estilo", estilo);
     	datos.append("Galeria", galeria);
    	datos.append("video", video);
    	datos.append("recorrido_virtual", recorrido_virtual);
    	datos.append("descripcion", descripcion);

    	 $.ajax({

		    url:"ajax/habitaciones.ajax.php",
		    method: "POST",
		    data: datos,
		    cache: false,
		    contentType: false,
		    processData: false,
	      	success:function(respuesta){

      			if(respuesta == "ok"){

      				swal({
		                type:"success",
		                  title: "¡CORRECTO!",
		                  text: "¡La habitación ha sido guardada exitosamente!",
		                  showConfirmButton: true,
		                confirmButtonText: "Cerrar"
		                
		              }).then(function(result){

		                  if(result.value){

		                    window.location = "habitaciones";

		                  }

		              });

      			}

      		}

      	})

        
    }


})


/*=============================================
Eliminar Habitacion
=============================================*/

$(document).on("click", ".eliminarHabitacion", function(){

  var idEliminar = $(this).attr("idEliminar");

  var galeriaHabitacion = $(this).attr("galeriaHabitacion");

  var recorridoHabitacion = $(this).attr("recorridoHabitacion");

  swal({
    title: '¿Está seguro de eliminar esta Habitación?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar Habitación!'
  }).then(function(result){

    if(result.value){

        var datos = new FormData();
        datos.append("idEliminar", idEliminar);
        datos.append("galeriaHabitacion", galeriaHabitacion);
        datos.append("recorridoHabitacion", recorridoHabitacion);

        $.ajax({

          url:"ajax/habitaciones.ajax.php",
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
                  text: "La habitación ha sido borrada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "habitaciones";

                    }
                })

             }

          }

        })
    }
  
  })

})



