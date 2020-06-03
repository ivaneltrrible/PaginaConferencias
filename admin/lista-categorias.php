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
            LISTA DE CATEGORIAS
        </h1>
        <ol class="breadcrumb">
            <li><a href="area-admin.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Categoria Eventos</a></li>
            <li class="active">Ver Todos</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Elimina o Edita Categoria</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="registros" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Icono</th>
                                    <th>Acciones</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                /* ## CONEXION PARA REALIZAR CONSULTA DB DE LA TABLA ADMINISTRADORES ### */
                                try {
                                    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

                                    $consulta = "SELECT * FROM categoria_evento";
                                    $sql = $conn->query($consulta);
                                } catch (\Exception $e) {
                                    $error = $e->getMessage();
                                    echo $error;
                                }
                                /* ##CICLO WHILE PARA MOSTRAR TODOS LOS RESULTADOS EN CADA CELDA ## */
                                while ($categoria = $sql->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $categoria['cat_evento']; ?></td>
                                        <td><i class="icono-grande fa <?php echo $categoria['icono'] ?>"></i><?php echo $categoria['icono'] ?></td>
                                        <td>
                                            <a href="editar-categoria.php?id=<?php echo $categoria['id_categoria'] ?>" class="btn bg-orange btn-flat margin"><i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn bg-maroon btn-flat margin borrar_registro" data-id="<?php echo $categoria['id_categoria'] ;?>" data-tipo="categoria"><i class="fa fa-trash"></i>
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