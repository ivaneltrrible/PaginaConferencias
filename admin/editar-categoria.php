<?php

include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
$id_categoria = $_GET['id'];
/* Sirve para que no pongas letras en la url de GET */
if (!filter_var($id_categoria, FILTER_VALIDATE_INT)) {
    die("Error....Datos invalidos");
}
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';


?>




<!-- Content Wrapper. Contains page  t -->
<div class="content-wrapper altura-minima">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            EDITAR
            <small>Selecciona los campos a modificar</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content col-md-8">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Formulario para Editar Categoria</h3>
            </div>
            <?php
            include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
            $consulta = "SELECT * FROM categoria_evento WHERE id_categoria = $id_categoria";
            $resultado = $conn->query($consulta);
            $categoria = $resultado->fetch_assoc();



            ?>
            <form role="form" method="post" id="editar-categoria" name="editar-categoria-form" action="modelo-categoria.php">
                <div class="box-body">
                    <!-- Nombre del categoria-->
                    <div class="form-group">
                        <label for="nombre_categoria">Nombre categoria</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                                <img src="img/categoria.svg" alt="Imagen de Archivo" height="16px" width="16px">
                            </div>
                            <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" placeholder="Nombre de la categoria" value="<?php echo $categoria['cat_evento']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="icono">Nombre Icono</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-book"></i>
                            </div>
                            <input type="text" name="icono" id="icono" class="form-control pull-right" placeholder="fa-icon" value="<?php echo $categoria['icono']; ?>">
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="id_categoria" value="<?php echo $id_categoria ?>">
                    <button type="submit" class="btn btn-primary" >Editar</button>
                </div>

            </form>
        </div>
        <!-- /.box-primary -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>