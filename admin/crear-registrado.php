<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';

?>




<!-- Content Wrapper. Contains page  t -->
<div class="content-wrapper altura-minima">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crear Invitado
            <small>crea un Invitado para los eventos</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content col-md-10">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ivan el Terrible Eventos</h3>
            </div>
            <form role="form" method="post" id="crear-invitado-archivo" name="crear-invitado" action="modelo-invitado.php" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label for="invitado">Nombre Invitado</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <img src="img/names.svg" height="16px" width="16px" alt="imagen de nombre">
                            </div>
                            <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Escribe el nombre" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="icono">Apellido</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <img src="img/names.svg" height="16px" width="16px" alt="imagen de apellido">
                            </div>
                            <input type="text" name="apellido_invitado" id="apellido_invitado" class="form-control pull-right" placeholder="Escribe el apellido">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="biografia_invitado">Biografia</label>

                        <textarea name="biografia_invitado" id="biografia_invitado" rows="5" class="form-control"></textarea>

                    </div>

                    <div class="form-group">
                        <label for="imagen_invitado">Imagen del invitado</label>
                        <div class="input-group">

                            <div class="input-group-addon">
                                <img src="img/subirFile.svg" height="16px" width="16px" alt="imagen de apellido">
                            </div>

                            <input type="file" id="imagen_invitado" class="form-control" name="imagen_invitado">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="registro" value="crear">
                    <button type="submit" class="btn btn-primary">Crear invitado</button>
                </div>
            </form>
        </div>
        <!-- /.box-primary -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>