<?php
                           /* esto es index que se ejecuta nada mas abrir la pagina en navigador -  */

require_once "controladores/plantilla.controlador.php";
require_once "controladores/ruta.controlador.php"; 


                                                        /* Controladores de tablas que estamos usando de Frontend  */



require_once "modelos/banner.modelo.php";       
require_once "controladores/banner.controlador.php";  

require_once "modelos/planes.modelo.php";                                                       
require_once "controladores/planes.controlador.php";

require_once "modelos/categorias.modelo.php";  
require_once "controladores/categorias.controlador.php";   

require_once "modelos/recorrido.modelo.php"; 
require_once "controladores/recorrido.controlador.php";  

require_once "modelos/restaurante.modelo.php"; 
require_once "controladores/restaurante.controlador.php"; 
 
require_once "modelos/habitaciones.modelo.php";                                      
require_once "controladores/habitaciones.controlador.php";
 

$plantilla = new ControladorPlantilla();  /* Object class */
$plantilla -> ctrPlantilla();             /* funccion incluya platilla  */
