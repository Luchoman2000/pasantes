<?php
$peticionAjax = true;
session_start();
require_once "./../core/configGeneral.php";
if (isset($_SESSION['id'])) {
    if (
        isset($_POST['ingreso'])
        || isset($_POST['almuerzo_inicio'])
        || isset($_POST['almuerzo_fin'])
        || isset($_POST['salida'])
        || isset($_POST['mostrar_calendario'])
        || (isset($_POST['id']) && $_POST['borrar_registro'] == true)
        || (isset($_POST['asiId_u']) && isset($_POST['h_entrada_u']))
        || (isset($_POST['per_id_C']) && isset($_POST['nueva_asistencia']))

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

        // Para mostrar el calendario
        if (isset($_POST['mostrar_calendario'])) {
            $MostrarCalendario = new AsistenciaControlador();
            $MostrarCalendario->CtrMostrarCalendario();
        }

        // =ADMIN=
        // Para eliminar un registro de un pasante
        if (isset($_POST['id']) && @$_POST['borrar_registro'] == true && $_SESSION['rol'] == "ADMINISTRADOR") {
            $EliminarRegistro = new AsistenciaControlador();
            $EliminarRegistro->CtrEliminarRegistro();
        }

        // Para editar el registro de un pasante
        if (isset($_POST['asiId_u']) && isset($_POST['h_entrada_u']) && $_SESSION['rol'] == "ADMINISTRADOR") {
            $EditarRegistro = new AsistenciaControlador();
            $EditarRegistro->CtrEditarRegistro();
        }

        // Para crear un registro de un pasante
        if (isset($_POST['per_id_C']) && isset($_POST['nueva_asistencia']) && $_SESSION['rol'] == "ADMINISTRADOR") {
            $CrearRegistro = new AsistenciaControlador();
            $CrearRegistro->CtrCrearRegistro();
        }
    } else {
        echo "No se ha enviado ninguna información";
    }
} else {
    echo '🤔';
}
