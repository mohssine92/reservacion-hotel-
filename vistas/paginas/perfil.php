<?php

/* => aqui donde usamos el concepto de filtracion para usuarios que visitan la aplicacion , en esta pagina no puedan accceder hasta que sean identificados , es decir al identificarse un usuario se crean estos variables de session en seguida  */
  if(isset($_SESSION["validarSesion"])){	  
 
    	if($_SESSION["validarSesion"] == "ok"){   /* por seguridad vovlemos a preguntar , porque puede existir esta variable pero con otro valor  */
   
          

           include "modulos/banner-interior.php";
           include "modulos/info-perfil.php";
         

            /*   $user = $_SESSION["id"] ;
 */
 
              /* cho $user; */  /* la idea es consultar tablña reserva si trare mayor que zero mostramos los sigientes modulso  */




        /*    if(){ */
              
                /*  include "modulos/habitaciones.php";
                   include "modulos/planes.php";
                   include "modulos/planes-movil.php";
                   include "modulos/recorrido-pueblo.php";
                   include "modulos/restaurante.php";  */




         /*   } */
        
           echo '<div class="mb-5"></div>';
       
      
    	} 
 
  }else{
 
     echo '<script> window.location="'.$ruta.'"</script>';
     
 }
 
