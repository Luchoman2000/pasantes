<?php
$peticionAjax = true;
session_start();
require_once "../core/configGeneral.php";
if (isset($_POST['reporte_asistencia'])) {
    require_once "./../controller/reporte.controlador.php";
    $reportes = new reporteControlador();
    $reportes->CtrCrarControldeAsistenciaWord();
} else {
    echo "No se se ha enviado ninguna solicitud";
}
