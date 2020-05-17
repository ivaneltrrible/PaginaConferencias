<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;

if (isset($_POST['agregar-admin'])) {

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
    /* se insertan datos en la base de datos */
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


if (isset($_POST['login-admin'])) {

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
            if($stmt->affected_rows){
               
                $exite = $stmt->fetch();

                 /* ## USUARIO EXISTE ## */
                if($exite){
                    if(password_verify($password, $password_admin)){
                        /* ##SE INICIA SESION ## */
                        session_start();
                        $_SESSION['usuario'] = $usuario_admin;
                        $_SESSION['nombre'] = $nombre_admin;
                        
                        /* ## PASSWORD CORRECTO ## */
                        $respuesta = array(
                            'respuesta' => 'exitoso',
                            'nombre_admin' => $nombre_admin
                        );
                    }else{
                        /* ## PASSWORD INCORRECTO ## */
                        $respuesta = array(
                            'respuesta' => 'error'
                        );
                    }
                }else{
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
