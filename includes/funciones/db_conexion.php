<?php
    // // $ip = $_POST['parametroIP'];
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'maribelylucio13');
    define('DB_NAME', 'gdlwebcamp');
    
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    
    //?? ========= CODIGO PARA QUE FUNCIONE LAS 'Ñ' Y LOS ACENTOS =========== //
    $acentos = $conn->query("SET NAMES 'utf8'");

    if ($conn->connect_error) {
        echo $error -> $conn->connect_error;
    }else {
        // // echo 'sirve la conexion'. '<br>';
        // // echo $conn->host_info;  muestra la info de tipo de conexion 
    }

?>