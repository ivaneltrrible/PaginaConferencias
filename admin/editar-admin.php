<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
$id_admin = $_GET['id'];
/* Sirve para que no pongas letras en la url de GET */
if (!filter_var($id_admin, FILTER_VALIDATE_INT)) {
    die("Error....Datos invalidos");
}
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';


?>




<!-- Content Wrapper. Contains page  t -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            EDITAR
            <small>Selecciona los campos a modificar</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content col-md-10">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Formulario para Editar Administrador</h3>
            </div>
            <?php
                include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
                $sql = "SELECT * FROM administradores WHERE id_admin = $id_admin";
                $resultado = $conn->query($sql);
                $admin = $resultado->fetch_assoc();
            ?>
            <form role="form" method="post" id="editar-admin" name="editar-admin-form" action="modelo-admin.php">
                <div class="box-body">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" required value="<?php echo $admin['usuario'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre Completo" required value="<?php echo $admin['nombre'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="editar-admin" value="<?php echo $id_admin ?>">
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
        <!-- /.box-primary -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>