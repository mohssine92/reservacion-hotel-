<?php 
   session_start();

   $ruta = ControladorRuta::ctrRuta();                   /* dominio  */
   $rutaBackend = ControladorRuta::ctrRutaBackend();     /* dominio + backend */

   if(isset($_SESSION["idBackend"])){    /* detectamos el administrador por su id para consultar infs acerca de el */

    $admin = ControladorAdministradores::ctrMostrarAdministradores("id", $_SESSION["idBackend"]);
    
   /*  echo '<pre>'; print_r($admin); echo '</pre>'; */
  
  }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>   
   
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="x-ua-compatible" content="ie=edge">

     <title>Hotel Portobelo | backend </title>

     <!-- icono --> 
    <link rel="icon" href="vistas/img/plantilla/icono.jpg">

  <!--=====================================
	  VÍNCULOS CSS
	======================================-->

  <!-- Boostrap.css  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> 
  <!-- Font Awesome Icons -->
  <!-- <link rel="stylesheet" href="vistas/css/plugins/all.min.css"> -->
  <script src="https://kit.fontawesome.com/3126ef50ac.js" crossorigin="anonymous"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/css/plugins/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- DataTables -->
	<link rel="stylesheet" href="vistas/css/plugins/dataTables.bootstrap4.min.css">	
	<link rel="stylesheet" href="vistas/css/plugins/responsive.bootstrap.min.css">

  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="vistas/css/plugins/bootstrap-colorpicker.min.css">

 <!-- iCheck -->
 <link rel="stylesheet" href="vistas/css/plugins/iCheck-flat-blue.css">	

 	<!-- Pano -->
  <link rel="stylesheet" href="vistas/css/plugins/jquery.pano.css">

 <!-- bootstrap datepicker -->
 <link rel="stylesheet" href="vistas/css/plugins/bootstrap-datepicker.standalone.min.css">

 <!-- fullCalendar -->
 <link rel="stylesheet" href="vistas/css/plugins/fullcalendar.min.css">

 <!-- Morris chart -->
 <link rel="stylesheet" href="vistas/css/plugins/morris.css">

 <style>
     .fc-today{

       background: #0F15DF !important

     } 
   
 </style>


<!--=====================================
 VÍNCULOS js
======================================--> 
  <!-- jQuery -->
<script src="vistas/js/plugins/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/js/plugins/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/js/plugins/adminlte.min.js"></script>

	<!-- DataTables 
	https://datatables.net/-->
  <script src="vistas/js/plugins/jquery.dataTables.min.js"></script>
  <script src="vistas/js/plugins/dataTables.bootstrap4.min.js"></script> 
	<script src="vistas/js/plugins/dataTables.responsive.min.js"></script>
  <script src="vistas/js/plugins/responsive.bootstrap.min.js"></script>	

  <!-- SWEET ALERT 2 -->	
	<!-- https://sweetalert2.github.io/ -->
	<script src="vistas/js/plugins/sweetalert2.all.js"></script> 

  <!-- CKEDITOR -->
	<!-- https://ckeditor.com/ckeditor-5/#classic -->
	<script src="vistas/js/plugins/ckeditor.js"></script>

  <!-- bootstrap color picker 
	https://farbelous.github.io/bootstrap-colorpicker/v2/-->
  <script src="vistas/js/plugins/bootstrap-colorpicker.min.js"></script>

  <!-- iCheck -->
	<!-- http://icheck.fronteed.com/ -->
	<script src="vistas/js/plugins/icheck.min.js"></script>

  <!-- Pano -->
	<!-- https://www.jqueryscript.net/other/360-Degree-Panoramic-Image-Viewer-with-jQuery-Pano.html -->
	<script src="vistas/js/plugins/jquery.pano.js"></script>

  <!-- bootstrap datepicker -->
	<!-- https://bootstrap-datepicker.readthedocs.io/en/latest/ -->
	<script src="vistas/js/plugins/bootstrap-datepicker.min.js"></script>

	<!-- fullCalendar -->
	<!-- https://momentjs.com/ -->
	<script src="vistas/js/plugins/moment.js"></script>
  <!-- https://fullcalendar.io/docs/background-events-demo -->	
	<script src="vistas/js/plugins/fullcalendar.min.js"></script>

  <!-- Morris.js charts -->
	<!-- https://morrisjs.github.io/morris.js/ -->
	<script src="vistas/js/plugins/raphael-min.js"></script>
	<script src="vistas/js/plugins/morris.min.js"></script>





</head>


<?php if (!isset($_SESSION["validarSesionBackend"])):   /* => si no viene informacion en la variable de session  */   /* siempre entra aqui cuando la sessio no esta iniciada */ /* => esta es pagina de bloqueo */

  include "paginas/login.php";

?>

<?php else: ?>  <!-- pagina de login trae clases diferentes en el body asi evitamos conflictos -->


   <body class="hold-transition sidebar-mini sidebar-collapse">
  
   <div class="wrapper">
    
    <?php
    
      include "paginas/modulos/header.php";
      include "paginas/modulos/menu.php";
       
      /*=============================================
		      Navagación de páginas
		   =============================================*/
       if(isset($_GET["pagina"])){
           
        if($_GET["pagina"] == "inicio" ||
        $_GET["pagina"] == "administradores" ||
        $_GET["pagina"] == "banner" ||
        $_GET["pagina"] == "planes" ||
        $_GET["pagina"] == "categorias" ||
        $_GET["pagina"] == "habitaciones" ||
        $_GET["pagina"] == "reservas" ||
        $_GET["pagina"] == "testimonios" ||
        $_GET["pagina"] == "usuarios" ||
        $_GET["pagina"] == "recorrido" ||
        $_GET["pagina"] == "restaurante" ||
        $_GET["pagina"] == "salir"){

           include "paginas/".$_GET["pagina"].".php";

       }else{
   
         include "paginas/error404.php";
   
       }



       }else{

        include "paginas/inicio.php"; 


       }
      
      include "paginas/modulos/footer.php";


   ?>
 
  <div>

</body>

<script src="vistas/js/administradores.js"></script>
<script src="vistas/js/banner.js"></script>
<script src="vistas/js/planes.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/habitaciones.js"></script>
<script src="vistas/js/reservas.js"></script>
<script src="vistas/js/testimonios.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/recorrido.js"></script>
<script src="vistas/js/restaurante.js"></script> 

<?php endif ?>

</html>


