<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;


/* ################## INSERTAR ADMIN A DB PERO PRIMERO SE CONSULTA QUE NO EXISTA ######### */
if ($_POST['registro'] == 'crear') {
    die(json_encode($_POST));
    /* Datos que se envian desde el formulario Categorias Eventos */
    $nombre = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
    $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    /* PASSWORDS ENCRIPTADOS  */
    $opciones = array(
        'cost' => 12
    );
    $password_hash = password_hash($password, PASSWORD_BCRYPT, $opciones);

    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';
    /* se consulta datos en la base de datos */
    $query = $conn->prepare("SELECT * FROM administradores WHERE usuario = ?");
    $query->bind_param("s", $usuario);
    $query->execute();
    $query->store_result();
    $rows = $query->num_rows;

    if ($rows == 0) {
        try {


            $stmt = $conn->prepare("INSERT INTO administradores(usuario, nombre, password) VALUES (?,?,?)");
            $stmt->bind_param("sss", $usuario, $nombre, $password_hash);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $stmt->insert_id,
                    'nombre' => $nombre,
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
    } else {
        $respuesta = array(
            'respuesta' => 'error'
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




