<?php
$peticionAjax = true;
session_start();
require_once "../core/configGeneral.php";
if (isset($_SESSION['id'])) {
    if (
        isset($_POST['reporte_asistencia']) // Para generar el reporte de asistencia acorde al ISTS en formato WORD
        || isset($_POST['reporte_registro_pasante_total']) // Para generar el reporte de registro de pasantes en formato PDF
    ) {


        require_once "./../controller/reporte.controlador.php";
        if (isset($_POST['reporte_asistencia'])) {

            $reportes = new reporteControlador();
            $reportes->CtrCrarControldeAsistenciaWord();
        }

        if (isset($_POST['reporte_registro_pasante_total']) && $_SESSION['rol'] == "ADMINISTRADOR") {
            $reportes = new reporteControlador();
            $reportes->CtrCrarReporteRegistroPasanteTotal();
        }
    } else {
        echo "No se se ha enviado ninguna solicitud";
    }
} else {
    echo '🤔';
}
