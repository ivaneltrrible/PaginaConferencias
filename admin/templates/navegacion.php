   <!-- Left side column. contains the sidebar -->
   <aside class="main-sidebar">
     <!-- sidebar: style can be found in sidebar.less -->
     <section class="sidebar">
       <!-- Sidebar user panel -->
       <div class="user-panel">
         <div class="info">
           <p><?php echo $_SESSION['nombre']; ?></p>
           <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
       </div>
       <!-- search form -->
       <form action="#" method="get" class="sidebar-form">
         <div class="input-group">
           <input type="text" name="q" class="form-control" placeholder="Buscar...">
           <span class="input-group-btn">
             <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
             </button>
           </span>
         </div>
       </form>
       <!-- /.search form -->
       <!-- sidebar menu: : style can be found in sidebar.less -->
       <ul class="sidebar-menu" data-widget="tree">
         <li class="header">Menu de Administracion</li>
         <li class="treeview">
           <a href="#">
             <i class="fa fa-dashboard"></i> <span>Dashboard</span>
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu">
             <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard</a></li>
           </ul>
         </li>
         <!-- Creacion de Eventos y ver Todos -->
         <li class="treeview">
           <a href="#">
             <i class="fa fa-calendar" aria-hidden="true"></i>
             <span>Eventos</span>

           </a>
           <ul class="treeview-menu">
             <li><a href="lista-evento.php"><i class="fa fa-list-ul" aria-hidden="true"></i>
                 Ver Todos..</a></li>
             <li><a href="crear-evento.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar evento</a></li>

           </ul>
         </li>
         <!-- Categorias de Eventos -->
         <li class="treeview">
           <a href="#">
             <i class="fa fa-book" aria-hidden="true"></i>
             <span>Categorias Eventos</span>

           </a>
           <ul class="treeview-menu">
             <li><a href="lista-categorias.php"><i class="fa fa-list-ul" aria-hidden="true"></i>
                 Ver Todos..</a></li>
             <li><a href="crear-categoria.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Categoria</a></li>

           </ul>
         </li>
         <!-- Categorias de Registrados a los eventos -->
         <li class="treeview">
           <a href="#">
             <i class="fa fa-address-card" aria-hidden="true"></i>
             <span>Registrados</span>

           </a>
           <ul class="treeview-menu">
             <li><a href="lista-registrados.php"><i class="fa fa-list-ul" aria-hidden="true"></i>
                 Ver Todos..</a></li>
             <li><a href="crear-registrado.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar un registro</a></li>

           </ul>
         </li>
         <!-- Categorias de Invitados a dar eventos -->
         <li class="treeview">
           <a href="#">
             <i class="fa fa-user-circle-o" aria-hidden="true"></i>
             <span>Invitados</span>

           </a>
           <ul class="treeview-menu">
             <li><a href="lista-invitados.php"><i class="fa fa-list-ul" aria-hidden="true"></i>
                 Ver Todos..</a></li>
             <li><a href="crear-invitado.php"><i class="fa fa-user-plus" aria-hidden="true"></i>
                 Agregar Invitado</a></li>

           </ul>
         </li>
         <!-- Categorias de Testimonios agregar comentarios sobre evento -->
         <li class="treeview">
           <a href="#">
             <i class="fa fa-comments" aria-hidden="true"></i>
             <span>Testimoniales</span>


           </a>
           <ul class="treeview-menu">
             <li><a href="../layout/top-nav.html"><i class="fa fa-list-ul" aria-hidden="true"></i>
                 Ver Todos..</a></li>
             <li><a href="../layout/boxed.html"><i class="fa fa-comment-o" aria-hidden="true"></i>
                 Agregar Testimonio</a></li>

           </ul>
         </li>

         <!-- SE CREA CONDCION DE NIVEL PARA QUE SOLO VEA EL ADMIN PRINCIPAL -->
         <?php
          if ($_SESSION['nivel'] == 2) : ?>
           <!-- Categorias para agregar mas administradores al sitio-->
           <li class="treeview">
             <a href="#">
               <i class="fa fa-user" aria-hidden="true"></i>
               <span>Administradores</span>

             </a>
             <ul class="treeview-menu">
               <li><a href="lista-admins.php"><i class="fa fa-list-ul" aria-hidden="true"></i>
                   Ver Todos..</a></li>
               <li><a href="crear-cuenta.php"><i class="fa fa-user-plus" aria-hidden="true"></i>
                   Agregar administrador</a></li>

             </ul>
           </li>
         <?php endif; ?>
     </section>
     <!-- /.sidebar -->
   </aside>

   <!-- =============================================== -->