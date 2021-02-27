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
                
                <table class="table table-bordered table-striped dt-responsive tablaHabitaciones" width="100%">
                  
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
      <div class="col-12 col-xl-7">   
           
        <div class="card card-primary card-outline">   <!--card principal  -->
           
                  

            <div class="card-header">    <!-- header-card -->
                     
                <h5  class="card-title"> <!-- <?php echo $habitacion["tipo"] ?> / <?php echo $habitacion["estilo"] ?> --> Suite/ Oriental</h5>
                     
                <div class="preload"></div>
                     
                <div class="card-tools">
                     
                  <button type="button" class="btn btn-info btn-sm guardarHabitacion">
                         
                      <i class="fas fa-save"></i>
                       
                  </button>
                     
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

                <!-- Categoría y nombre de la habitación -->
                <div class="d-flex flex-column flex-md-row justify-content-start mb-3">
    
    
                  <div class="form-inline mx-3 px-3 border border-left-0 border-top-0 border-bottom-0">   <!-- Formulario en linea  -->
      
                    <p class="mr-sm-2">Elije la Categoría:</p>  
      
                    <select class="form-control seleccionarTipo" readonly>
                   
                       <option value=""></option>
        
                    </select>
      
      
                  </div>   <!-- Formulario en linea  -->
      
                  <div class="form-inline">   <!-- Formulario en linea  -->
                       
                       <p class="mr-sm-2">Escribe el nombre de la habitación:</p>
                       <input type="text" class="form-control seleccionarEstilo"  placeholder="escriba nombre habitacion" >
      
                  </div>    <!-- Formulario en linea  --> 
                </div>   <!-- Categoría y nombre de la habitación dos forms en linea  -->

      
                 <!-- Galería -->
                 <div class="card rounded-lg card-secondary card-outline">   <!-- primer card añidado -->
       
                   <div class="card-header pl-2 pl-sm-3">
            
                      <h5>Galería:</h5>
                      
                   </div>

                  <div class="card-body">  
                         <ul class="row p-0 vistaGaleria">
               
                               <li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">
                               
                                <img src="vistas/img/suite/oriental01.jpg">
                               
                                 <div class="card-img-overlay p-0 pr-3">
                     
                                    <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoAntigua" temporal="'.$value.'">
                                       <i class="fas fa-times"></i>
                                    </button>
                     
                                 </div>
                               
                               
                               </li>   
                               <li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">
                               
                                <img src="vistas/img/suite/moderna01.jpg">
                               
                                 <div class="card-img-overlay p-0 pr-3">
                     
                                    <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoAntigua" temporal="'.$value.'">
                                       <i class="fas fa-times"></i>
                                    </button>
                     
                                 </div>
                               
                               
                               </li>
                               <li class="col-12 col-md-6 col-lg-3 card px-3 rounded-0 shadow-none">
                             
                               <img src="vistas/img/suite/africana01.jpg">
                             
                                <div class="card-img-overlay p-0 pr-3">
                   
                                   <button class="btn btn-danger btn-sm float-right shadow-sm quitarFotoAntigua" temporal="'.$value.'">
                                      <i class="fas fa-times"></i>
                                   </button>
                   
                                </div>
                             
                             
                               </li>    
                         </ul>
                  </div> <!-- card body termina de galeria -->

                  <!-- card-footer  -->
                  <div class="card-footer">
      
                     <input type="file" multiple id="galeria" class="d-none"> <!-- lo voy a esconder paraque atraves label podra usar una area le das click y se tariga imagenes que vaya poner for=galeria paraque se active cuando vaya utulizar input tipo file 
                                                                                que tiene id galeria aunque esta escondido es el que va ayudar traer fotos al servidor  -->
                     
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
        
                        <iframe width="100%" height="320" src="https://www.youtube.com/embed/JTu790_yyRc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                             <!--  se usan poara visualizar videos de youtube esto atributos  -->
                      </div>
        
                      <div class="card-footer">
                         
                          <div class="input-group"> 
                             <div class="input-group-prepend">
                                 <span class="p-2 bg-secondary rounded-left small">youtube.com/embed/</span> 
                             </div>
            
                             <input type="text" class="form-control agregarVideo" placeholder="Agregue el código del vídeo" value="">  <!-- aca debe agregar el codigo de youtube para subir el video  -->
            
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
        
                       <div class="pano 360Antiguo" back="vistas/img/suite/africana-360.jpg"> <!-- pano panoramica  --> <!-- para poder aplicar el plugin de panoramic -->
                               <div class="controls">  <!-- controles de vista panoramica -->
                                     <a href="#" class="left">&laquo;</a>
                                     <a href="#" class="right">&raquo;</a>
                               </div>
                       </div>
        
                    </div>
          
                    <div class="card-footer">
                     <!--   <input type="hidden" class="custom-file-input" id="imagen"> -->
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

            </div>
         
          </div>
  
        </div> <!-- fin card principal -->
   
          </div> <!-- col cloque derecha -->
         
          </div>   <!-- row termina aqui  -->
       </div> <!-- container fluid termina aqui  -->
   </section> <!-- /.content termina aqui -->
  
  </div>  <!-- container termina aqui -->