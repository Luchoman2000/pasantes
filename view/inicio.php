<?php
// header('Content-Type: text/html; charset=UTF-8');  
session_start();
$peticionAjax = false;
require_once 'core/configGeneral.php';
require_once "./controller/vista.controlador.php";
$vt = new VistaControlador();
$vistas = $vt->CtrMostrarVistas();

if ($vistas == "login" || $vistas == "404" || $vistas == "logout") {
    if ($vistas == "login") {
        include "./view/content/login-view.php";
    } elseif ($vistas == "404") {
        include "./view/content/404-view.php";
    } elseif ($vistas == "logout") {
        include "./view/content/logout-view.php";
    }
} elseif (isset($_SESSION['p_id'])) {
    $ruta = explode("/", $_GET['views']);
    if(isset($ruta[1]) && $_SESSION['rol'] == "PASANTE"){
       include "./view/content/404-view.php";
    }else{
        
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> -->
        <link rel="shortcut icon" type="image/jpg" href="<?php echo SERVERURL ?>src/assets/icon/favicon.ico" />
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/bulma.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/bulma-tootip.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/sweetalert2.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/dataTables.bulma.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/fixedColumns.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/modal-fx.min.css">
        <script src="<?php echo SERVERURL ?>src/js/jquery.min.js"></script>
        <script src="<?php echo SERVERURL ?>src/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo SERVERURL ?>src/js/dataTables.bulma.min.js"></script>
        <script src="<?php echo SERVERURL ?>src/js/dataTables.fixedColumns.min.js"></script>

        <script src="<?php echo SERVERURL ?>src/js/nav.js"></script>


        <?php if ($_SESSION['rol'] == 'PASANTE') {
        ?>
            <script src="<?php echo SERVERURL ?>src/js/ajax-asistencia.js"></script>
        <?php
        } elseif ($_SESSION['rol'] == 'ADMINISTRADOR') {
        ?>

            <script src="<?php echo SERVERURL ?>src/js/ajax-asistencia.js"></script>
            <script src="<?php echo SERVERURL ?>src/js/ajax-asistencia-admin.js"></script>
        <?php
        } ?>

        <link rel="manifest" href="<?php echo SERVERURL ?>manifest.json">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/nav.css">
        <title>Asistencias</title>

    </head>

    <body>


        <!-- Navbar -->
        <?php
        include 'static/navbar.php';
        ?>

        <?php require_once $vistas; ?>

        <!-- Scripts -->
        <?php
        include 'static/scripts.php';
        ?>


    </body>

    </html>

<?php
}} else {
    require_once './controller/login.controlador.php';
    $logout = new LoginControlador();
    echo $logout->CtrCerrarSesion();
}
