<!-- => creamos un filtro acceso solo permitido a los administradores  -->
<?php 

  if($admin["perfil"] != "Administrador"){

    echo '<script>

      window.location = "banner";

    </script>';

    return;

  }

 ?>


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

              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#crearAdministrador" >Crear nuevo administrador</button>

              <!--    <div class="card-tools"> -->
              <!-- Lo hemos quitado sob botones para mostrar y uccultar card-body and card footer -->

            </div>

            <div class="card-body">

              <table class="table table-bordered table-striped dt-responsive tablaAdministradores" width="100%">
                <!-- paar poder trabajar con datatable agregar dt-responsive y para javascript agregar tablaAdministradores  -->

                <thead>

                  <tr>
                    <!-- fila -->

                    <th style="width:10px">#</th> <!-- columna -->
                    <!-- este style reducir le ancho  -->
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Perfil</th>
                    <th>Estado</th>
                    <th>Acciones</th>

                  </tr>

                </thead>


                <tbody>
                  <!--=> bnody de la tabla  -->

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

<!--=====================================
Modal Crear Administrador
======================================-->

<div class="modal" id="crearAdministrador">

  <div class="modal-dialog">

    <div class="modal-content">

      <form method="post">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Crear Administrador</h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

          <!-- input nombre -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-user"></span>

            </div>

            <input type="text" class="form-control" name="registroNombre" placeholder="Ingresa el nombre" required>

          </div>

          <!-- input usuario -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-user-lock"></span>

            </div>

            <input type="text" class="form-control" name="registroUsuario" placeholder="Ingresa el usuario" required>

          </div>

          <!-- input password -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-lock"></span>

            </div>

            <input type="password" class="form-control" name="registroPassword" placeholder="Ingresa la contraseña" required>

          </div>

          <!-- seleccionar el perfil -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">

              <span class="fas fa-key"></span>

            </div>

            <select class="form-control" name="registroPerfil" required>

              <option value="">Seleccione perfil</option>

              <option value="Administrador">Administrador</option>

              <option value="Editor">Editor</option>

            </select>

          </div>

          <?php 

           $registroAdministrador = new ControladorAdministradores();
           $registroAdministrador -> ctrRegistroAdministrador(); 

         ?>

        </div>

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
Modal Editar Administrador
======================================-->

<div class="modal" id="editarAdministrador">

  <div class="modal-dialog">
    
    <div class="modal-content">

      <form method="post">
      
        <div class="modal-header bg-info">
          
          <h4 class="modal-title">Editar Administrador</h4>

           <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        <div class="modal-body">

          <input type="hidden" name="editarId">   <!-- paraque el sisteam detecta que id va editar  -->

          <!-- input nombre -->
          
          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-user"></span>

            </div>

            <input type="text" class="form-control" name="editarNombre" value required>   

          </div>

          <!-- input usuario -->

          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-user-lock"></span>

            </div>

            <input type="text" class="form-control" name="editarUsuario" value required>   

          </div>

          <!-- input password -->

          <div class="input-group mb-3">
             
            <div class="input-group-append input-group-text">
              
               <span class="fas fa-lock"></span>

            </div>

            <input type="password" class="form-control" name="editarPassword" placeholder="Cambie la contraseña"> <!-- la quitamos required porque podra mantener contraseña actual , no hay obligacion de de actualizar contraseña -->
           
            <input type="hidden" name="passwordActual"> <!-- aqui captamos contraseña actual para vovler a ingresarla de neuvamente al update  -->

          </div>

           <!-- seleccionar el perfil -->

          <div class="input-group mb-3">

            <div class="input-group-append input-group-text">
              
              <span class="fas fa-key"></span>
            
            </div>

            <select class="form-control" name="editarPerfil" required>

              <option class="editarPerfilOption"></option>  <!-- html se agrega tambien por jquery -->

              <option value="">Seleccione perfil</option>

              <option value="Administrador">Administrador</option>

              <option value="Editor">Editor</option>

            </select>     

          </div>

            <?php 

             $editarAdministrador = new ControladorAdministradores();
             $editarAdministrador -> ctrEditarAdministrador();    /* recibe cariables post del formulario editar usuario */

           ?>
 
        </div>

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

