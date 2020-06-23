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
                    <div class="box-body table-responsive text-nowrap">
                        <table id="registros" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Fecha Registro</th>
                                    <th>Pases Articulos</th>
                                    <th>Talleres</th>
                                    <th>Regalo</th>
                                    <th>Total</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /* ## CONEXION PARA REALIZAR CONSULTA DB DE LA TABLA Registrados ### */
                                try {
                                    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

                                    $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados ";
                                    $sql .= " JOIN regalos ";
                                    $sql .= " ON registrados.regalo = regalos.ID_regalo ";
                                    $resultado = $conn->query($sql);
                                } catch (\Exception $e) {
                                    $error = $e->getMessage();
                                    echo $error;
                                }
                                /* ##CICLO WHILE PARA MOSTRAR TODOS LOS RESULTADOS EN CADA CELDA ## */
                                while ($registrado = $resultado->fetch_assoc()) { ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $registrado['nombre_registrado'] . " " . $registrado['apellido_registrado'];
                                            //Se crea variable para validar si ya pago y muestra un span 
                                            echo "<br>";
                                            $pagado = $registrado['pagado'];
                                            if ($pagado) {

                                                echo '<span class="badge bg-green">PAGADO </span>';
                                            } else {
                                                echo '<span class="badge bg-red">NO PAGADO </span>';
                                            }
                                            ?>

                                        </td>
                                        <td><?php echo $registrado['email_registrado']; ?></td>
                                        <td><?php echo $registrado['fecha_registro']; ?></td>
                                        <td>
                                            <?php
                                            //los datos de la BD se extran con json_decode y se transforma a array asociativo con el attr true
                                            $articulos_pases = json_decode($registrado['pases_articulos'], true);

                                            //Se re-formatea los datos para que sean mas legibles
                                            $articulos_formateados = array(
                                                'un_dia' => 'Pase por un dia',
                                                'completo' => 'Pase Diario',
                                                '2dias' => 'Pase por dos dias',
                                                'camisas' => 'Camisa(s)',
                                                'etiquetas' => 'Etiqueta(s)'
                                            );

                                            //se recorre todos los pases comprados de la BD 
                                            foreach ($articulos_pases as $key => $articulo) {
                                            
                                                if (key_exists('cantidad', $articulo)) {
                                                    echo  "<b>" . $articulo['cantidad'] . "</b>" .  " " . $articulos_formateados[$key] .  "<br>";
                                                } else {
                                                    echo  "<b>" . $articulo . "</b>" .  " " . $articulos_formateados[$key] .  "<br>";
                                                }
                                            }
                                            // echo '<pre>' ;
                                            //   var_dump($articulos_pases) ;
                                            // echo '</pre>' ;

                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            //se extraen los datos y se guardan en variable
                                            //se utiliza json_decode para convertir en array_assoc
                                            $eventos_resultados = json_decode($registrado['talleres_registrados'], true);

                                            //se separa los elemtos del array en un solo string separados por los valores otorgados (depues del implode)
                                            $talleres =  implode("','", $eventos_resultados['eventos']);

                                            //Consulta a BD para ver los eventos con ese nombre de taller
                                            include_once '/opt/lampp/htdocs/proyectosUdemy/PaginaConferencias/includes/funciones/db_conexion.php';

                                            $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE evento_id IN ('$talleres') ";

                                            $resultado_talleres = $conn->query($sql_talleres);
                                            while ($evento = $resultado_talleres->fetch_assoc()) {
                                                echo $evento['nombre_evento'] . " " . $evento['fecha_evento'] . " " . $evento['hora_evento'] . "<br>";
                                            }

                                            ?>
                                        </td>
                                        <td><?php echo $registrado['nombre_regalo']; ?></td>
                                        <td>$ <?php echo $registrado['total_pagado']; ?></td>
                                        <td>
                                            <a href="editar-registrado.php?id=<?php echo $registrado['id_registrado'] ?>" class="btn bg-orange btn-flat margin"><i class="fa fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn bg-maroon btn-flat margin borrar_registro" data-id="<?php echo $registrado['id_registrado']; ?>" data-tipo="registrado"><i class="fa fa-trash"></i>
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