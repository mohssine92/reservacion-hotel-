<?php
  /* esto es contenido de pagina de inicio  */

include "modulos/banner.php";  
                                                    /* esos modulos estan dinamicos gracias a base de datos y foreach por recorrer las collecciones de objetos de datos recuperados desde tablas de base de datos */

include "modulos/planes.php";           /* usa tabla planes  */

include "modulos/habitaciones.php";     /* usa tabla categorias   */

include "modulos/planes-movil.php";  /* usa tabla categorias  */

include "modulos/recorrido-pueblo.php";   /* usa tabla recorrido  */ 

include "modulos/restaurante.php";   /* usa tabla restaurante  */



  /* NB : los modulos es donde almaceno codigo en formato container-fluid de varios componentes recien desarollados asi puedo incorporarlo en al platilla segun necesidad y con el orden que yo quiera por supuesto estos componentes
          requieren plugin hojas estilos y script de js  y jquery , y hay algunos de ellos usan concepto modal para los model tengo un fichero esta incluido abajo del footer , alli incorporo las resupuestas de los modales
          esta arquitectura que estamos usando nos permite multiuso del componente que queramos en cualquier pagina tendremos nada mas incoporarlo en el fichero el que sera llamado por systema de rootas para cargarse   */