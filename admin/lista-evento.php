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
            LISTA DE EVENTOS
        </h1>
        <ol class="breadcrumb">
            <li><a href="area-admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Eventos</a></li>
            <li class="active">Ver Todos</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Elimina o Edita eventos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="registros" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha Evento</th>
                                    <th>Hora del Evento</th>
                                    <th>Categoria</th>
                                    <th>Invitado</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /* ## CONEXION PARA REALIZAR CONSULTA DB DE LA TABLA ADMINISTRADORES ### */
                                try {
                                    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

                                    $consulta = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado ";
                                    $consulta .= " FROM eventos ";

                                    $consulta .= " INNER JOIN categoria_evento ";
                                    $consulta .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";

                                    $consulta .= " INNER JOIN invitados ";
                                    $consulta .= " ON eventos.id_invitado_key = invitados.invitado_id ";

                                    $consulta .= " ORDER BY evento_id ";
                                    $sql = $conn->query($consulta);
                                } catch (\Exception $e) {
                                    $error = $e->getMessage();
                                    echo $error;
                                }
                                /* ##CICLO WHILE PARA MOSTRAR TODOS LOS RESULTADOS EN CADA CELDA ## */
                                while ($eventos = $sql->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $eventos['nombre_evento']; ?></td>
                                        <td><?php echo $eventos['fecha_evento'] ;?></td>
                                        <td><?php echo $eventos['hora_evento']; ?></td>
                                        <td><?php echo $eventos['cat_evento'] ;?></td>
                                        <td><?php echo $eventos['nombre_invitado'] . " " . $eventos['nombre_invitado']  ;?></td>
                                        <td>
                                            <a href="editar-evento.php?id=<?php echo $eventos['evento_id'] ?>" class="btn bg-orange btn-flat margin"><i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn bg-maroon btn-flat margin borrar_registro" data-id="<?php echo $eventos['evento_id']; ?>" data-tipo="eventos"><i class="fa fa-trash"></i>
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