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



/*=============================================
BOTÓN FACEBOOK   
=============================================*/

$(".facebook").click(function(){    /* => cuando doy click a esta clase  */ /* => la clase la ponemos en button para registro con facebook */

	FB.login(function(response){    /* => funccion de facebook */  /* muestra ventana de facebook-connect */
         
      /* console.log("fb_resp", response);  */ /* ? a ver que me devuelve facebook en response como respuesta  */ /* ami necesito id del uder desde api de facebook , para solicitar nombre foto email */
        
      validarUsuario();

	}, {scope: 'public_profile, email'})  /* cuando le pedi el escope de public_profile y el  email  */

})

/*=============================================
VALIDAR EL INGRESO
=============================================*/

function validarUsuario(){

	FB.getLoginStatus(function(response){   /* => es funccion de facebook  */

		statusChangeCallback(response);   /* devuelva 2 respuestas , un error si user no esta conectado a su facebook, en caso contrario ejecuta la funccion que se va ejecutar solicitud de informacion de la api de facebook   */

	})

}

/*=============================================
VALIDAMOS EL CAMBIO DE ESTADO EN FACEBOOK
=============================================*/

function statusChangeCallback(response){

	if(response.status === 'connected'){   

		testApi();    /* => dentro de ella se ejecuta la funccion de solicitud informacion del usuario conectado a facebook  */

    }else{   
              /* => ojo, si el estado no esta connectado , mandamos un mensaje de nuestra aplicacion de eroor al user  */
		swal({
			type: "error",
            title: "¡ERROR!",
            text: "¡Ocurrió un error al ingresar con Facebook, vuelve a intentarlo!",
            showConfirmButton: true,
	        confirmButtonText: "Cerrar"
	
		}).then(function(result){

			if(result.value){   
              	history.back();
            } 
      	});

	} 

}

/*=============================================
INGRESAMOS A LA API DE FACEBOOK
=============================================*/

function testApi(){    /* => pues esta funccion que nos va traer toda informacion del usuario  conectado a facebook  */

	FB.api('/me?fields=id,name,email,picture',function(response){   /* FB.api , es la api de facebook a , ? luego viene como parametro lo que pidemos a la api de facebook , campos id , email .... */

		if(response.email == null){

			swal({
				type: "error",
	          title: "¡ERROR!",
	          text: "¡Para poder ingresar al sistema debe proporcionar la información del correo electrónico!",         
	        showConfirmButton: true,
			confirmButtonText: "Cerrar"
		
			}).then(function(result){

				if(result.value){  
	              	history.back();
	            } 
	      	});

	      	return;   /* => return para para cualquier proceso , email es muy imporatnate para nosotros para crear user en nuestra base de datos , si no viene email no dejamos completar proceso de creacion de user een..  */

		}else{

			var email = response.email;       
			var nombre = response.name;
            var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";    /* http://graph.facebook.com/ => esta es la ruta que tiene Facebook para visualizar fotos  */
            
           /*  console.log("resp.email=> ",email ); */       /* => ya facebook nos esta devolviendo datos que nosostros necesitamos : estos son datos con quien creamos nuevo usurio   */ 
            /* console.log("resp.nombre=>",nombre); */
           /*  console.log("resp.foto=>",foto); */

           var datos = new FormData();
           datos.append("email", email);
           datos.append("nombre",nombre);
           datos.append("foto",foto);

           $.ajax({

               url:urlPrincipal+"ajax/usuarios.ajax.php",
               method:"POST",
               data:datos,
               cache:false,
               contentType:false,
               processData:false,
               success:function(respuesta){

                    console.log("respuesta.ajax.isnert.user=>",respuesta);

                    if(respuesta == "okfacebook"){

                        window.location = urlPrincipal+"perfil";
                    
                    }else{

						swal({
						  type: "error",
						  title: "¡ERROR!",
						  text: "¡El correo electrónico "+email+" ya está registrado con un método diferente a Facebook!",				          
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar",
						  allowOutsideClick: false
					
						}).then(function(result){
					
							if(result.value){                                /* en caso el email se encuentra registrado antes de otro modo , necesito borrar las cookies de session de facebook que se generaron justo antes  */ 
					
								 FB.getLoginStatus(function(response){	
					
									  if(response.status === 'connected'){     
					
											  FB.logout(function(response){
					
												  deleteCookie("fblo_139453148022040");  /* =>le pasamos identificador de la app que hemos creado en facebook-developper , para borra cookies de session del usuari  */
												                     
												  setTimeout(function(){
					
														 window.location=urlPrincipal+"salir";
					
												   },500)
					
											  });
					
											  function deleteCookie(name){  /* => tambien necesito que me borre toda informacion de esta cookie */
					
													  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1992 00:00:01 GMT;';
											 }
					
									  }
					
								 })
					
							}							
					
						})
					
					}
                   
                  
               }

           })

			

		}

	})

}


