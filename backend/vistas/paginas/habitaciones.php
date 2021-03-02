<div class="content-wrapper" style="min-height: 1364.81px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Habitaciones</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Habitaciones</li> <!-- se trata de pagima anliticas  -->

            </ol>

          </div>

        </div>
      
      </div><!-- /.container-fluid -->
   
    </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
          
          
          <!--=====================================
             Listado de habitaciones  bloque izquierdo
          ======================================-->
          <div class="col-12 col-xl-5">   
             
             <div class="card card-primary card-outline">
               
              <!-- header-card -->
             
              <div class="card-header pl-2 pl-sm-3">
             
                <a href="habitaciones" class="btn btn-primary btn-sm">Crear nueva habitación</a>
             
                <div class="card-tools">
                  
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"> <!-- cpllapsar  -->
                      <i class="fas fa-minus"></i>
                  </button>
             
                </div>      
             
              </div>
             
              <!-- body-card -->
             
              <div class="card-body">
                
                <table class="table table-bordered table-striped dt-responsive tablaHabitaciones" width="100%">  <!-- data table -->
                  
                  <thead>
             
                    <tr>
             
                      <th style="width:10px">#</th> 
                      <th>Categoría</th>
                      <th>Habitación</th>
                      <th style="width:10px">Acciones</th>          
             
                    </tr>   
             
                  </thead>
             
                  <tbody>
                    
                   <!--  <tr>
                      
                      <td>1</td>
                      <td>Suite</td>
                      <td>Oriental</td>
                      <td>
                        <button class="btn btn-secondary btn-sm">
                          <i class="far fa-eye"></i>
                        </button>
                      </td> 
             
                    </tr> -->
             
                  </tbody>
             
                </table>
             
              </div> <!-- ermina card body aqui no tengo footer -->
             
             </div>  <!-- termina card aqui -->
             
          </div>


      <!--=====================================
         Editor de habitaciones  bloque de derecha
      =====================================-->
       
      <?php

           if(isset($_GET["id_h"])){
           
             $habitacion = ControladorHabitaciones::ctrMostrarhabitaciones($_GET["id_h"]);  /* me trae toda informacion de la habitacion segun su id recebido en esta variable get  */
            /*  echo '<pre class="bg-white">'; print_r($habitacion); echo '</pre><br>';  */
           
           }else{
           
             $habitacion = null;
           
           }
      
      
      ?>


      <div class="col-12 col-xl-7">   
           
        <div class="card card-primary card-outline">   <!--card principal  -->
           
                  

            <div class="card-header">    <!-- header-card -->
                     
                <h5  class="card-title"><?php echo $habitacion["tipo"] ?> / <?php echo $habitacion["estilo"] ?></h5>
                     
                <div class="preload"></div>
                     
                <div class="card-tools">
                     
                  <button type="button" class="btn btn-info btn-sm guardarHabitacion">
                         
                      <i class="fas fa-save"></i>
                       
                  </button>

                  <?php 

                       if($habitacion != null){ /* => segnifica hay habitacion que se esta editando  */
                       
                         $galeria = json_decode($habitacion["galeria"], true);
                       
                         echo '<button type="button" class="btn btn-danger btn-sm eliminarHabitacion" idEliminar="'.$habitacion["id_h"].'" galeriaHabitacion="'.implode(",", $galeria).'" recorridoHabitacion="'.$habitacion["recorrido_virtual"].'">
                       
                               <i class="fas fa-trash"></i> 
                       
                             </button>';
                       
                       }
                  
                  ?>
                     
                    <?php 
                  
                   /*    if($habitacion != null){
                  
                        $galeria = json_decode($habitacion["galeria"], true);
                  
                        echo '<button type="button" class="btn btn-danger btn-sm eliminarHabitacion" idEliminar="'.$habitacion["id_h"].'" galeriaHabitacion="'.implode(",", $galeria).'" recorridoHabitacion="'.$habitacion["recorrido_virtual"].'">
                      
                              <i class="fas fa-trash"></i> 
                  
                            </button>';
                  
                      } 
                   */
                    ?>
                </div>
                     
            </div>   <!-- header-card -->

          

          <!-- card-body-->

          <div class="card-body"> 
               
                <input type="hidden" class="idHabitacion" value="<?php echo $habitacion["id_h"]?>">  <!-- capturar el id de la habitacion que vamos a iditar  -->

                <!-- Categoría y nombre de la habitación -->
                <div class="d-flex flex-column flex-md-row justify-content-start mb-3">
    
    
                  <div class="form-inline mx-3 px-3 border border-left-0 border-top-0 border-bottom-0">   <!-- Formulario en linea  -->
      
                    <p class="mr-sm-2">Elije la Categoría:</p>  
      
                      <?php 

                            if($habitacion != null){
                            
                                  echo '<select class="form-control seleccionarTipo" readonly>
                                   
                                   <option value="'.$habitacion["id_cat"].','.$habitacion["tipo"].'">'.$habitacion["tipo"].'</option>
                               
                                  </select>';
                            
                            }else{
                            
                                   echo '<select class="form-control seleccionarTipo">
                                
                                     <option value="">Seleccione</option>';
                                
                                     $categorias = ControladorCategorias::ctrMostrarCategorias(null, null);  /* traer toda categorias existentes  */
                                
                                     foreach ($categorias as $key => $value) {
                                    
                                         echo '<option value="'.$value["id_cat"].','.$value["tipo"].'">'.$value["tipo"].'</option>';
                                    
                                     }
                                
                                   echo '</select>';    
                            
                            }
                        
                      ?>
      
      
                  </div>   <!-- Formulario en linea  -->
      
                  <div class="form-inline">   <!-- Formulario en linea  -->
                       
                       <p class="mr-sm-2">Escribe el nombre de la habitación:</p>
                          <?php 

                            if($habitacion != null){
                            
                              echo '<input type="text" class="form-control seleccionarEstilo" value="'.$habitacion["estilo"].'" readonly>';
                            
                            }else{
                            
                              echo '<input type="text" class="form-control seleccionarEstilo">';
                            
                            }
                            
                          ?> 
      
                  </div>    <!-- Formulario en linea  --> 
                </div>   <!-- Categoría y nombre de la habitación dos forms en linea  -->

      
                 <!-- Galería -->
                 <div class="card rounded-lg card-secondary card-outline">   <!-- primer card añidado -->
       
                   <div class="card-header pl-2 pl-sm-3">
            
                      <h5>Galería:</h5>
                      
                   </div>

                  <div class="card-body">  
                         <ul class="row p-0 vistaGaleria">   <!-- => aqui tambien se aplica un append a lso archivos arrastrados al momento de subir imagenes  -->
               
                              
                            <?php 
                                   
                                   if($habitacion != null){
                                   
                                     $galeria = json_decode($habitacion["galeria"], true);  /* json_decode Convierte un string codificado en JSON a una variable de PHP. */
                                   
                                     foreach ($galeria as $key => $value) {
                                   
                                       echo '<li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">
                                     
                                               <img class="card-img-top" src="'.$value.'">
                                   
                                               <div class="card-img-overlay p-0 pr-3">
                                                 
                                                  <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoAntigua" temporal="'.$value.'">
                                                    
                                                    <i class="fas fa-times"></i>
                                   
                                                  </button>
                                   
                                               </div>
                                   
                                             </li>';
                                   
                                     }
                                   
                                   }
                                   
                            ?>
                             
                              
                         </ul>
                  </div> <!-- card body termina de galeria -->


                  <input type="hidden" class="InputNuevaGaleria" > <!-- ojo lo que estoy recibiendo es array de imagenes en formato 64 => imagenes temporales  en string de json  -->

                  <input type="hidden" class="inputAntiguaGaleria" value="<?php echo implode(",", $galeria); ?>">   <!-- implode — Une elementos de un array en un string , separado elentos por el caracter indicado --> 
                  



                  <!-- card-footer  -->
                  <div class="card-footer">    <!-- para seleccionar o arrastrar fotos -->
      
                     <input type="file" multiple id="galeria" class="d-none"> 
                     
                     <label for="galeria" class="text-dark text-center py-5 border rounded bg-white w-100 subirGaleria"> 
                     
                     Haz clic aquí o arrastra las imágenes <br> 
                                <span class="help-block small">Dimensiones: 940px * 480px | Peso Max. 2MB | Formato: JPG o PNG</span>
      
                  </div>   <!-- card-footer  -->

               </div><!-- Galería -->    <!-- termina aqui el primer card añidado -->


              <!-- Video  y 360  -->
         
              <div class="row">  
           
                <div class="col-12 col-xl-6">  <!-- visor de video  -->
                 
                  <div class="card rounded-lg card-secondary card-outline">     <!-- segundo card anidado -->
                        
                      <div class="card-header pl-2 pl-sm-3">
        
                         <h5>Video:</h5>
                      
                      </div>
        
                      <div class="card-body vistaVideo">
        
                        <?php if ($habitacion != null): ?>

                        <iframe width="100%" height="320" src="https://www.youtube.com/embed/<?php echo $habitacion["video"]; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        
                        <?php endif ?>

                        

                      </div>
        
                      <div class="card-footer">
                         
                          <div class="input-group"> 
                            
                             <div class="input-group-prepend">
                                 <span class="p-2 bg-secondary rounded-left small">youtube.com/embed/</span> 
                             </div>
            
                             
                             <?php if ($habitacion != null): ?>
                        
                             <input type="text" class="form-control agregarVideo" placeholder="Agregue el código del vídeo" value="<?php echo $habitacion["video"]; ?>">

                             <?php else: ?>

                             <input type="text" class="form-control agregarVideo" placeholder="Agregue el código del vídeo">

                             <?php endif ?>
            
                          </div>
        
                      </div>
        
                  </div>  <!-- termina ese card -->   <!-- aqui termina segundo card anidado -->

                </div>  <!-- visor de video  -->
    
                <div class="col-12 col-xl-6">  <!-- visor de imagen 360 grados -->
                     
                  <div class="card rounded-lg card-secondary card-outline">    <!-- empieza nuevo card -->  <!-- tercer card anidado -->
                          
                    <div class="card-header pl-2 pl-sm-3">
        
                       <h5>Recorrido virtual:</h5>
                    
                    </div>
          
                    <div class="card-body ver360">
        
                        <?php if ($habitacion != null): ?>
                      
                          <div class="pano 360Antiguo" back="<?php echo $habitacion["recorrido_virtual"]; ?>">
    
                            <div class="controls">
                              <a href="#" class="left">&laquo;</a>
                              <a href="#" class="right">&raquo;</a>
                            </div>
    
                          </div>

                        <?php endif ?>

        
                    </div>
          
                    <div class="card-footer">
                     
                       <input type="hidden" class="antiguoRecorrido" value="<?php echo $habitacion["recorrido_virtual"]; ?>"> <!-- cuando quiero editar capto la antigua routa en caso no voy a cambiar -->

                       <div class="custom-file">
                         <input type="file" class="custom-file-input" id="imagen360">
                         <label class="custom-file-label" for="imagen360">Agregar imagen 360°</label>
                       </div>
                   
                    </div>
                      
                  </div>   <!-- aqui termina ese card --> <!-- pues aqui termina tercer card añidado -->
                  
                </div><!-- visor de imagen 360 grados -->
           
             </div>   <!-- Video  y 360 -->  <!-- row termina el row -->
      

            <!-- descripcion -->

            <div class="card rounded-lg card-secondary card-outline">  <!-- cuarto card anidado en body-card occupa 100% como el primer card anidado -->
               
              <div class="card-header pl-2 pl-sm-3">

                 <h5>Descripción:</h5>
              
              </div>

              <div class="card-body">
                
                      <!--Plugin ckEditor -->  
                  <textarea id="descripcionHabitacion" style="width: 100%">  
 
                     <?php 

                        if($habitacion != null){
                        
                          echo $habitacion["descripcion_h"];
                        
                        } 
                     
                     ?>
                    
                  </textarea>

              </div>


            </div>

          </div>  <!-- fin card-body -->

          <!-- footer-card -->

          <div class="card-footer">  <!-- footer principal  -->

            <div class="preload"></div>

            <div class="card-tools float-right">
            
               <button type="button" class="btn btn-info btn-sm guardarHabitacion">
                 
                  <i class="fas fa-save"></i>
               
               </button>

               <?php 

                    if($habitacion != null){ /* => segnifica hay habitacion que se esta editando  */
                    
                      $galeria = json_decode($habitacion["galeria"], true);
                    
                      echo '<button type="button" class="btn btn-danger btn-sm eliminarHabitacion" idEliminar="'.$habitacion["id_h"].'" galeriaHabitacion="'.implode(",", $galeria).'" recorridoHabitacion="'.$habitacion["recorrido_virtual"].'">
                    
                            <i class="fas fa-trash"></i> 
                    
                          </button>';
                    
                    }
              
              ?>

            </div>
         
          </div>
  
        </div> <!-- fin card principal -->
   
          </div> <!-- col cloque derecha -->
         
          </div>   <!-- row termina aqui  -->
       </div> <!-- container fluid termina aqui  -->
   </section> <!-- /.content termina aqui -->
  
  </div>  <!-- container termina aqui -->