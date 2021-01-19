/*=============================================
COLOCAR ACTIVO EL PRIMER BOTÓN 
=============================================*/

var enlacesHabitaciones = $(".cabeceraHabitacion ul.nav li.nav-item a");  /* ubico elemento a , aquien quiero ejecutar ciertos funcciones  */ /* elemento a en su html representa un array de estilos obtenido de base de datos  */
var tituloBtn = [];  /*lo iniciamos como array vacio para cargarlo luego con informaciones  */


for(var i = 0; i < enlacesHabitaciones.length; i++){  /* recorrer el array  enlacesHabitaciones  */

	$(enlacesHabitaciones[i]).removeClass("active");   /* en esta linea recorre todod elementos a y les quito classe active */
	$(enlacesHabitaciones[i]).children("i").remove();  /* recorro todo elementos a , y les quito attributo i  */
    tituloBtn[i] = $(enlacesHabitaciones[i]).html();   /* y cada recorrido al elemento a capto su html y lo guardo en el array con su indice en registro en memoria dinamica   */
}

$(enlacesHabitaciones[0]).addClass("active");   /* elemento a de index 0 lo pongo classe active por defecto  */
$(enlacesHabitaciones[0]).html('<i class="fas fa-chevron-right"></i>'+ tituloBtn[0]);/* elemento a de indice 0 le añado etiqueta i y le concateno su html captado en memoria dinamica  */
																					
$(enlacesHabitaciones[enlacesHabitaciones.length -1]).css({"border-right":0})/* eleminar el borde derecho del ultimo elemento a  ,*/


/*=============================================
ENLACES HABITACIONES
=============================================*/
$(".cabeceraHabitacion ul.nav li.nav-item a").click(function(e){   /* cuando doy click sobre cualquiera de estos elementos a -  */

	e.preventDefault();  /* anular cualquier tipo evento pueda emitir elemento a hacia la barra url */ 
	
	/* capturacion de attributos que vengan en el elemento a clickeado (sabemos que tenemos lo elementos a , distrubuidos dinamicamente lo que resuelta estos dos variables cada vez captan valores diferentes segun donde cliqueamos) */
	var orden = $(this).attr("orden");
	var ruta = $(this).attr("ruta"); /* su valor es una propiedad de tabla categorias , es lo que hace falta mandar atraves de ajax a php , al controlador de php para sacar infs de latbla relacionada   */
   

	for(var i = 0; i < enlacesHabitaciones.length; i++){   

		$(enlacesHabitaciones[i]).removeClass("active");    /* limpiar elemento a */ 
		$(enlacesHabitaciones[i]).children("i").remove();   /* limpiar elemento a */
		tituloBtn[i] = $(enlacesHabitaciones[i]).html();    /* capturar los html  */
	}

	$(enlacesHabitaciones[orden]).addClass("active");                                                 /* avtive para elemento a del orden recibido  */
	$(enlacesHabitaciones[orden]).html('<i class="fas fa-chevron-right"></i>'+ tituloBtn[orden]);    /* ....  mismo proceso que antes */

	/*=============================================
	    AJAX HABITACIONES
	=============================================*/	
    
	var listaSlide = $(".slideHabitaciones .slide-inner .slide-area li"); /* capturar las listas del slider que tenemos las li : numero de li sera en funccion del indeces del objeto recorrido por php  */
    var alturaSlide = $(".slideHabitaciones .slide-inner .slide-area").height(); /* se vemos cada vez cambiamos elemento a el silder se recarga de nueva vamos a solucionarlo */
	                                                                            /* capturo el area del slide y capturo su altura */
	for(var i = 0; i < listaSlide.length; i++){
  
	   	$(".slideHabitaciones .slide-inner .slide-area").css({"height":alturaSlide+"px"}) /* cuando estamos quitando la etiquetas img en la minea de codigo de abajo */ /* antes de quitar img necesito que mantenga la altura que traea  */

		$(listaSlide[i]).html("");  /* vaciame todos li de sus image es el html de li , es decir todo html de li creado por foreach de php lo estoy vaciando con esta linea de codigo - asi borramos las etiquetas de img  */
                                  
	}


	
	var datos = new FormData();       /* iniciamos objeto tipo formdata  */  /* asimulara un formulario para crear variables post  */
	datos.append("ruta", ruta);      /*  agregamos una variable post se va llamar ruta y su valor sera la variable $ruta  */
	

	/* vamos a ejecutar ajax  */ /* obtener json de objetos desde la base de datos  para manipularlo a nivel de javascript  */
	$.ajax({

		url:urlPrincipal+"ajax/habitaciones.ajax.php",    /* la ubicacion de ajax para conectarnos a jax  */
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){  
         /*  console.log(respuesta[orden]); */
			
		 
            /* capturar y remmplazar el slider  */
		    var galeria = JSON.parse(respuesta[orden]["galeria"]);  /* recuerda que las imagenes viene en una columna galeria y vienen en un array , asi que vamos a convertir ese array en datos Json para manipularlo a nivel de javascript  */
		    console.log("galeria", galeria);                        /* eso quiere decir ya puedo recorre galeria a nivel de javascript gracias a la estructura llave : valor  */
		 
			for(var i = 0; i < galeria.length; i++){		
 
				$(listaSlide[0]).html('<img class="img-fluid" src="'+urlServidor+galeria[galeria.length-1]+'">')
   
				$(listaSlide[i+1]).html('<img class="img-fluid" src="'+urlServidor+galeria[i]+'">')
   
				$(listaSlide[galeria.length+1]).html('<img class="img-fluid" src="'+urlServidor+galeria[0]+'">')
			
			}  /* fin slider  */
		   

		  $(".videoHabitaciones iframe").attr("src", "https://www.youtube.com/embed/"+respuesta[orden]["video"]);  /* para el video capturado reemplazado segun indice del objeto donde se encuentra  */ 
		  
                         /* nombre variable valorde la variable*/
		  $("#myPano").attr("back", urlServidor+respuesta[orden]["recorrido_virtual"]);   /* capturado y cambiarle valor de imagen 360 grados segun indice de  objeto cliqueado  */
     
		  $(".descripcionHabitacion h1").html(respuesta[orden]["estilo"]+" "+respuesta[orden]["tipo"])    /* capturar */ /*  y darle valor html  */

		  $(".d-habitaciones").html(respuesta[orden]["descripcion_h"])   /* capturar */ /* ya darle valor html  */
		  
		  $('input[name="id-habitacion"]').val(respuesta[orden]["id_h"])   /* actualizar datos de value de este input  */




			
		}

	})
	




})