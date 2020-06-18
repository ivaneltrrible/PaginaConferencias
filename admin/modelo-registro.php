<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;
include_once 'funciones/funciones.php' ;


$nombre = $_POST['nombre_registrado'];
$apellido = $_POST['apellido_registrado'];
$email = $_POST['email_registrado'];
$regalo = $_POST['regalo'];
$total = $_POST['total_pedido'];
$eventos = $_POST['registro_evento'];
$eventos_formateados = eventos_json($eventos);

$boletos = $_POST['boletos'];
// $pedido_extra = $_POST['pedido_extra'];  // variable para reutilizar etiquetas y camisas juntas 

$camisas = $_POST['pedido_extra']["camisas"]["cantidad"];
// $precioCamisas = filter_var($_POST['pedido_extra']["camisas"]["precio"], FILTER_VALIDATE_FLOAT);

$etiquetas = $_POST['pedido_extra']["etiquetas"]["cantidad"];
// $precioEtiquetas = filter_var($_POST['pedido_extra']["etiquetas"]["precio"], FILTER_VALIDATE_INT);


$pedidos = productos_json($boletos, $camisas, $etiquetas);

/* ################## INSERTAR ADMIN A DB PERO PRIMERO SE CONSULTA QUE NO EXISTA ######### */
if ($_POST['registro'] == 'crear') {
    // die(json_encode($_POST));
    
    
        try {


            $stmt = $conn->prepare("INSERT INTO registrados(nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado) VALUES (?,?,?,NOW(),?,?,?,?,1)");
            $stmt->bind_param("sssssis", $nombre, $apellido, $email, $pedidos, $eventos_formateados, $regalo, $total);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'exito',
                    'id_insertado' => $stmt->insert_id,
                    'nombre' => $nombre,
                    'email' => $email,
                    'apellido' => $apellido
                );
            }else{
                $respuesta = array(
                    'respuesta' => 'error'
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
