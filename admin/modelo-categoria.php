<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;


/* ################## INSERTAR ADMIN A DB PERO PRIMERO SE CONSULTA QUE NO EXISTA ######### */
if ($_POST['registro'] == 'crear') {

    /* Datos que se envian desde el formulario Categorias Eventos */
    $nombre = filter_var($_POST['nombre_categoria'], FILTER_SANITIZE_STRING);
    $icono = filter_var($_POST['icono'], FILTER_SANITIZE_STRING);


    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
    /* se consulta datos en la base de datos */
    $query = $conn->prepare("SELECT * FROM categoria_evento WHERE cat_evento = ?");
    $query->bind_param("s", $nombre);
    $query->execute();
    $query->store_result();
    $rows = $query->num_rows;

    if ($rows == 0) {
        try {


            $stmt = $conn->prepare("INSERT INTO categoria_evento(cat_evento, icono) VALUES (?,?)");
            $stmt->bind_param("ss", $nombre, $icono);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $stmt->insert_id,
                    'nombre' => $nombre,
                    'icono' => $icono
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
    } else {
        $respuesta = array(
            'respuesta' => 'error',
            'nombre' => $nombre
        );
    }
    die(json_encode($respuesta));
}

/* ################## INSERTAR ADMIN A DB PERO PRIMERO SE CONSULTA QUE NO EXISTA ######### */
if ($_POST['registro'] == 'eliminar') {

    /* Datos que se envian desde el formulario ver todos las categorias */
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);



   

    try {

        include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
        /* se consulta datos en la base de datos */
        $query = $conn->prepare("DELETE FROM categoria_evento WHERE id_categoria = ?");
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
    $nombre = filter_var($_POST['nombre_categoria'], FILTER_SANITIZE_STRING);
    $icono = filter_var($_POST['icono'], FILTER_SANITIZE_STRING);
    $id_editar = filter_var($_POST['id_categoria'], FILTER_SANITIZE_NUMBER_INT);
  


    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

    try {
        /* ##### ACTUALIZAR PERO SOLO USUARIO Y NOMBRE ##### */

        $stmt = $conn->prepare("UPDATE categoria_evento SET cat_evento = ?, icono = ?, fecha_actualizacion = NOW() WHERE id_categoria = ?");
        $stmt->bind_param("ssi", $nombre, $icono, $id_editar);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exitoso',
                'id_actualizado' => $stmt->insert_id,
                'nombre' => $nombre,
                'icono' => $icono
            );
        } else {
            $respuesta = array(
                'respuesta' => 'Error'
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
