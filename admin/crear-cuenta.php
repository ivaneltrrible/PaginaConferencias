<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';

?>




<!-- Content Wrapper. Contains page  t -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crear Usuario Administrador
            <small>crea una cuenta con permisos de administrador</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content col-md-10">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Formulario para crear Administrador</h3>
            </div>
            <form role="form" method="post" id="crear-admin" name="crear-admin" action="modelo-admin.php">
                <div class="box-body">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                    </div>
                    
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="registro" value="crear">
                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                </div>
            </form>
        </div>
        <!-- /.box-primary -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>