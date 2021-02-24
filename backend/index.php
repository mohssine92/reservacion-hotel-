<?php    /* => tener en cuenta si no teniamos archivo .htaccess la ruta /backend sera considerada como un porametro reservas-h en su mvc , ahora no lo esta tomando como mvc aparte , despesd e confi .htaccess  */

require_once "controladores/plantilla.controlador.php";
require_once "controladores/ruta.controlador.php";

require_once "controladores/administradores.controlador.php";
require_once "modelos/administradores.modelo.php";

require_once "controladores/banner.controlador.php";
require_once "modelos/banner.modelo.php";



















$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();









/* no cerrar etiqueta de php por seguridad evitando que nos metten codigo malioso  */