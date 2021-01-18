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
	
	var datos = new FormData();       /* iniciamos objeto tipo formdata  */  /* asimulara un formulario para crear variables post  */
	datos.append("ruta", ruta);      /*  agregamos una variable post se va llamar ruta y su valor sera la variable $ruta  */
	

	/* vamos a ejecutar ajax  */
	$.ajax({

		url:urlPrincipal+"ajax/habitaciones.ajax.php",    /* la ubicacion de ajax para conectarnos a jax  */
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			console.log(respuesta[orden]);
			
		}

	})
	




})