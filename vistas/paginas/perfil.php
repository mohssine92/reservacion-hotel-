<?php

/* => aqui donde usamos el concepto de filtracion para usuarios que visitan la aplicacion , en esta pagina no puedan accceder hasta que sean identificados , es decir al identificarse un usuario se crean estos variables de session en seguida  */
  if(isset($_SESSION["validarSesion"])){	  
 
    	if($_SESSION["validarSesion"] == "ok"){   /* por seguridad vovlemos a preguntar , porque puede existir esta variable pero con otro valor  */
   
            /* ahora puedo incluir estos modulos privados */
   	       include "modulos/banner-interior.php";  /* container-fluid img width 100% */
           include "modulos/info-perfil.php";  /*  row col col perfil  */
      
    	} 
 
  }else{
 
     echo '<script> window.location="'.$ruta.'"</script>';
     
 }
 
