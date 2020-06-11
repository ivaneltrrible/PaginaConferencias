<?php
error_reporting(0);
include_once 'funciones/sesiones.php';
include_once 'templates/header.php';
include_once 'templates/barra.php';
include_once 'templates/navegacion.php';

?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            LISTA DE INVITADOS
        </h1>
        <ol class="breadcrumb">
            <li><a href="area-admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Invitados</a></li>
            <li class="active">Ver Todos</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Elimina o Edita Invitado</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="registros" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Biografia</th>
                                    <th>Imagen</th>
                                    <th>Acciones</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                /* ## CONEXION PARA REALIZAR CONSULTA DB DE LA TABLA ADMINISTRADORES ### */
                                try {
                                    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

                                    $consulta = "SELECT * FROM invitados";
                                    $sql = $conn->query($consulta);
                                } catch (\Exception $e) {
                                    $error = $e->getMessage();
                                    echo $error;
                                }
                                /* ##CICLO WHILE PARA MOSTRAR TODOS LOS RESULTADOS EN CADA CELDA ## */
                                while ($invitado = $sql->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $invitado['nombre_invitado'] . " " . $invitado['apellido_invitado']; ?></td>
                                        <td><?php echo $invitado['descripcion'] ?></td>
                                        <td><img src="../img/invitados/<?php echo $invitado['url_imagen'] ?>" width="130px"  alt="imagen invitados"></td>
                                        <td>
                                            <a href="editar-invitado.php?id=<?php echo $invitado['invitado_id'] ?>" class="btn bg-orange btn-flat margin"><i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn bg-maroon btn-flat margin borrar_registro" data-id="<?php echo $invitado['invitado_id'] ;?>" data-tipo="invitado"><i class="fa fa-trash"></i>
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