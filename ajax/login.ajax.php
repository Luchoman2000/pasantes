<?php
$peticionAjax = true;
session_start();
require_once "./../core/configGeneral.php";
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    require_once '../controller/login.controlador.php';

    $ins_login = new loginControlador();
    $ins_login->CtrIniciarSesion();
    // 
}
