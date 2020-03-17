<?php
    // // $ip = $_POST['parametroIP'];
    $conn = new mysqli('localhost', 'root', '', 'gdlwebcamp');

    
    //?? ========= CODIGO PARA QUE FUNCIONE LAS 'Ñ' Y LOS ACENTOS =========== //
    $acentos = $conn->query("SET NAMES 'utf8'");

    if ($conn->connect_error) {
        echo $error -> $conn->connect_error;
    }else {
        // // echo 'sirve la conexion'. '<br>';
        // // echo $conn->host_info;  muestra la info de tipo de conexion 
    }

?>