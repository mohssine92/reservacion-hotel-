<?php
session_start();    /*=> Con esta funccion  Disparamos al systema que vamos a usar variable de session  */   /* => atraves de variables de session filtramos tipo de usuarios , porque hay pagina donde no se permmite a usuasrios 
                    que no estan registrados en systema acceder a ellas */

/* variables de rutas en el proyecto  */  /* esta funcciones se ejecutan de manera statica nada mas arrancar el proyecto  */
$ruta = ControladorRuta::ctrRuta();  /* simplemente me devuelve ruta raiz del frontend que voy a estar usando en redericcionamiendo y carga de contenido en frontend */
$servidor = ControladorRuta::ctrServidor();  /* solicito infos al controlador de rootas - me returna  roota del backend   */


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">	

	<title>Hotel Portobelo</title>

	<base href="vistas/">

	<link rel="icon" href="img/icono.jpg">

	<!--=====================================
	VÍNCULOS CSS
	======================================-->

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Fuente Open Sans y Ubuntu -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300|Ubuntu" rel="stylesheet">

	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="css/plugins/bootstrap-datepicker.standalone.min.css">

	<!-- datetimepicker --> <!-- estilos de calendario medical  -->
	<link rel="stylesheet" href="css/plugins/jquery.datetimepicker.css">

	<!-- jdSlider -->
	<link rel="stylesheet" href="css/plugins/jquery.jdSlider.css">

	<!-- Pano -->
	<link rel="stylesheet" href="css/plugins/jquery.pano.css">

	 <!-- fullCalendar -->
	<link rel="stylesheet" href="css/plugins/fullcalendar.min.css">

	<!-- Hoja de estilo personalizada -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/habitaciones.css">
	<link rel="stylesheet" href="css/reservas.css">
	<link rel="stylesheet" href="css/perfil.css">

	<!--=====================================
	VÍNCULOS JAVASCRIPT
	======================================-->

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

	<!-- bootstrap datepicker -->
	<!-- https://bootstrap-datepicker.readthedocs.io/en/latest/ -->
	<script src="js/plugins/bootstrap-datepicker.min.js"></script>

    <!-- datetimepicker -->  <!-- calendario medical  -->
	<!-- https://xdsoft.net/jqplugins/datetimepicker/ -->
	<script src="js/plugins/jquery.datetimepicker.full.min.js"></script>

	<!-- https://easings.net/es# -->
	<script src="js/plugins/jquery.easing.js"></script>

	<!-- https://markgoodyear.com/labs/scrollup/ -->
	<script src="js/plugins/scrollUP.js"></script>

	<!-- jdSlider -->
	<!-- https://www.jqueryscript.net/slider/Carousel-Slideshow-jdSlider.html -->
	<script src="js/plugins/jquery.jdSlider-latest.js"></script>

	<!-- Pano --> <!-- pluigin para colocar imagenes de 360 grados  -->
	<!-- https://www.jqueryscript.net/other/360-Degree-Panoramic-Image-Viewer-with-jQuery-Pano.html -->
	<script src="js/plugins/jquery.pano.js"></script>

	<!-- fullCalendar -->
	<!-- https://momentjs.com/ -->
	<script src="js/plugins/moment.js"></script>
	<!-- https://fullcalendar.io/docs/background-events-demo -->	
	<script src="js/plugins/fullcalendar.min.js"></script>

	<!-- JQUERY NUMBER -->	
	<!-- https://plugins.jquery.com/df-number-format/ -->
	<script src="js/plugins/jquerynumber.js"></script>

	<!-- SWEET ALERT 2 alerta swave  -->	
	<!-- https://sweetalert2.github.io/ -->  <!-- gracias a este plugin de alerta suave puedo recagar la pagina  -->
	<script src="js/plugins/sweetalert2.all.js"></script>

	<!-- Moment js plugin -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/es.min.js"></script>

   
     <!-- Paypal -->
    <!-- https://developer.paypal.com/docs/checkout/ -->
	<script src="https://www.paypal.com/sdk/js?client-id=AZFERy-A4VTt6ORuWKly7c2Gd7IDIWzwA5fy10J02c2bdiEOyd6UbXkeifkuLXuzLW24ZxX_8rSN2Ktv"></script>

</head>
<body>

<?php

include "paginas/modulos/header.php";   /* esto es mi navbar se va estar cargardo en todas paginas   */
include "paginas/modulos/modal.php"; /* => la subimos arriba para no tener problema con el formulario de registro user  que portan , en general son cajas occultas y fijas asi no van a afectar nuestro html en nada si incluimos aqui
									  son cajas parecen con reaccion a botones y en posicion fixado ..   */

