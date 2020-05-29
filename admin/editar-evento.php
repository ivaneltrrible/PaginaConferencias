<?php

include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';
$id_evento = $_GET['id'];
/* Sirve para que no pongas letras en la url de GET */
if (!filter_var($id_evento, FILTER_VALIDATE_INT)) {
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
                <h3 class="box-title">Formulario para Editar Evento</h3>
            </div>
            <?php
                include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
                $consulta = "SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, nombre_invitado, apellido_invitado ";
                                    $consulta .= " FROM eventos ";
                                   
                                    $consulta .= " INNER JOIN categoria_evento ";
                                    $consulta .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";

                                    $consulta .= " INNER JOIN invitados ";
                                    $consulta .= " ON eventos.id_invitado_key = invitados.invitado_id ";
                                    $consulta .= " WHERE evento_id = $id_evento ";
                                    $consulta .= " ORDER BY evento_id ";
                $resultado = $conn->query($consulta);
                $evento = $resultado->fetch_assoc();
                '<pre>' ;
                 var_dump($evento) ;
                '</pre>' ;
                $hora = $evento['hora_evento'];
                $hora_formateada = date('h:i:A', strtotime($hora));

            ?>
            <form role="form" method="post" id="editar-evento" name="editar-evento-form" action="modelo-evento.php">
            <div class="box-body">
                    <!-- Nombre del Evento-->
                    <div class="form-group">
                        <label for="nombre_evento">Nombre Evento</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                            <img src="img/file.svg" alt="Imagen de Archivo" height="16px" width="16px">
                            </div>
                            <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Nombre del Evento" value="<?php echo $evento['nombre_evento']; ?>">
                        </div>
                    </div>

                    <!-- Fecha del Evento datepicker plugin  -->
                    <div class="form-group">
                        <label>Fecha del Evento:</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                            <img src="img/calendario-de-google.svg" alt="Imagen de Calendario" height="16px" width="16px">
                            </div>
                            <input type="text" name="fecha_evento" class="form-control pull-right" id="datepicker" value="<?php echo $evento['fecha_evento']; ?>">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- Hora del Evento timer picker plugin -->
                    <div class="bootstrap-timepicker">
                        <div class="form-group">
                            <label>Hora del Evento:</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                    <img src="img/hora.svg" alt="Imagen de Reloj" height="16px" width="16px">
                                </div>

                                <input type="text" name="hora_evento" class="form-control timepicker" value="<?php echo $hora_formateada ; ?>">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>

                    <!-- Categorias del Evento--> 
                    <div class="form-group">
                        <label for="categoria_evento">Categoria del Evento</label>
                        <div class="input-group">
                                <div class="input-group-addon">
                                    <img src="img/conferencias.svg" alt="Imagen de Conferencias" height="16px" width="16px">
                                </div>

                        <select name="categoria_evento" id="categoria_evento" class="form-control select2">
                            <option value="0"><?php echo $evento['cat_evento']; ?></option>
                                <?php 
                                    try {
                                        // include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
                                        $sql = "SELECT * FROM categoria_evento";
                                        $result = $conn->query($sql);
                                        while ($categorias = $result->fetch_assoc()) { ?>
                                            <option value="<?php echo $categorias['id_categoria']; ?>"><?php echo $categorias['cat_evento']; ?></option>
                                       <?php } 
                                    } catch (\Exception $e) {
                                        //throw Exception $e
                                        echo "Error " . $e->getMessage();
                                    }
                                ?>                               
                        </select>
                    </div>

                    <!-- Informacion de Invitado-->
                    <div class="form-group">
                        <label for="invitado_evento">Invitado del Evento</label>
                        <div class="input-group">
                                <div class="input-group-addon">
                                    <img src="img/invitados.svg" alt="Imagen de Conferencias" height="16px" width="16px">
                                </div>

                        <select name="invitado_evento" id="invitado_evento" class="form-control select2" value="">
                            <option value="0">-- Seleccione Invitado --</option>
                                <?php 
                                    try {
                                        // include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
                                        $sql = "SELECT * FROM invitados";
                                        $result = $conn->query($sql);
                                        while ($invitados = $result->fetch_assoc()) { ?>
                                            <option value="<?php echo $invitados['invitado_id']; ?>"><?php echo $invitados['nombre_invitado'] . " " . $invitados['apellido_invitado']; ?></option>
                                       <?php } 
                                    } catch (\Exception $e) {
                                        //throw Exception $e
                                        echo "Error " . $e->getMessage();
                                    }
                                ?>                               
                        </select>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <input type="hidden" name="registro" value="actualizar">
                    <input type="hidden" name="editar-evento" value="<?php echo $id_evento ?>">
                    <button type="submit" class="btn btn-primary" id="boton_habilitar">Editar</button>
                </div>

            </form>
        </div>
        <!-- /.box-primary -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>