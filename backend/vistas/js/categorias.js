/*=============================================
Tabla Categorias
=============================================*/
   /* es muy importante ejecutar esta consola te muestra donde esta el fallo en jax - para resolver rapidamente al momento de integrar  */
/*  $.ajax({

     "url":"ajax/tablaCategorias.ajax.php",
     success: function(respuesta){
      
      console.log("respuesta", respuesta);

     }

 })
 */

$(".tablaCategorias").DataTable({
  "ajax":"ajax/tablaCategorias.ajax.php",
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
Subir imagen temporal Categoria
=============================================*/

$("input[name='subirImgCategoria'], input[name='editarImgCategoria']").change(function(){

  var imagen = this.files[0];
  
  /*=============================================
    VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
    =============================================*/

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

      $("input[name='subirImgCategoria'], input[name='editarImgCategoria']").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen debe estar en formato JPG o PNG!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else if(imagen["size"] > 2000000){

      $("input[name='subirImgCategoria'], input[name='editarImgCategoria']").val("");

       swal({
          title: "Error al subir la imagen",
          text: "¡La imagen no debe pesar más de 2MB!",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

    }else{
 
      var datosImagen = new FileReader;
      datosImagen.readAsDataURL(imagen);

      $(datosImagen).on("load", function(event){

        var rutaImagen = event.target.result;

        $(".previsualizarImgCategoria").attr("src", rutaImagen);  /* imagen bajo codificacion 64 */

      })

    }

})

/*=============================================
Ruta Categorias  : este codigo nos va a permitir escribir las rutas de categorias correctamente 
=============================================*/

function limpiarUrl(texto){                  /* => este params recibe el texto que se esta escribiendo en el input ingresar ruta de la categoria  */

	var texto = texto.toLowerCase();        /* => capturar el texto que se esta escribiendo en este input  y conviertelo en miniscula  primer paso -*/
	texto = texto.replace(/[á]/g, 'a');    /* la paraque se la encuentra varias veces remplaza ....etc  */
	texto = texto.replace(/[é]/g, 'e');
	texto = texto.replace(/[í]/g, 'i');
	texto = texto.replace(/[ó]/g, 'o');
	texto = texto.replace(/[ú]/g, 'u');
	texto = texto.replace(/[ñ]/g, 'n');
	texto = texto.replace(/ /g, '-');

	return texto;  /* returnar ese parametro cuando toodo este listo  */

}

$(document).on("keyup", "input[name='rutaCategoria'],  input[name='editarRutaCategoria'] ", function(){  /* en documento cuando se esta teclando en el input indicado ....aplica la siguiente funccion ... */

	$("input[name='rutaCategoria']").val(

		limpiarUrl($("input[name='rutaCategoria']").val())  /* => como hemos indicado estamos pasando valor en params en tiempo real , ver about event Keyup
     */

	)

  $("input[name='editarRutaCategoria']").val(

		limpiarUrl($("input[name='editarRutaCategoria']").val())  /* => como hemos indicado estamos pasando valor en params en tiempo real , ver about event Keyup */

	)




})

/*=============================================
Escoger Color
=============================================*/

 $(".colorPicker").colorpicker();   /* => al div donde esta el grupo capturo su classe , no olbvidar viculamiento del plugin fotos etc para correcto funccionmiento  */

/*=============================================
Escoger Características con ICHECK
=============================================*/

 $('input[type="checkbox"], input[type="radio"]').iCheck({  /* => todos inputs de type checkbox se le aplica la siguiente funccion con siguientes propiedaddes  */ /* paraque funccione  */

	checkboxClass: 'icheckbox_flat-blue',
	radioClass   : 'iradio_flat-blue'
}) 

var caracteristicasCategoria = [];        /* => este es el array donde vamos empujando las caracteristivas checkeadas  */  /* colleccion o array de objetos json */
var editarCaracteristicasCategoria = [];


$(".checkbox, .editarCheckbox").on("ifChecked", function(){   /*ifChecked => segnifica que estoy checkeando , relize la siguiente funccion */

	var item = $(this).val().split(",")[0];     /* ==> */  /* convertir cadena text en un array */   /* class="checkbox" type="checkbox" class="ml-3" value="Cama 2 x 2,fas fa-bed */
	var icono = $(this).val().split(",")[1];

	
  caracteristicasCategoria.push({

		"item": item,
		"icono": icono

	})    /* objeto json */
   /* console.log(caracteristicasCategoria); */    /* SERA UN JSON DE PHO DEBO CONVERTIRLO EN CADENA STRING PARA PODERR SUBIR A BASE DE DATOS  */

	$("input[name='caracteristicasCategoria']").val(JSON.stringify(caracteristicasCategoria));   /* array json ==> json string */




	editarCaracteristicasCategoria.push({   /* estara en uso cuando estoy en formulario editar categorias  */

	 	"item": item,
		"icono": icono

	})
	$("input[name='editarCaracteristicasCategoria']").val(JSON.stringify( editarCaracteristicasCategoria));  /* estara en uso cuando estoy en formulario editar categorias  */

})




$(".checkbox, .editarCheckbox").on("ifUnchecked", function(){    /* cuando descheckenado realize la siguiente funccion */

	var item = $(this).val().split(",")[0];
	var icono = $(this).val().split(",")[1];



	for(var i = 0; i < caracteristicasCategoria.length; i++){   /* recorrer el array donde empujaba los json checkeado  */

		if(caracteristicasCategoria[i]["item"] == item){   /* buscador de item en el array */

			caracteristicasCategoria.splice(i, 1);   /* cuando se encuentra el item quitame ese indice del array */

		 	$("input[name='caracteristicasCategoria']").val(JSON.stringify(caracteristicasCategoria)); /* despues de eleminar index checkbox , dar formato string json para mandarlo a base de datos de forma correcta*/

		}

	}



	for(var i = 0; i < editarCaracteristicasCategoria.length; i++){     /* estara en uso cuando estoy en formulario editar categorias  */

		if(editarCaracteristicasCategoria[i]["item"] == item){

	      editarCaracteristicasCategoria.splice(i, 1);

	      $("input[name='editarCaracteristicasCategoria']").val(JSON.stringify(editarCaracteristicasCategoria));

	  }

	}

})




/*=============================================
Editar Categoria
=============================================*/

$(document).on("click", ".editarCategoria", function(){

  var idCategoria = $(this).attr("idCategoria");

 /*  console.log(idCategoria); */

  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({

    url:"ajax/categorias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success:function(respuesta){

       /*   console.log("respuesta", respuesta); */

        $('input[name="idCategoria"]').val(respuesta["id_cat"]);

        $('input[name="editarRutaCategoria"]').val(respuesta["ruta"]);

        $('input[name="editarColorCategoria"]').val(respuesta["color"]);

        $(".colorPicker i").css({"background-color":respuesta["color"]})

        $('input[name="editarTipoCategoria"]').val(respuesta["tipo"]);

        $('input[name="imgCategoriaActual"]').val(respuesta["img"]);   /* si no se cambia se vueva a guardar */

        $('.previsualizarImgCategoria').attr("src", respuesta["img"]);  /* visualizar temporalmente  */

        $('textarea[name="editarDescripcionCategoria"]').val(respuesta["descripcion_cat"]);

        $('input[name="editar_continental_alta"]').val(respuesta["continental_alta"]);

        $('input[name="editar_continental_baja"]').val(respuesta["continental_baja"]);

        $('input[name="editar_americano_alta"]').val(respuesta["americano_alta"]);

        $('input[name="editar_americano_baja"]').val(respuesta["americano_baja"]);

        $('input[name="editarCaracteristicasCategoria"]').val(respuesta["incluye"]);   /* squi traer valores lo que contiene columna incluye  */

        var editarCheckbox = $(".editarCheckbox");  /* capto todos inputs checkbox que tengo en el forms  de editar categoria*/

        var incluye = JSON.parse(respuesta["incluye"]);  /* los string de base de datos se convierten  en objetos de json accesibles */  /*    console.log(incluye); */


        for(var i = 0; i < editarCheckbox.length; i++){   /* todo dentro se repita 8 veces  */

            $(editarCheckbox[i]).iCheck('uncheck'); /* descheckear todos index de editarCheckbox  */ /* ponerlas vacias  */
          /*   console.log(editarCheckbox[i]); */

	         for(var f = 0; f < incluye.length; f++){  /* solamente voy a checkear las que vienen de la base de datos */  
             
            /*  console.log(incluye[f]["item"]);
            console.log(" == a ",$(editarCheckbox[i]).val().split(",")[0]); */
	            if( incluye[f]["item"] == $(editarCheckbox[i]).val().split(",")[0]){  /* tener en cuenta incluye en cada recorrido es un json de 2 propiedades  */ 

	               $(editarCheckbox[i]).iCheck('check');  /* => entoces checkeamos el cajon donde hemos encontrado coincidencia  */

	            }
	          
	        }
 
        } /* Logica : en un index de total decheckbox se compara con todos indices de de incluye , asi recorriendo de nuevo siguiente checkbox del total existente comparar con todas la celeccion de incluye hasta terminar las comparacion total */
        
    }

  })  

})


$(document).on("click", ".cerrarModal", function(){


  location.reload();   /* evitando el error de que se triplica la textarea tambien hemos evitar el cierre desde fuera del modal  */


})

/*=============================================
Eliminar Categoria
=============================================*/
 
$(document).on("click", ".eliminarCategoria", function(){           /* Nb : no se puede elemminar categoria que tiene habitaciones , en este caso el orden sera  */

  var idCategoria = $(this).attr("idCategoria");
  var imgCategoria = $(this).attr("imgCategoria");
  var tipoCategoria = $(this).attr("tipoCategoria");

  var datos = new FormData();
  datos.append("categoria_id", idCategoria);

   $.ajax({

        url:"ajax/categorias.ajax.php",  /* consultar tabla de habitaciones  */
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success:function(respuesta){

          if(respuesta.length != 0){   /* => segnifica que hay habitaciones relacionadas  */

              swal({
                 title: "Esta categoría no se puede borrar",   /* porque la fotos de la habitacion la tenemos en una carpeta en el nobre de la categoria  */
                 text: "¡Tiene habitaciones vinculadas!",
                 type: "error",
                 confirmButtonText: "¡Cerrar!"
               });
   
               return;

          }
      
        }

   })
 
  swal({
    title: '¿Está seguro de eliminar este Categoría?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar Categoría!'
  }).then(function(result){

    if(result.value){
       
        var datos = new FormData();
        datos.append("idEliminar", idCategoria);
        datos.append("imgCategoria", imgCategoria);
        datos.append("tipoCategoria", tipoCategoria);

        $.ajax({

          url:"ajax/categorias.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,  /* aqui no usamos json en data tipe tampoco json encode por vamos arecibir solo un string dice ok */
          success:function(respuesta){

             if(respuesta == "ok"){
               swal({
                  type: "success",
                  title: "¡CORRECTO!",
                  text: "La categoria ha sido borrada correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                 }).then(function(result){

                    if(result.value){

                      window.location = "categorias";

                    }
                })

             }

          }

        })

      }

    })

})





