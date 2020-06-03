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
            Crear Categoria
            <small>crea una categoria para los eventos</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content col-md-10">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ivan el Terrible Eventos</h3>
            </div>
            <form role="form" method="post" id="crear-categoria" name="crear-categoria" action="modelo-categoria.php">
                <div class="box-body">
                    <div class="form-group">
                        <label for="categoria">Nombre Categoria</label>
                        <input type="text" class="form-control" id="categoria" name="nombre_categoria" placeholder="Escribe la Categoria" required>
                    </div>
                    <div class="form-group">
                        <label for="icono">Nombre Icono</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" name="icono" id="icono" class="form-control pull-right" placeholder="fa-icon">
                        </div>
                    </div>
                   

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="registro" value="crear">
                    <button type="submit" class="btn btn-primary" >Crear Categoria</button>
                </div>
            </form>
        </div>
        <!-- /.box-primary -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>