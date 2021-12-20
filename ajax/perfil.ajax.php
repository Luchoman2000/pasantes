<?php
$peticionAjax = true;
session_start();
require_once "./../core/configGeneral.php";
if (isset($_SESSION['id'])) {

    if (
        isset($_POST['uNombres']) && isset($_POST['uApellidos'])
    ) {
        require_once "./../controller/perfil.controlador.php";


        if (isset($_POST['uNombres']) && isset($_POST['uApellidos'])) {
            $UPerfil = new PerfilControlador();
            echo $UPerfil->CtrEditarPerfil();
        }
    } else {
        echo "No se ha enviado ninguna solicitud";
    }
} else {
    echo '🤔';
}