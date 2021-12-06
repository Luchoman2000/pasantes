<?php
$peticionAjax = true;
session_start();
require_once "./../core/configGeneral.php";

if (
    (isset($_POST['id']) && $_POST['borrar_usuario'] == true)
    || (isset($_POST['id_personal']) && $_POST['borrar_personal'] == true)
    || (@$_POST['editar_usuario_select_personal'] == true)
    || (@$_POST['editar_usuario_select_rol'] == true)
    || (@$_POST['editar_usuario_select_estado'] == true)
    || (isset($_POST['uPersonal']) && isset($_POST['uUsuario']) && isset($_POST['uRol']) && isset($_POST['uEstado']))
    || ((isset($_POST['id_personal']) && $_POST['editar_personal'] == true) || (@$_POST['nuevo_personal'] == true))
) {
    require_once "./../controller/admin.controlador.php";

    // Para eliminar un usuario
    if (isset($_POST['id']) && $_POST['borrar_usuario'] == true) {
        $EliminarUsuario = new AdminControlador();
        $EliminarUsuario->CtrEliminarUsuario();
    }

    // Para eliminar un personal
    if (isset($_POST['id_personal']) && $_POST['borrar_personal'] == true) {
        $EliminarPersonal = new AdminControlador();
        $EliminarPersonal->CtrEliminarPersonal();
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

    // Para nuevo personal
    if (isset($_POST['nuevo_personal']) ) {
        $NuevoPersonal = new AdminControlador();
        $NuevoPersonal->CtrCrearPersonal();
    }

    // Para editar un personal
    if (isset($_POST['editar_personal']) && isset($_POST['id_personal'])) {
        $EditarPersonal = new AdminControlador();
        $EditarPersonal->CtrEditarPersonal();
    }

}else{
    echo "No se ha enviado ninguna información";
}
