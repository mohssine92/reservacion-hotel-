<div class="content-wrapper" style="min-height: 1364.81px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Administradores</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
              <li class="breadcrumb-item active">Administradores</li> <!-- se trata de pagima anliticas  -->

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
   
                <button class="btn btn-primary btn-sm">Crear nuevo administrador</button>

             <!--    <div class="card-tools"> -->  <!-- Lo hemos quitado sob botones para mostrar y uccultar card-body and card footer -->
                
              </div>

              <div class="card-body">
                 
                 <table class="table table-bordered table-striped dt-responsive tablaAdministradores" width="100%">  <!-- paar poder trabajar con datatable agregar dt-responsive y para javascript agregar tablaAdministradores  -->
                   
                    <thead>
                     
                        <tr>  <!-- fila -->
                          
                          <th style="width:10px">#</th>  <!-- columna -->  <!-- este style reducir le ancho  -->
                          <th>Nombre</th>
                          <th>Usuario</th>
                          <th>Perfil</th>
                          <th>Estado</th>
                          <th>Acciones</th>
      
                        </tr>
   
                   </thead>

                   
                    <tbody>   <!--=> bnody de la tabla  -->
                      
                         <!-- <tr>    
                         
                         <td>1</td>
                         <td>Hotel Portobelo</td>
                         <td>portobelo</td>
                         <td>Administrador</td>
                         <td><button class="btn btn-info btn-sm">Activo</button></td>
                         <td>
      
                           <div class='btn-group'>
                           
                             <button class="btn btn-warning btn-sm">
                               <i class="fas fa-pencil-alt text-white"></i>
                             </button>  
      
                             <button class="btn btn-danger btn-sm">
                               <i class="fas fa-trash-alt"></i>
                             </button> 
      
                           </div> 
      
                         </td>
      
                       </tr>  
       -->
                     </tbody>
 
               </table>

              </div>

              <!-- /.card-body -->
              <div class="card-footer">
              <!--   lO dejo vacio genera una sombrita guay -->
              </div>

              <!-- /.card-footer-->
            
            </div>
            <!-- /.card -->
          
          </div>
        
        </div>
      
      </div>
    
    </section>
    <!-- /.content -->
  
  </div>