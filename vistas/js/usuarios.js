/*=============================================
LIMPIAR FORMULARIOS DE REGISTRO E INGRESO     
=============================================*/
$('.modal.formulario').on('hidden.bs.modal', function(){

    $(this).find('form')[0].reset();

})
/*=============================================
FORMATEAR LOS IPUNT
=============================================*/
$('input[name="registroEmail"]').change(function(){

	$(".alert").remove();

})





/*=============================================
VALIDAR EMAIL REPETIDO    => para validar , tomar en accion cuando se cambian input de registro de email en formulario registro user 
=============================================*/

$('input[name="registroEmail"]').change(function(){

    var email = $(this).val();    /*  console.log("email",email); */   
    
    var datos = new FormData();
    datos.append("validarEmail",email);

	$.ajax({

		url:urlPrincipal+"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){                    /* si existe email en tabla user devuelve registro relacionado con el email */
               
               /*  console.log('correo', respuesta); */
            
             	if(respuesta){      /* => segnifica si respuesta viene (verdadero) con inforamacion */

				var modo = respuesta["modo"];

				if(modo == "directo"){

					modo = "esta página";

				}

				$("input[name='registroEmail']").val("");

				$("input[name='registroEmail']").after(`

				<div class="alert alert-warning">
					<strong>ERROR :</strong>
					El correo electrónico ya existe en la base de datos, fue registrado a través de `+modo+`, por favor ingrese otro diferente
				</div>

                `);
                 /* => la idea es cuando vuelva dar click en input para insertar crreo nuevo que no exista en base dedatos desparece esta alerta -   FORMATEAR LOS IPUNT  */

				return;

			}
		 
		}

	})


	
})