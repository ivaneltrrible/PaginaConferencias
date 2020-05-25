<?php

/* ###  COMPRUEBA LA FUNCION DE REVISAR USUARIO SI NO EXISTA REDIRECCIONA A LOGIN.PHP ######*/
function autentificar_usuario(){
    if(!revisar_usuario()){
        header("Location: login.php");
    }
}

/* ### REVISAR QUE EXISTE UN USUARIO LOGUEADO REGRESA TRUE O FALSE ### */
function revisar_usuario(){
        return isset($_SESSION['usuario']);
}
session_start();
autentificar_usuario();