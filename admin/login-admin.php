<?php
/* ##################### LOGUEO CON USUARIO ADMIN AREA-ADMIN.PHP ################### */
if ($_POST['registro'] == 'logueo') {

    /* Datos que se envian desde el formulario Administrador */
    $usuario = filter_var($_POST['usuario'], FILTER_SANITIZE_STRING);

    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);


    /* ### CONSULTA QUE EXISTA EL USUARIO INGRESADO Y QUE SEA IGUAL EL PASSWORD */
    include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

    try {
        $stmt = $conn->prepare("SELECT id_admin, usuario, nombre, password, nivel FROM administradores WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->bind_result($id, $usuario_admin, $nombre_admin, $password_admin, $nivel);
        if ($stmt->affected_rows) {

            $exite = $stmt->fetch();

            /* ## USUARIO EXISTE ## */
            if ($exite) {
                if (password_verify($password, $password_admin)) {
                    /* ##SE INICIA SESION ## */
                    session_start();
                    $_SESSION['usuario'] = $usuario_admin;
                    $_SESSION['nombre'] = $nombre_admin;
                    $_SESSION['nivel'] = $nivel;

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
