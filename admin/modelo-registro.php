<?php
// echo '<pre>' ;
//  var_dump($_POST) ;
// echo '</pre>' ;
include_once 'funciones/funciones.php';

if (isset($_POST['id_registrado'])) {
    $id_registro = $_POST['id_registrado'];
}

$nombre = $_POST['nombre_registrado'];
$apellido = $_POST['apellido_registrado'];
$email = $_POST['email_registrado'];
$regalo = $_POST['regalo'];
$total = $_POST['total_pedido'];
$eventos = $_POST['registro_evento'];
if (isset($_POST['fecha_registro'])) {
    $fecha_registro = $_POST['fecha_registro'];
}
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
        } else {
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


/* ###################### EDITAR REGISTRO DE MANERA MANUAL (COMPRAS) #################### */
if ($_POST['registro'] == 'actualizar') {
    // die(json_encode($_POST));


    // include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

    try {
        /* ##### ACTUALIZAR REGISTRO ##### */

        $stmt = $conn->prepare("UPDATE registrados SET nombre_registrado = ?, apellido_registrado = ?, email_registrado = ?, fecha_registro = ?, pases_articulos = ?, talleres_registrados = ?, regalo = ?, total_pagado = ?, pagado = 1 WHERE id_registrado = ?");
        $stmt->bind_param("sssssisi", $nombre, $apellido, $email, $fecha_registro, $pedidos, $eventos_formateados, $regalo, $total, $id_registro);
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
