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
	"order":[[0,"desc"]]
	


});