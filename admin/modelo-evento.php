<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;


/* Datos que se envian desde el formulario Eventos */
$categoria_evento = filter_var($_POST['categoria_evento'], FILTER_VALIDATE_INT);

// Fecha Formateada para la DB 
$fecha_evento = filter_var($_POST['fecha_evento'], FILTER_SANITIZE_SPECIAL_CHARS);
$fecha_formateada = date("Y-m-d", strtotime($fecha_evento));

// Hora Formateada a la DB
$hora_evento = filter_var($_POST['hora_evento'], FILTER_SANITIZE_SPECIAL_CHARS);
$hora = date('H:i:s', strtotime($hora_evento));


$nombre_evento = filter_var($_POST['nombre_evento'], FILTER_SANITIZE_STRING);
$invitado_evento = filter_var($_POST['invitado_evento'], FILTER_VALIDATE_INT);



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
        $query = $conn->prepare("DELETE FROM administradores WHERE id_admin = ?");
        $query->bind_param("i", $id);
        $query->execute();

        if ($query->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exitoso',
                'id_eliminado' => $id
                // 'id_insertado' => $query->insert_id
            );
        }

        $query->close();
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
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $id_editar = filter_var($_POST['editar-admin'], FILTER_SANITIZE_NUMBER_INT);


    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

    try {
        /* ##### ACTUALIZAR PERO SOLO USUARIO Y NOMBRE ##### */
        if (empty($_POST['password'])) {
            $stmt = $conn->prepare("UPDATE administradores SET usuario = ?, nombre = ?, fecha_creacion = NOW() WHERE id_admin = ?");
            $stmt->bind_param("ssi", $usuario, $nombre, $id_editar);
        } else {
            /* ### ACTUALIZAR LOS TRES DATOS PASS, USER Y NAME */

            /* SE ENCRIPTA PASSWORD */
            /* PASSWORDS ENCRIPTADOS opciones  */
            $opciones = array(
                'cost' => 12
            );
            $password_hash = password_hash($password, PASSWORD_BCRYPT, $opciones);

            $stmt = $conn->prepare("UPDATE administradores SET usuario = ?, nombre = ?, password = ?, fecha_creacion = NOW() WHERE id_admin = ?");
            $stmt->bind_param("sssi", $usuario, $nombre, $password_hash, $id_editar);
        }
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exitoso',
                'id_actualizado' => $stmt->insert_id,
                'nombre' => $nombre,
                'usuario' => $usuario
            );
        } else {
            $respuesta = array(
                'respuesta' => 'Error',
                'usuario' => $usuario
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
