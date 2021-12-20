<?php
$peticionAjax = true;
session_start();
require_once "./../core/configGeneral.php";
if (isset($_SESSION['id']) && $_SESSION['rol'] == "ADMINISTRADOR") {
    if (
        (isset($_POST['id']) && $_POST['borrar_usuario'] == true)
        || (isset($_POST['id_personal']) && @$_POST['borrar_personal'] == true)
        || (isset($_POST['id_horario']) && @$_POST['borrar_horario'] == true)
        || (@$_POST['editar_usuario_select_personal'] == true)
        || (@$_POST['editar_usuario_select_rol'] == true)
        || (@$_POST['editar_usuario_select_estado'] == true)
        || (@$_POST['editar_usuario_select_horario'] == true)
        || (isset($_POST['uPersonal']) && isset($_POST['uUsuario']) && isset($_POST['uRol']) && isset($_POST['uEstado'])) //Editar usuario
        || ((isset($_POST['id_personal']) && @$_POST['editar_personal'] == true) || (@$_POST['nuevo_personal'] == true)) //Editar personal
        || ((isset($_POST['id_horario']) && @$_POST['editar_horario'] == true) || (@$_POST['nuevo_horario'] == true)) //Editar horario
        || (isset($_POST['fecha']) && (isset($_POST['h_entrada_u']))) //Nuevo registro con fecha
    ) {
        require_once "./../controller/admin.controlador.php";

        // Para eliminar un usuario
        if (isset($_POST['id']) && $_POST['borrar_usuario'] == true) {
            $EliminarUsuario = new AdminControlador();
            $EliminarUsuario->CtrEliminarUsuario();
        }

        // Para eliminar un personal
        if (isset($_POST['id_personal']) && @$_POST['borrar_personal'] == true) {
            $EliminarPersonal = new AdminControlador();
            $EliminarPersonal->CtrEliminarPersonal();
        }

        // Para eliminar un horario
        if (isset($_POST['id_horario']) && @$_POST['borrar_horario'] == true) {
            $EliminarHorario = new AdminControlador();
            $EliminarHorario->CtrEliminarHorario();
        }

        // Para el <select> de personal usuario
        if (@$_POST['editar_usuario_select_personal'] == true) {
            $EditarUsuario = new AdminControlador();
            $EditarUsuario->CtrMostrarPersonalSelect();
            // $EditarUsuario->CtrMostrarRolSelect();
            // $EditarUsuario->CtrMostrarEstadoSelect();
        }

        // Para <select> de rol usuario
        if (@$_POST['editar_usuario_select_rol'] == true) {
            $EditarUsuario = new AdminControlador();
            $EditarUsuario->CtrMostrarRolSelect();
        }

        // Para <select> de estado usuario
        if (@$_POST['editar_usuario_select_estado'] == true) {
            $EditarUsuario = new AdminControlador();
            $EditarUsuario->CtrMostrarEstadoSelect();
        }

        // Para <select> de horario usuario
        if (@$_POST['editar_usuario_select_horario'] == true) {
            $EditarUsuario = new AdminControlador();
            $EditarUsuario->CtrMostrarHorarioSelect();
        }

        // Para nuevo usuario
        if (isset($_POST['uPersonal']) && isset($_POST['uUsuario']) && isset($_POST['uRol']) && isset($_POST['uEstado']) && isset($_POST['uNClave']) && isset($_POST['uSNClave']) && isset($_POST['nuevo_usuario'])) {
            $NuevoUsuario = new AdminControlador();
            $NuevoUsuario->CtrCrearUsuario();
        }

        // Para editar un usuario
        if (isset($_POST['uPersonal']) && isset($_POST['uUsuario']) && isset($_POST['uRol']) && isset($_POST['uEstado']) && isset($_POST['editar_usuario'])) {
            $EditarUsuario = new AdminControlador();
            $EditarUsuario->CtrEditarUsuario();
        }

        // Para editar un horario
        if (isset($_POST['id_horario']) && @$_POST['editar_horario'] == true) {
            $EditarHorario = new AdminControlador();
            $EditarHorario->CtrEditarHorario();
        }

        // Para nuevo personal
        if (isset($_POST['nuevo_personal'])) {
            $NuevoPersonal = new AdminControlador();
            $NuevoPersonal->CtrCrearPersonal();
        }

        // Para nuevo horario
        if (isset($_POST['nuevo_horario'])) {
            $NuevoHorario = new AdminControlador();
            $NuevoHorario->CtrCrearHorario();
        }

        //Para nuevo registro con fecha
        if ((isset($_POST['fecha']) && (isset($_POST['h_entrada_u'])))) {
            $nuevoReg = new AdminControlador();
            $nuevoReg->CtrNuevoRegistroPasante();
        }

        // Para editar un personal
        if (isset($_POST['editar_personal']) && isset($_POST['id_personal'])) {
            $EditarPersonal = new AdminControlador();
            $EditarPersonal->CtrEditarPersonal();
        }
    } else {
        echo "No se ha enviado ninguna información";
    }
} else {
    echo "🤔";
}
