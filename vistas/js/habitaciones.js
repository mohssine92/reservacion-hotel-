/*=============================================
COLOCAR ACTIVO EL PRIMER BOTÓN 
=============================================*/

var enlacesHabitaciones = $(".cabeceraHabitacion ul.nav li.nav-item a");  /* ubico elemento a , aquien quiero ejecutar ciertos funcciones  */ /* elemento a en su html representa un array de estilos obtenido de base de datos  */
var tituloBtn = [];  /*lo iniciamos como array vacio para cargarlo luego con informaciones  */


for(var i = 0; i < enlacesHabitaciones.length; i++){  /* recorrer el array  enlacesHabitaciones  */

	$(enlacesHabitaciones[i]).removeClass("active");   /* si algun elemento del array  enlacesHabitaciones tiene la classe active  lo remuevas es decir lo quitas  */
	$(enlacesHabitaciones[i]).children("i").remove();  /* necesito cuando hagamos recorrido a todo enlacesHabitaciones la etiqueta de iconos que este dentro lo remueva es decir lo quita  */
    tituloBtn[i] = $(enlacesHabitaciones[i]).html();   /* el array tituloBtn en todos los indix toma el valor que tenga enlacesHabitaciones en su html*/ /* asi en array tituloBtn en su array va tener titulos para todos butones   */
}

$(enlacesHabitaciones[0]).addClass("active"); /* necesito al principio siempre me muestro al indice [0] la clase active */
$(enlacesHabitaciones[0]).html('<i class="fas fa-chevron-right"></i>'+ tituloBtn[0]);/* pero al indice [0] de enlacesHabitaciones yo necesito adicionar el icono y tambien concatenar tituloBtn[o] en su index 0 */
                                                                                      /* es decir le estoy rescribiendo con el original html obtenido de la tabla en su propiedad estilos */


/* eleminar el borde derecho del ultimo elemento a  , se hace con esta manera porque los elementos a seran listado de manera dinamica y jamas sabemos cual sera el ultima - se cambia depende de la categoria , cada categorias tiene un numero diferente de estilos */
$(enlacesHabitaciones[enlacesHabitaciones.length -1]).css({"border-right":0})



/*=============================================
ENLACES HABITACIONES
=============================================*/
$(".cabeceraHabitacion ul.nav li.nav-item a").click(function(e){   /* cuando doy click sobre cualquiera de estos elementos a - el la realidad son estilos de habitacions disponibles en la categoria selleccionada  */

	e.preventDefault();  /* anular cualquier tipo evento pueda emitir elemento a hacia la barra url */ /* es decir cualquier evento que provoca href */
	
	/* capturacion de attributos que vengan en el elemento a clickeado (sabemos que tenemos lo elementos a , distrubuidos dinamicamente lo que resuelta estos dos variables cada vez captan valores diferentes segun donde cliqueamos) */
	var orden = $(this).attr("orden");
	var ruta = $(this).attr("ruta"); /* su valor es una propiedad de tabla categorias , es lo que hace falta mandar atraves de ajax a php , al controlador de php para sacar infs   */
   

	for(var i = 0; i < enlacesHabitaciones.length; i++){   /* recorrer el array  enlacesHabitaciones  */

		$(enlacesHabitaciones[i]).removeClass("active");   /* si algun elemento del array  enlacesHabitaciones tiene la classe active  lo remuevas es decir lo quitas  */
		$(enlacesHabitaciones[i]).children("i").remove();  /* necesito cuando hagamos recorrido a todo enlacesHabitaciones la etiqueta de iconos que este dentro lo remueva es decir lo quita  */
		tituloBtn[i] = $(enlacesHabitaciones[i]).html();  /* el array tituloBtn en todos los indix toma el valor que tenga enlacesHabitaciones en su html*/ /* asi en array tituloBtn en su array va tener titulos para todos butones   */
	}

	$(enlacesHabitaciones[orden]).addClass("active"); /* es decir el atributo orden que vienne con elemento cliqueado que le adicione clase active es decir elemento a , cliquedo selepone classe avtivado  */
	$(enlacesHabitaciones[orden]).html('<i class="fas fa-chevron-right"></i>'+ tituloBtn[orden]);  /* y ponerle el html del elemento del mismo orden , sabemos el orden es el index conseguido en listar los datos devueltos en nuestra consulta  */
																								   /* de obtener los estilos disponibles en categoria selleccionada  */   
						
	/*=============================================
	    AJAX HABITACIONES
	=============================================*/	
	
	var datos = new FormData();       /* iniciamos objeto tipo formdata  */  /* asimulara un formulario para crear variables post  */
	datos.append("ruta", ruta);      /*  agregamos una variable post se va llamar ruta y su valor sera la variable $ruta  */
	

	/* vamos a ejecutar ajax  */
	$.ajax({

		url:urlPrincipal+"ajax/habitaciones.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			console.log(respuesta);
			
		}

	})
	




})