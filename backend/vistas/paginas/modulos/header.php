<?php 

$notificaciones = ControladorInicio::ctrMostrarNotificaciones();
/*  echo '<pre class="bg-white">'; print_r($notificaciones); echo '</pre><br>';  */

$totalNotificaciones = 0;
$totalReservas = 0;
$totalTestimonios = 0;

foreach ($notificaciones as $key => $value) {

   $totalNotificaciones += $value["cantidad"]; /* ivrementarle */

    if($value["tipo"] == "reservas"){
      
      $totalReservas = $value["cantidad"];

    }else{

      $totalTestimonios = $value["cantidad"];
    
    }
}

?>



<nav class="main-header navbar navbar-expand navbar-white navbar-light">   
  

  <!--=====================================
  Botón que colapsa el menú lateral
  ======================================--> 
  <ul class="navbar-nav"> 

    <li class="nav-item">
    
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
 
    </li>
     
    <li class="nav-item d-none d-sm-inline-block">
     
       <a class="nav-link">Hola <?php echo $admin['usuario']; ?></a>
     
    </li>
   
  </ul>

  <!--=====================================
  Notifiaciones
  ======================================--> 
 <ul class="navbar-nav ml-auto">

  <li class="nav-item dropdown">
     
    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
    
     <i class="far fa-bell"></i> <!-- icono notificaciones -->
    
     <?php if ($totalNotificaciones != 0): ?>
  
     <span class="badge badge-danger navbar-badge"><?php echo $totalNotificaciones; ?> </span>  <!-- notificaciones sin visualizar  -->
    
     <?php endif ?>

    </a>
  
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">  
      
     <span class="dropdown-item dropdown-header"> <?php echo $totalNotificaciones; ?> Notificaciones</span>  
 
     <div class="dropdown-divider"></div>  <!-- es una clase que me permite separar -->
 
     <a href="index.php?pagina=reservas&not=0" class="dropdown-item">
     
      <i class="far fa-calendar-alt mr-2 float-right"></i>   
      
      <span class="badge badge-info "> <?php echo $totalReservas; ?> Reservas nuevas</span> 
     
     </a>
    
    <div class="dropdown-divider"></div>  <!-- linea separacion en drop down  -->
    
      <a href="index.php?pagina=testimonios&not=0" class="dropdown-item">
      
       <i class="fas fa-user-check mr-2 float-right"></i> <!-- icono flotado a la derecha -->
       
       <span class="badge badge-info "><?php echo $totalTestimonios; ?> Testimonios nuevos</span>
      
      </a>
    
    </div>
  
  </li>
   <!--=====================================
    Botón salir del sistema
    ======================================--> 

    <li class="nav-item">

      <a class="nav-link" href="salir">

        <i class="fas fa-sign-out-alt"></i>  <!-- icono de salir  -->

      </a>   

    </li>
 

    
 </ul>

</nav>