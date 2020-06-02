<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;


/* Datos que se envian desde el formulario Eventos */
if (isset($_POST['categoria_evento'])) {
    $categoria_evento = filter_var($_POST['categoria_evento'], FILTER_VALIDATE_INT);
}
// Fecha Formateada para la DB 
if (isset($_POST['fecha_evento'])) {
    $fecha_evento = filter_var($_POST['fecha_evento'], FILTER_SANITIZE_SPECIAL_CHARS);
    $fecha_formateada = date("Y-m-d", strtotime($fecha_evento));
}
// Hora Formateada a la DB
if (isset($_POST['hora_evento'])) {
    $hora_evento = filter_var($_POST['hora_evento'], FILTER_SANITIZE_SPECIAL_CHARS);
    $hora = date('H:i:s', strtotime($hora_evento));
}
if (isset($_POST['nombre_evento'])) {
    $nombre_evento = filter_var($_POST['nombre_evento'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['invitado_evento'])) {
    $invitado_evento = filter_var($_POST['invitado_evento'], FILTER_VALIDATE_INT);
}


/* ################## INSERTAR Eventos a DB ######### */
if ($_POST['registro'] == 'crear') {

    try {

        include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

        $stmt = $conn->prepare("INSERT INTO eventos(nombre_evento, fecha_evento, hora_evento, id_cat_evento, id_invitado_key) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssii", $nombre_evento, $fecha_formateada, $hora, $categoria_evento, $invitado_evento);
        $stmt->execute();

        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $stmt->insert_id,
                'nombre_evento' => $nombre_evento
            );
        } else {
            $respuesta = array(
                "respuesta" => 'error'
            );
        }

        $stmt->close();
        $conn->close();
    } catch (\Exception $e) {
        $respuesta = array(
            'respuesta' => 'error',
            'Error' => $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}

/* ################## INSERTAR ADMIN A DB PERO PRIMERO SE CONSULTA QUE NO EXISTA ######### */
if ($_POST['registro'] == 'eliminar') {

    /* Datos que se envian desde el formulario Administrador */
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);



    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';




    try {


        /* se consulta datos en la base de datos */
        $stmt = $conn->prepare("DELETE FROM eventos WHERE evento_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exitoso',
                'id_eliminado' => $id
                // 'id_insertado' => $stmt->insert_id
            );
        }

        $stmt->close();
        $conn->close();
    } catch (\Exception $e) {
        $respuesta = array(
            'respuesta' => 'Error',
            'Error' => $e->getMessage()
        );
    }


    die(json_encode($respuesta));
}


/* ###################### EDITAR USUARIO ADMIN #################### */
if ($_POST['registro'] == 'actualizar') {

    /* Datos que se envian desde el formulario Administrador */


    $id_evento = filter_var($_POST['editar-evento'], FILTER_VALIDATE_INT);

    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

    try {
        $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_cat_evento = ?, id_invitado_key = ?, fecha_actualizacion = NOW() WHERE evento_id = ?");
        $stmt->bind_param("sssiii", $nombre_evento, $fecha_formateada, $hora, $categoria_evento, $invitado_evento, $id_evento);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exitoso',
                'id_actualizado' => $stmt->insert_id,
                'nombre' => $nombre_evento,
                'fecha' => $fecha_formateada,
                'hora' => $hora,

            );
        } else {
            $respuesta = array(
                'respuesta' => 'Error',

            );
        }

        $stmt->close();
        $conn->close();
    } catch (\Exception $e) {
        $respuesta = array(
            'respuesta' => 'Error',
            'Error' => $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}
