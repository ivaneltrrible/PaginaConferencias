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
            Dashboard
            <small>Informacion de Eventos</small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- LINE CHART -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Line Chart</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="line-chart" style="height: 300px;"></div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col (RIGHT) -->
        </div>
        <h2 class="page-header">Resumen de Registrados</h2>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- CONSULTA DB -->
                <?php

                $sql = "SELECT COUNT(id_registrado) total FROM registrados";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();


                ?>
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $registrados['total']; ?></h3>

                        <p>Total Registrados</p>
                    </div>
                    <div class="icon">
                        <img src="img/user_group.svg" alt="Img de usuarios" height="90px" width="90px">
                    </div>
                    <a href="#" class="small-box-footer">
                        Mas informacion <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col TOTAL REGISTRADOS -->

            <div class="col-lg-3 col-xs-6">
                <!-- CONSULTA DB -->
                <?php

                $sql = "SELECT COUNT(id_registrado) total FROM registrados WHERE pagado = 1";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();


                ?>
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $registrados['total']; ?></h3>

                        <p>Total Pagados</p>
                    </div>
                    <div class="icon">
                        <img src="img/verify.svg" alt="Img de usuarios" height="70px" width="70px">
                    </div>
                    <a href="#" class="small-box-footer">
                        Mas informacion <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col TOTAL PAGARON-->

            <div class="col-lg-3 col-xs-6">
                <!-- CONSULTA DB -->
                <?php

                $sql = "SELECT COUNT(id_registrado) total FROM registrados WHERE pagado = 0";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();


                ?>
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $registrados['total']; ?></h3>

                        <p>Total Sin pagar</p>
                    </div>
                    <div class="icon">
                        <img src="img/money.svg" alt="Img de usuarios" height="70px" width="70px">
                    </div>
                    <a href="#" class="small-box-footer">
                        Mas informacion <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col No pagaron -->

            <div class="col-lg-3 col-xs-6">
                <!-- CONSULTA DB -->
                <?php

                $sql = "SELECT SUM(total_pagado) ganancias FROM registrados WHERE pagado = 1";
                $resultado = $conn->query($sql);
                $registrados = $resultado->fetch_assoc();


                ?>
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>$<?php echo number_format($registrados['ganancias'], 2); ?></h3>

                        <p>Ganancias</p>
                    </div>
                    <div class="icon">
                        <img src="img/ganacias.svg" alt="Img de usuarios" height="80px" width="80px">
                    </div>
                    <a href="#" class="small-box-footer">
                        Mas informacion <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col SUMA TOTAL DE GANACIAS -->
        </div>

        <h2 class="page-header">
            Regalos
        </h2>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- CONSULTA DB -->
                <?php

                $sql = "SELECT COUNT(regalo) AS pulseras FROM registrados WHERE pagado = 1 AND regalo = 1";
                $resultado = $conn->query($sql);
                $regalo = $resultado->fetch_assoc();


                ?>
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?php echo $regalo['pulseras']; ?></h3>

                        <p>Total de Pulseras</p>
                    </div>
                    <div class="icon">
                        <img src="img/gift-box.svg" alt="Img de usuarios" height="80px" width="80px">
                    </div>
                    <a href="#" class="small-box-footer">
                        Mas informacion <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col SUMA de PULSERAS -->

            <div class="col-lg-3 col-xs-6">
                <!-- CONSULTA DB -->
                <?php

                $sql = "SELECT COUNT(regalo) AS etiquetas FROM registrados WHERE pagado = 1 AND regalo = 2";
                $resultado = $conn->query($sql);
                $regalo = $resultado->fetch_assoc();


                ?>
                <!-- small box -->
                <div class="small-box bg-fuchsia">
                    <div class="inner">
                        <h3><?php echo $regalo['etiquetas']; ?></h3>

                        <p>Total de Etiquetas</p>
                    </div>
                    <div class="icon">
                        <img src="img/gift-box.svg" alt="Img de usuarios" height="80px" width="80px">
                    </div>
                    <a href="#" class="small-box-footer">
                        Mas informacion <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col SUMA de Etiquetas -->


            <div class="col-lg-3 col-xs-6">
                <!-- CONSULTA DB -->
                <?php

                $sql = "SELECT COUNT(regalo) AS plumas FROM registrados WHERE pagado = 1 AND regalo = 3";
                $resultado = $conn->query($sql);
                $regalo = $resultado->fetch_assoc();


                ?>
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <h3><?php echo $regalo['plumas']; ?></h3>

                        <p>Total de Plumas</p>
                    </div>
                    <div class="icon">
                        <img src="img/gift-box.svg" alt="Img de usuarios" height="80px" width="80px">
                    </div>
                    <a href="#" class="small-box-footer">
                        Mas informacion <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col SUMA de plumas -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>