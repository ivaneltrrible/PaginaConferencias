<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="../index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>G</b>WC</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>GDL</b>WebCamp</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="img/usuarioTriste.png" class="user-image" alt="User Image">
                <span class="hidden-xs">Bienvenido: <?php echo $_SESSION['nombre']; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="img/usuarioTriste.png" class="img-circle" alt="User Image">

                  <p>
                  <?php echo $_SESSION['usuario']; ?> - Web Developer
                    <small>Admin</small>
                  </p>
                </li>
                
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="text-center">
                    <a href="login.php?cerrar_sesion=true" class="btn btn-success btn-flat">Cerrar Sesion</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a title="Edita tu informacion de usuario" href="editar-admin.php?id=<?php echo $_SESSION['id']; ?>"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

    <!-- =============================================== -->
