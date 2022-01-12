<?php
$peticionAjax = true;
session_start();
require_once "./../core/configGeneral.php";
if (isset($_SESSION['id'])) {
    if (
        isset($_POST['ingreso'])
        || isset($_GET['observacion'])
        || isset($_GET['observacionUp'])
        || isset($_GET['getObservacion'])
        || isset($_POST['almuerzo_inicio'])
        || isset($_POST['almuerzo_fin'])
        || isset($_POST['salida'])
        || isset($_POST['mostrar_calendario'])
        || isset($_POST['listar_asistencia']) // test ajax DataTables
        || (isset($_POST['listarAsistenciaPasante']) && isset($_POST['screen']))
        || (isset($_POST['listarAsistenciaPasante_adm']) && isset($_POST['horario']))
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

        // Para agregar observacion
        if (isset($_GET['observacion'])) {
            $AgregarObservacion = new AsistenciaControlador();
            $AgregarObservacion->CtrAgregarObservacion();
        }
        // Para actualizar observacion
        if (isset($_GET['observacionUp'])) {
            $UpObservacion = new AsistenciaControlador();
            $UpObservacion->CtrActualizarObservacion();
        }

        // Para mostrar observacion
        if (isset($_GET['getObservacion'])) {
            $MostrarObservacion = new AsistenciaControlador();
            $MostrarObservacion->CtrMostrarObservacion();
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

        // Para listar las asistencias
        if (isset($_POST['listar_asistencia'])) {
            $ListarAsistencia = new AsistenciaControlador();
            $ListarAsistencia->CtrListarAsistencia();
        }

        // Para listar las asistencias de un pasante
        if (isset($_POST['listarAsistenciaPasante']) && isset($_POST['screen'])) {
            $ListarAsistenciaPasante = new AsistenciaControlador();
            $ListarAsistenciaPasante->CtrMostrarAsistenciaPasante();
        }

        // =ADMIN=

        // Para listar las asistencias de un pasante vista administrador
        if (isset($_POST['listarAsistenciaPasante_adm']) && isset($_POST['horario']) && $_SESSION['rol'] == "ADMINISTRADOR") {
            $ListarAsistenciaPasante = new AsistenciaControlador();
            $ListarAsistenciaPasante->CtrMostrarAsistenciaPasanteAdmin();
        }

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
