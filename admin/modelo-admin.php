<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;


/* ################## INSERTAR ADMIN A DB PERO PRIMERO SE CONSULTA QUE NO EXISTA ######### */
if ($_POST['registro'] == 'crear') {

    /* Datos que se envian desde el formulario Administrador */
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);
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
            }else{
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
  



/* ##################### LOGUEO CON USUARIO ADMIN AREA-ADMIN.PHP ################### */
if ($_POST['registro'] == 'logueo') {

    /* Datos que se envian desde el formulario Administrador */
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);

    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


    /* ### CONSULTA QUE EXISTA EL USUARIO INGRESADO Y QUE SEA IGUAL EL PASSWORD */
    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

    try {
        $stmt = $conn->prepare("SELECT id_admin, usuario, nombre, password FROM administradores WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id, $usuario_admin, $nombre_admin, $password_admin);
        if ($stmt->affected_rows) {

            $exite = $stmt->fetch();

            /* ## USUARIO EXISTE ## */
            if ($exite) {
                if (password_verify($password, $password_admin)) {
                    /* ##SE INICIA SESION ## */
                    session_start();
                    $_SESSION['usuario'] = $usuario_admin;
                    $_SESSION['nombre'] = $nombre_admin;

                    /* ## PASSWORD CORRECTO ## */
                    $respuesta = array(
                        'respuesta' => 'exitoso',
                        'nombre_admin' => $nombre_admin
                    );
                } else {
                    /* ## PASSWORD INCORRECTO ## */
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
            } else {
                /* ## USUARIO INCORRECTO ## */
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
        }
        /* ##### TERMINA IF PARA COMPROBAR USUARIO ######*/

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

