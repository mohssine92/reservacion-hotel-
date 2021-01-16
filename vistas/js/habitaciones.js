var enlacesHabitaciones = $(".cabeceraHabitacion ul.nav li.nav-item a");   /* ubico elemento a , aquien quiero ejecutar ciertos funcciones  */ /* elemento a en su html representa un array de estilos obtenido de base de datos  */
var tituloBtn = [];  /*lo iniciamos como array vacio para cargarlo luego con informaciones  */

for(var i = 0; i < enlacesHabitaciones.length; i++){    /* recorrer el array  enlacesHabitaciones  */

	$(enlacesHabitaciones[i]).removeClass("active");   /* si algun elemento del array  enlacesHabitaciones tiene la classe active  lo remuevas es decir lo quitas  */
	$(enlacesHabitaciones[i]).children("i").remove();  /* necesito cuando hagamos recorrido a todo enlacesHabitaciones la etiqueta de iconos que este dentro lo remueva es decir lo quita  */
	tituloBtn[i] = $(enlacesHabitaciones[i]).html();   /* el array tituloBtn en todos los indix toma el valor que tenga enlacesHabitaciones en su html*/ /* asi en array tituloBtn en su array va tener titulos para todos butones   */
}

$(enlacesHabitaciones[0]).addClass("active");  /* necesito al principio siempre me muestro al indice [0] la clase active */
$(enlacesHabitaciones[0]).html('<i class="fas fa-chevron-right"></i>'+ tituloBtn[0]); /* pero al indice [0] de enlacesHabitaciones yo necesito adicionar el icono y tambien concatenar tituloBtn[o] en su index 0 */
                                                                                      /* es decir le estoy rescribiendo con el original html obtenido de la tabla en su propiedad estilos */
