<?php include_once 'includes/templates/header.php'; ?>





<!--=====================================================================
                           CALENDARIO         
  =======================================================================-->
<section class="seccion contenedor">
    <h2>CALENDARIO de eventos</h2>

    <?php
    try {
        require_once('includes/funciones/db_conexion.php');
        $sql = 'SELECT evento_id, nombre_evento, fecha_evento, hora_evento, cat_evento, icono, nombre_invitado, apellido_invitado
        FROM eventos 
        INNER JOIN categoria_evento
        ON eventos.id_cat_evento = categoria_evento.id_categoria
        INNER JOIN invitados
        ON eventos.id_invitado_key = invitados.invitado_id
        ORDER BY evento_id';
        $resultado = $conn->query($sql);
    } catch (\Exception $e) {  // ! En caso de error en DB se guarda en el catch y lanza el error
        echo $e->getMessage();
    }
    ?>
    <div class="calendario">
        <?php
        //!Formateando los arreglos con los propios 
        $calendario = array();
        while ($eventos = $resultado->fetch_assoc()) {
            $fecha = $eventos['fecha_evento'];
            $evento = array(
                'titulo' => $eventos['nombre_evento'],
                'fecha' => $eventos['fecha_evento'],
                'hora' => $eventos['hora_evento'],
                'categoria' => $eventos['cat_evento'],
                'icono' => $eventos['icono'],
                'nombre' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']
            );
            $calendario[$fecha][] = $evento;
        } //se cierra while  
        ?>
        <!--  Aqui es donde se ingresa el foreach para mostrar la fecha del evento y formatos de Hora/Dia -->
        <?php foreach ($calendario as $dia => $lista_eventos) { ?>
            <h3>
                <i class="far fa-calendar-alt"></i> 
                <?php
                //Formato en UNIX(linux&MAC)
                setlocale(LC_TIME, 'es_ES.UTF-8');
                //Formato en windows
                setlocale(LC_TIME, 'spanish');

                echo strftime('%A, %d de %B  del %Y', strtotime($dia));
                ?>
            </h3>
            <?php foreach ($lista_eventos as $evento) { ?>
                <div class="dia">
                    <p class="titulo"><?php echo $evento['titulo']; ?></p>
                    <p class="fecha"><i class="fa fa-clock o"></i><?php echo $evento['fecha'] . " " . $evento['hora']; ?></p>
                    <p class="categoria"><i class="fa <?php echo $evento['icono']; ?>"></i><?php echo $evento['categoria']; ?></p>
                    <p class="nombre"><i class="fas fa-user"></i><?php echo $evento['nombre']; ?></p>
                </div>

            <?php } ?>
        <?php } //fin FOREACH DIA 
        ?>


        <!--======== Cerrando la conexion a la base de datos ======-->
        <?php $conn->close(); ?>

    </div> <!-- Fin calendario -->



</section>
<?php include_once 'includes/templates/footer.php';  ?>