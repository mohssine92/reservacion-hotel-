<div class="content-wrapper" style="min-height: 1364.81px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Banner</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Banner</li> <!-- se trata de pagima anliticas  -->

            </ol>

          </div>

        </div>
      
      </div><!-- /.container-fluid -->
   
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">

        <div class="row">

          <div class="col-12">

            <!-- Default box -->
            <div class="card card-info card-outline">

              <div class="card-header">

                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearBanner">Crear nuevo banner</button>  

              </div>

              <div class="card-body">
                 
                  <table class="table table-bordered table-striped  dt-responsive tablaBanner" width="100%">
                    
                    <thead>
    
                      <tr>
    
                        <th style="width:10px">#</th> 
                        <th>Banner</th>
                        <th style="width:100px">Acciones</th>          
    
                      </tr>   
    
                    </thead>
    
                    <tbody>
                      
                        <!--Comento lo que esta quemados con html porque lo voy a traer dinamico con ajax desde la tabla de banner en base de datos -->
                     <!--  <tr>     
                  
                        <td>1</td> 
                        <td>
                          <img src="vistas/img/banner/banner01.jpg" class="img-fluid">
                        </td> 
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-warning btn-sm">
                              <i class="fas fa-pencil-alt text-white"></i>
                            </button>  
                            <button class="btn btn-danger btn-sm">
                              <i class="fas fa-trash-alt"></i>
                            </button>  
                          </div>
                        </td>
    
                      </tr>  -->
    
                    </tbody>
    
                  </table>

              </div>
              <!-- /.card-body -->



              

              <!-- /.card-footer-->
            
            </div>
            <!-- /.card -->
          
          </div>
        
        </div>
      
      </div>
    
    </section>
    <!-- /.content -->
  
  </div>

  <!--=====================================
Modal Crear Banner
======================================-->

<div class="modal" id="crearBanner">

    <div class="modal-dialog">
    
      <div class="modal-content">
    
        <form method="post" enctype="multipart/form-data">
    
          <!-- Modal Header -->
           <div class="modal-header bg-info">
             <h4 class="modal-title">Crear Banner</h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
    
          <!-- Modal body -->
          <div class="modal-body">
            
            <div class="form-group my-2">
    
              <input type="file" class="form-control-file border" name="subirBanner" required>
    
              <p class="help-block small">Dimensiones: 1440px * 600px | Peso Max. 2MB | Formato: JPG o PNG</p>
    
              <img class="previsualizarBanner img-fluid"> <!-- vacia no tiene src , la llenemos desde jquery cuando subimos la imagen aqui paresca esta imagen temporalmente  -->
    
            </div>
    
               <?php
         
                 $registroBanner = new ControladorBanner();
                 $registroBanner -> ctrRegistroBanner();
         
               ?>
        
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer d-flex justify-content-between">
    
            <div>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
    
            <div>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
    
          </div>
    
         
    
        </form>
    
      </div>
    
    </div>

</div>

<!--=====================================
Modal Editar Banner
======================================-->

<div class="modal"  data-backdrop="static" id="editarBanner">

     <div class="modal-dialog">
   
       <div class="modal-content">
   
         <form method="post" enctype="multipart/form-data">
   
             <!-- Modal Header -->
             <div class="modal-header bg-info">
               <h4 class="modal-title">Editar Banner</h4>
               <button type="button" class="close cerrar" data-dismiss="modal">&times;</button>
             </div>
   
           <!-- Modal body -->
             <div class="modal-body">
     
               <input type="hidden" class="form-control" name="idBanner"> <!-- para poder capturar id de banner a modificar -->  <!-- agregarle atraves de js el valor de id  -->
     
               <div class="form-group my-2">
     
                 <input type="file" class="form-control-file border" name="editarBanner" required>
     
                 <input type="hidden" name="bannerActual">  <!-- vamos a pasar la ruta del imagen que se encuentra en base de datos es la imagem actual a mofificar -->
     
                 <p class="help-block small">Dimensiones: 1440px * 600px | Peso Max. 2MB | Formato: JPG o PNG</p>
     
                 <img class="previsualizarBanner img-fluid">
     
               </div>
     
             </div>
     
           <!-- Modal footer -->
           <div class="modal-footer d-flex justify-content-between">
   
              <div>
                <button type="button" class="btn btn-danger cerrar" data-dismiss="modal">Cerrar</button>
              </div>
   
              <div>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
   
           </div>
   
            <?php
    
               $editarBanner = new ControladorBanner();
               $editarBanner -> ctrEditarBanner(); 
    
            ?>
   
         </form>
   
       </div>
   
     </div>

</div>