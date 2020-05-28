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
            Crear Evento
            <small>crea un evento(llena todos los campos) </small>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content col-md-10">

        <!-- Default box -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Formulario para crear un Evento</h3>
            </div>
            <form role="form" method="post" id="crear-evento" name="crear-evento" action="modelo-evento.php">
                <div class="box-body">
                    <!-- Nombre del Evento-->
                    <div class="form-group">
                        <label for="nombre_evento">Nombre Evento</label>

                        <div class="input-group">
                            <div class="input-group-addon">
                            <img src="img/file.svg" alt="Imagen de Archivo" height="16px" width="16px">
                            </div>
                            <input type="text" class="form-control" id="nombre_evento" name="nombre_evento" placeholder="Nombre del Evento" required>
                        </div>
                    </div>

                    <!-- Fecha del Evento datepicker plugin  -->
                    <div class="form-group">
                        <label>Fecha del Evento:</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                            <img src="img/calendario-de-google.svg" alt="Imagen de Calendario" height="16px" width="16px">
                            </div>
                            <input type="text" name="fecha_evento" class="form-control pull-right" id="datepicker" required>
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

                                <input type="text" name="hora_evento" class="form-control timepicker" required>
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

                        <select name="categoria_evento" id="categoria_evento" class="form-control select2" required>
                            <option value="0">-- Seleccione Categoria --</option>
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

                        <select name="invitado_evento" id="invitado_evento" class="form-control select2" required>
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
                    <input type="hidden" name="registro" value="crear">
                    <button type="submit" class="btn btn-primary">Crear Evento</button>
                </div>
            </form>
        </div>
        <!-- /.box-primary -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>