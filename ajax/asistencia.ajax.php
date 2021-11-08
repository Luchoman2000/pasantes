<?php
$peticionAjax = true;
session_start();
require_once "./../core/configGeneral.php";

if (
       isset($_POST['ingreso'])
    || isset($_POST['almuerzo_inicio'])
    || isset($_POST['almuerzo_fin'])
    || isset($_POST['salida'])
    
) {
    require_once "./../controller/asistencia.controlador.php";

    // Para marcar el ingreso del pasante
    if (isset($_POST['ingreso'])) {
        $MarcarIngreso = new AsistenciaControlador();
        $MarcarIngreso->CtrMarcarIngreso();
    }
    // Para marcar el inicio almuerzo del pasante
    if (isset($_POST['almuerzo_inicio'])) {
        $MarcarAlmuerzo = new AsistenciaControlador();
        $MarcarAlmuerzo->CtrMarcarAlmuerzoInicio();
    }

    // Para marcar el fin almuerzo del pasante
    if (isset($_POST['almuerzo_fin'])) {
        $MarcarAlmuerzo = new AsistenciaControlador();
        $MarcarAlmuerzo->CtrMarcarAlmuerzoFin();
    }

    // Para marcar el salida del pasante
    if (isset($_POST['salida'])) {
        $MarcarSalida = new AsistenciaControlador();
        $MarcarSalida->CtrMarcarSalida();
    }

}