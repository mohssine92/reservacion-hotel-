<?php
         /* esto es index que se ejecuta nada mas abrir la pagina en navigador - es decir pagina de aplicacion - contenido se cambia en funccion de la condicion que mandamos al url atrves de php */

require_once "controladores/plantilla.controlador.php"; /* navbar hecho - contenido de pagina en funccion de condicion php a cumplir - en espera getear la variable del url para rederigir al contenido debido */ /* footer hecho : formcontacto+mapa */
require_once "controladores/ruta.controlador.php"; /* dos variables una contiene la routa raiz del proyecto a nivel frontend de uso mover entre paginas - segunda routa raiz a nivel backend de uso en el servidor  */


                                                        /* Controladores de tablas que estamos usando de Frontend  */
                                                   
require_once "controladores/banner.controlador.php";  /* el controladoe del modelo de la tbla banner - contiene img para el banner */
require_once "controladores/planes.controlador.php";  /* controlador de planes sera solicitado desde las vistas  */


require_once "controladores/categorias.controlador.php";   /* en caso sea llamado , el controlador que controla obtener datos es decir la collecion de objetos de categoria */
require_once "modelos/categorias.modelo.php";   /*el modelo el que se encarga de devolver datos la colleccion de objetos de la tabla categoria se lo manda al controlador  */

require_once "controladores/recorrido.controlador.php";  /* controlador de la tabla recorrido  */
require_once "modelos/recorrido.modelo.php";  /* modelo el que se encarga de sacar los objetos de la tabla recorrido y mandarlos al controlador recorrido paraque lo maneja  */

require_once "controladores/restaurante.controlador.php"; /* controlador de la tabla restaurante  */
require_once "modelos/restaurante.modelo.php";  /* modelo de la tabla restaurante - encarga de sacar la colleccion de objetos tipo restaurante y lo manda al controlador el que se encarga de controlar acciones hacia esta tabla  */


$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();   /* esta funccion de este objeto me incluya la plantilla completa del proyecto - todos modulos que haran falta esta incluidos arriba  */
