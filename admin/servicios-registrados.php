<?php
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';

$sql = "SELECT fecha_registro, COUNT(*) AS resultado FROM registrados GROUP BY DATE(fecha_registro) ORDER BY fecha_registro";
$resultado = $conn->query($sql);

$registros_formateados = array();
while ($registros_dia = $resultado->fetch_assoc()) {
    # iteracion de cada registro hecho por dia 
    $fecha = $registros_dia['fecha_registro'];
    $registros['fecha'] = date('Y-m-d', strtotime($fecha));
    $registros['cantidad'] = $registros_dia['resultado'];

    $registros_formateados[] = $registros;
}


echo json_encode($registros_formateados);
