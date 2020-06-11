<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;


/* Datos que se envian desde el formulario de Invitados */
if (isset($_POST['nombre_invitado'])) {
    $nombre = filter_var($_POST['nombre_invitado'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['apellido_invitado'])) {
    $apellido = filter_var($_POST['apellido_invitado'], FILTER_SANITIZE_STRING);
}
if (isset($_POST['biografia_invitado'])) {
    $biografia = filter_var($_POST['biografia_invitado'], FILTER_SANITIZE_STRING);
}
/* Datos que se envian desde el formulario input hidden de editar invitados */
if (isset($_POST['id_registro'])) {
    $id_registro = filter_var($_POST['id_registro'], FILTER_VALIDATE_INT);
}


/* ################## INSERTAR INVITADO   ######### */
if ($_POST['registro'] == 'crear') {

    //De esta manera recibimos los archivos con $_FILES
    // $respuesta = array(
    //     'post' => $_POST,
    //     'files' => $_FILES
    // );
    // die(json_encode($respuesta));



    //Se crea variable de directorio donde se guardaran todos las imagen que se suben al servidor
    $directorio = "../img/invitados/";

    //Se valida que exista dir, si no se crea el dir
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }

    if (move_uploaded_file($_FILES['imagen_invitado']['tmp_name'], $directorio . $_FILES['imagen_invitado']['name'])) {
        $imagen_url = $_FILES['imagen_invitado']['name'];
        $imagen_resultado = "Se subio Correctamente";
    } else {
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }


    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

    try {


        $stmt = $conn->prepare("INSERT INTO invitados(nombre_invitado, apellido_invitado, descripcion, url_imagen) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss", $nombre, $apellido, $biografia, $imagen_url);
        $stmt->execute();
        if ($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $stmt->insert_id,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'biografia' => $biografia,
                'imagen' => $imagen_resultado
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

/* ################## INSERTAR ADMIN A DB PERO PRIMERO SE CONSULTA QUE NO EXISTA ######### */
if ($_POST['registro'] == 'eliminar') {



    try {

        include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
        /* se consulta datos en la base de datos */
        $query = $conn->prepare("DELETE FROM invitados WHERE invitado_id = ?");
        $query->bind_param("i", $id_registro);
        $query->execute();

        if ($query->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exitoso',
                'id_eliminado' => $id_registro
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


/* ###################### EDITAR Invitado#################### */
if ($_POST['registro'] == 'actualizar') {

    //Se crea variable de directorio donde se guardaran todos las imagen que se suben al servidor
    $directorio = "../img/invitados/";

    //Se valida que exista dir, si no se crea el dir
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }

    if (move_uploaded_file($_FILES['imagen_invitado']['tmp_name'], $directorio . $_FILES['imagen_invitado']['name'])) {
        $imagen_url = $_FILES['imagen_invitado']['name'];
        $imagen_resultado = "Se subio Correctamente";
    } else {
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }

    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

    try {
        /* ##### ACTUALIZAR PERO SOLO USUARIO Y NOMBRE ##### */
        if ($_FILES['imagen_invitado']['size'] > 0) {
            //CON IMAGEN
            $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, url_imagen = ?, fecha_actualizacion = NOW() WHERE invitado_id = ?");
            $stmt->bind_param("ssssi", $nombre, $apellido, $biografia, $imagen_url, $id_registro);
        } else {
            //SIN IMAGEN
            $stmt = $conn->prepare("UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripcion = ?, fecha_actualizacion = NOW() WHERE invitado_id = ?");
            $stmt->bind_param("sssi", $nombre, $apellido, $biografia, $id_registro);
        }
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exitoso',
                'id_actualizado' => $stmt->insert_id,
                'nombre' => $nombre,
                'apellido' => $apellido
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
