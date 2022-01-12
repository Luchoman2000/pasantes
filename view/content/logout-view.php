<?php
// session_name('SSP');
// session_start();
require_once './controller/login.controlador.php';
$ClearSes = new LoginControlador();
$res = $ClearSes->CtrBorrarSession($_SESSION['id']);
if ($res) {
    unset($_SESSION["id"]);
    unset($_SESSION["rol"]);
    unset($_SESSION["p_id"]);
    unset($_SESSION["nombre"]);
    unset($_SESSION["apellido"]);
    unset($_SESSION["hor_id"]);
    if (@isset($_SESSION['horario']['hor_entrada']) && @isset($_SESSION['horario']['hor_salida'])) {
        unset($_SESSION['horario']['hor_entrada']);
        unset($_SESSION['horario']['hor_salida']);
    }
    session_unset();
    session_destroy();
    header("Location:login");
}