/*=============================================
PÁGINAS
=============================================*/
if(isset($_GET["pagina"])){          /* de aqui se va cambiando contenido html debajo del navbar en funccion de de la condicion -> par rederigirnos a paginas  */

	$rutasCategorias = ControladorCategorias::ctrMostrarCategorias(); /* objetivo rutas en tabla categorias */
	$validarRuta = "";
	
	foreach ($rutasCategorias as $key => $value) {

		if($_GET["pagina"] == $value["ruta"]){

			$validarRuta = 'habitaciones';

		}
		
	}

	/*=============================================
	VALIDAR CORREO  => necesito verificar si ese texto de email encryptado , si ese hash de md5() del correo electronico que viene encryptado existe en la base de datos 
	=============================================*/

	$item = "email_encriptado";
	$valor = $_GET["pagina"];    /* => recuerda  $_GET["pagina"] es el primer parametro despues del dominio es donde llega correo en hash de med5()  */ /* relacionado con un usario un registro , una entidad  */

	$validarCorreo = ControladorUsuarios::ctrMostrarUsuario($item, $valor); /* => pongo clase estatica porque espera una respuesta , va almacenar un valor */  /* si existe hash corro entonces ya encontramos al coincidencia */

	if($validarCorreo["email_encriptado"] == $_GET["pagina"]){   /* si coincidan segnifica que el usuario real correo correcto  */

		$id = $validarCorreo["id_u"];
		$item = "verificacion";
		$valor = 1; 

		$verificarUsuario = ControladorUsuarios::ctrActualizarUsuario($id, $item, $valor);    /* =>ojo , llegar a este proceso toca cambiar valor de verificacion 0 : no esta verificado , 1 esta verificado ,  */

	 	if($verificarUsuario == "ok"){ 

			echo'<script>

					swal({
							type:"success",
						  	title: "¡CORRECTO!",
						  	text: "¡Su cuenta ha sido verificada, ya puede ingresar al sistema!",
						  	showConfirmButton: true,
							confirmButtonText: "Cerrar",
							allowOutsideClick: false
						  
					}).then(function(result){

							if(result.value){   
							    history.back();
							  } 
					});

				</script>';

			return;   /* => con return cancelamos cualquier proceso puedo occurir de aqui para abajo .  */

	 	} 


	}

	/*=============================================
	     LISTA BLANCA DE PÁGINAS INTERNAS
	=============================================*/
	
	if($_GET["pagina"] == "habitaciones"){

		include "paginas/habitaciones.php";
		
	}

	if($_GET["pagina"] == "reservas" || $_GET["pagina"] == "perfil" || $_GET["pagina"] == "salir"){

		include "paginas/".$_GET["pagina"].".php";  /* => buscalo en carpetra paginas y incluilo */
	

	}else if ($validarRuta != "" ){

		include "paginas/habitaciones.php";
           

	}else{
        echo '<script>
	             window.location = "'.$ruta.'";    
	         </script>';
    } /* redericcionMIENTO */
	

}else{

	  include "paginas/inicio.php";

}



/*=============================================
     FOOTER => igual para todas paginas , o podemos poner una condicion php , se cambias dinamicamente depende de la ruta etc ....
=============================================*/
include "paginas/modulos/footer.php";



?>

<!-- estos dos variables seran captadas en cualquiera de estos ficheros de javasvript de abajo  -->
<!-- traerme la ruta de mi hosting porque la necesito para ubicar archivo ajax en mi fichero de habitacion.js  - porque voy a hacer una peticion sincrona ajax al controlador habitaciones para traer toda informacion sobre habitaciones  -->
<input type="hidden" value="<?php echo $ruta; ?>" id="urlPrincipal"> <!-- de esta manera llevo la variable ruta de php  a javascript  -->
<input type="hidden" value="<?php echo $servidor; ?>" id="urlServidor"> <!-- por si acaso necesitamos url del servidor  -->

<script src="js/plantilla.js"></script>  <!-- nada mas la var urlPrincipal  y var urlSeervidor estan incluidas en este fichero ya puedo urulizarlas en los siguientes ficheros de javascript en incorporarse   -->
<script src="js/menu.js"></script>
<script src="js/idiomas.js"></script>
<script src="js/habitaciones.js"></script>
<!-- ficheros de consultar filtrar disponiblida valen para habitaciones , coches etc depende del proyecto  -->
 <script src="js/reservas.js"></script>    <!-- Escenario 1 - donde el usuario ver dipo y selecciona habita o coche etcc -->
<!-- <script src="js/reservas2.js"></script>  --> <!-- segunda opcion escenario 2  - user sslect cat o sub cat - systema devuelve - la hab o coche dispo en la cat o subcat seleccionada  -->

<!-- formulario seleccionar por horas  -->
<!-- <script src="js/agendas.js"></script> -->    <!-- selccionar dia de cita y hora : cita medical : donde paciente ve la dispo de los medicos en la cat y selecciona el que quiera depende de disponiblidad -->
<!-- <script src="js/agendas2.js"></script> -->   <!-- escenario dos de consulta medica , donde el paciente selecciona dia y hora y el systema le devuelva uno de los medicos que estan disponibles en la especialidad seleccionada  -->
<!--------------- -->
<script src="js/paypal.js"></script> 
<script src="js/usuarios.js"></script> 
<script src="js/sdk-connect-session-facebook.js"></script>  <!-- => se indica en la documentacion debe ser cargado  despues del body -->
	
</body>
</html>
