/*=============================================
Tabla Administradores
=============================================*/
    /* => solicitamos informacion para data table atraves de ajax  */  /* necesito traeme la inf de la tabla administradores  */
/*   $.ajax({ 
 	
	"url":"ajax/tablaAdministradores.ajax.php",
 	success: function(respuesta){
		
 		console.log("respuesta", respuesta);

 	}

 })   */

/* => vamos a decirle que se aplique el plufin tabla datatable a tabla administradores  */
$(".tablaAdministradores").DataTable({

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
		"url":"ajax/tablaAdministradores.ajax.php",
		"dataSrc":""
	},
	"columns": [    /* => impor */
		{ "data": "id" },
		{ "data": "Nombre" },
		{ "data": "Usuario" },
		{ "data": "Perfil" },
		{ "data": "Estado" },
		{ "data": "Acciones" }
	],
	"resonsieve":"true",
	"bDestroy":true,
	"iDisplayLength":10,
	"order":[[0,"asc"]]
	


});

/*=============================================
Editar Administrador
=============================================*/

$(document).on("click", ".editarAdministrador", function(){   /* => dicument es depues de cargar la pagina , paraque cuando damos clcik u para un elemento de 2 grado nos tome las funcciones como en este caso en dispositivo movil */

	var idAdministrador = $(this).attr("idAdministrador");

	var datos = new FormData();
  	datos.append("idAdministrador", idAdministrador);

  	$.ajax({
  		url:"ajax/administradores.ajax.php",  /* => esta peticion ajax no la puedo hacer a archivo ajax de datatable . porque el archivo de datatable esta disparando respuesta automaticamente es decir no estamos poniendo ningu filtro de variables post */
  		method: "POST",
  		data: datos,
  		cache: false,
		contentType: false,
    	processData: false,
    	dataType: "json",
    	success:function(respuesta){ 	

		   /*   console.log(respuesta); */   /* => lo siguientes inputs les doy valores de lo que viene en respuesta son inputs de modal editar */

    	 	$('input[name="editarId"]').val(respuesta["id"]);
    		$('input[name="editarNombre"]').val(respuesta["nombre"]);
    		$('input[name="editarUsuario"]').val(respuesta["usuario"]);
    		$('input[name="passwordActual"]').val(respuesta["password"]);
    		$('.editarPerfilOption').val(respuesta["perfil"]);
    		$('.editarPerfilOption').html(respuesta["perfil"]); 

    	}

  	}) 

})
/*=============================================
Activar o desactivar administrador
=============================================*/

$(document).on("click", ".btnActivar", function(){   /* => aplicar clase despues de cargar el documento paraque funnciona en botones de dispositivos movil de 2 grado  */

	var idAdmin = $(this).attr("idAdmin");
	var estadoAdmin = $(this).attr("estadoAdmin");
	var boton = $(this);  /* asi capturamos el elento donde estamos en este caso butto para modificar mas adelante los valores de atrributos */

	var datos = new FormData();
  	datos.append("idAdmin", idAdmin);
  	datos.append("estadoAdmin", estadoAdmin);

  	 $.ajax({

      url:"ajax/administradores.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
      	
      	if(respuesta == "ok"){

      		if(estadoAdmin == 0){    /* => cambiar estilos del button sin necesidades de actualizar la pagina  */

      			 $(boton).removeClass('btn-info');
      			 $(boton).addClass('btn-dark');
      			 $(boton).html('Desactivado');  /* => rempolazar */
      			 $(boton).attr('estadoAdmin', 1); /* => dar valor al atrributo  */

      		}else{

	            $(boton).addClass('btn-info');
	            $(boton).removeClass('btn-dark');
	            $(boton).html('Activado');
	            $(boton).attr('estadoAdmin',0);

	        }

      	}

      }

    })  

})

/*=============================================
Eliminar Administrador
=============================================*/
$(document).on("click", ".eliminarAdministrador", function(){   /* => paraque se aplica la funccion a los botones de los despositivos moviles  */

	var idAdministrador = $(this).attr("idAdministrador");

	if(idAdministrador == 8){   /* => es el id del administrador ejecutivo */

		swal({
          title: "Error",
          text: "Este administrador no se puede eliminar",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

        return;

	}

	swal({
	    title: '¿Está seguro de eliminar este administrador?',
	    text: "¡Si no lo está puede cancelar la acción!",
	    type: 'warning',
	    showCancelButton: true,
	    confirmButtonColor: '#3085d6',
	    cancelButtonColor: '#d33',
	    cancelButtonText: 'Cancelar',
	    confirmButtonText: 'Si, eliminar administrador!'
	  }).then(function(result){

	    if(result.value){

	    	var datos = new FormData();
       		datos.append("idEliminar", idAdministrador);

       		$.ajax({

	          url:"ajax/administradores.ajax.php",
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
	                  text: "El administrador ha sido borrado correctamente",
	                  showConfirmButton: true,
	                  confirmButtonText: "Cerrar",
	                  closeOnConfirm: false
	                 }).then(function(result){

	                    if(result.value){

	                      window.location = "administradores";

	                    }
	                
	                })

	          	}

	          }

	        })  

	    }

	})

})
