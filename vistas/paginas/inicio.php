<?php
  /* esto es contenido de pagina de inicio  */

include "modulos/banner.php";  /* este modulo de banner es dinamico mueve imagenes traidas  de una base de datos   */
                                /* mas adelante cuando estemos trabajando gestor de banel en el panel administrativo en el backend podemos subir y cambiar imagenes cuantas veces queramos  */
                                /* las imagenes del banner vienes de repositorio del backend -  */

include "modulos/planes.php";   /*  anuncios infs planes que podra hacer   */ /* hay un modalplanes su codigo esta paginas/modulos/modal  */

include "modulos/habitaciones.php";     /* la parte de habitaciones tipo de habitaciones  */

include "modulos/planes-movil.php";  /* ???? */

include "modulos/recorrido-pueblo.php";    /* recorrido del pueblo es slider   */

include "modulos/restaurante.php";   /* parte de carta restaurantes etc , formulario de contacto y mapa esta incluyendo en el footer estan in index principal del proyecto  */




  /* NB : los modulos es donde almaceno codigo en formato container-fluid de varios componentes recien desarollados asi puedo incorporarlo en al platilla segun necesidad y con el orden que yo quiera por supuesto estos componentes
          requieren plugin hojas estilos y script de js  y jquery , y hay algunos de ellos usan concepto modal para los model tengo un fichero esta incluido abajo del footer , alli incorporo las resupuestas de los modales
          esta arquitectura que estamos usando nos permite multiuso del componente que queramos en cualquier pagina tendremos nada mas incoporarlo en el fichero el que sera llamado por systema de rootas para cargarse   */