<?php
    /* en la ruta habitaciones esto es el contenido de que se va a cargar  */
    /* tener en cuenta que el navbar se carga en todas rutas porque esta inlcuido en el index principal del proyecto  */


include "modulos/banner-interior.php";  /* foto div  */
include "modulos/info-habitaciones.php";  /* 2 segundas columnas de la pagina  */
include "modulos/testimonios.php";   /* parte de tetemonis -> container { -> h1 -> row{col} -> button } */
include "modulos/planes.php";      /* container-fluid { comtainer : { gride => modal  }} */ /* la llamada a todos modales que tenemos estan en un fichero incluido despues de footer para mejor organizacionde codigo  */
include "modulos/planes-movil.php";    /* es un slider paraece solo de menos lg a bajo  */
include "modulos/recorrido-pueblo.php";  /* container-fluid : { container : { slider } } */
include "modulos/restaurante.php";  /* contenido de restaurante es un gride desarollado   */


/* tener en cuenta que el footer y mapa se cargan en el index princiapl del proyecto  */