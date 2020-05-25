<?php
include_once 'templates/header.php';

/* ### SE DESTRUYE LA SESSION SI SE OPRIME EL BOTON CERRAR SESION DESDE LA BARRA ### */
session_start();
if(isset($_GET['cerrar_sesion'])){
  $cerrar_sesion = $_GET['cerrar_sesion'];
  if ($cerrar_sesion) {
    session_destroy();
  } 
}

?>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="../index.php"><b>GDL</b>Webcamp</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">INGRESO AL SISTEMA</p>

      <form method="post" id="login-admin" name="login-admin-form" action="login-admin.php">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" placeholder="Usuario" name="usuario">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-xs-12">
            <input type="hidden" name="registro" value="logueo">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesion</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.js"></script>
  <!-- jQuery 3 -->
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="js/demo.js"></script>
  <!-- login-admin -->
  <script src="js/login-admin.js"></script>
  <!-- Mi Script -->
  <script src="js/admin-ajax.js"></script>
  <script>
    $(document).ready(function() {
      $('.sidebar-menu').tree()
    })
  </script>
</body>

</html>