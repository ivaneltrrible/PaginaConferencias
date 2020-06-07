<?php

/* ## CONEXION PARA REALIZAR CONSULTA DB DE LA TABLA ADMINISTRADORES ### */
function obtenerAdmins()
{
    /* ## CONEXION PARA REALIZAR CONSULTA DB DE LA TABLA ADMINISTRADORES ### */
    try {
        include_once '../../PaginaConferencias/includes/funciones/db_conexion.php';

        
        return $conn->query("SELECT id_admin, usuario, nombre FROM administradores");
    } catch (\Exception $e) {
        $error = $e->getMessage();
        echo $error;
    }
}
