<?php
$peticionAjax = true;
session_start();
require_once "./../core/configGeneral.php";
if (isset($_SESSION['id'])) {

    if (
        isset($_POST['uNombres']) && isset($_POST['uApellidos'])
        || isset($_POST['anteriorClave']) && isset($_POST['nuevaClave1']) && isset($_POST['nuevaClave2'])
        || isset($_GET['getHorario'])
    ) {
        require_once "./../controller/perfil.controlador.php";


        if (isset($_POST['uNombres']) && isset($_POST['uApellidos'])) {
            $UPerfil = new PerfilControlador();
            echo $UPerfil->CtrEditarPerfil();
        }

        // Para actualizar la contraseña
        if (isset($_POST['anteriorClave']) && isset($_POST['nuevaClave1']) && isset($_POST['nuevaClave2'])) {
            $UPerfil = new PerfilControlador();
            echo $UPerfil->CtrEditarClave();
        }

        // Para obtener el horario del pasante
        if (isset($_GET['getHorario'])) {
            $UPerfil = new PerfilControlador();
            echo json_encode($UPerfil->CtrGetHorarioAdm());
        }

    } else {
        echo "No se ha enviado ninguna solicitud";
    }
} else {
    echo '🤔';
}