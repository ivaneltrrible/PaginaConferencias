<?php
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';

?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            LISTA DE ADMINISTRADORES
        </h1>
        <ol class="breadcrumb">
            <li><a href="area-admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Administradores</a></li>
            <li class="active">Ver Todos</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Elimina o Edita usuarios</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="registros" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                /* ## CONEXION PARA REALIZAR CONSULTA DB DE LA TABLA ADMINISTRADORES ### */
                                try {
                                    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

                                    $consulta = "SELECT id_admin, usuario, nombre FROM administradores";
                                    $sql = $conn->query($consulta);
                                } catch (\Exception $e) {
                                    $error = $e->getMessage();
                                    echo $error;
                                }
                                /* ##CICLO WHILE PARA MOSTRAR TODOS LOS RESULTADOS EN CADA CELDA ## */
                                while ($admin = $sql->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $admin['usuario']; ?></td>
                                        <td><?php echo $admin['nombre'] ?></td>
                                        <td>
                                            <a href="editar-admin.php?id=<?php echo $admin['id_admin'] ?>" class="btn bg-orange btn-flat margin"><i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn bg-maroon btn-flat margin borrar_registro" data-id="<?php echo $admin['id_admin'] ;?>" data-tipo="admin"><i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>