<?php
// session_name('SSP');
session_start();
$peticionAjax = false;
require_once 'core/configGeneral.php';
require_once "./controller/vista.controlador.php";
$vt = new VistaControlador();
$vistas = $vt->CtrMostrarVistas();
// var_dump($vistas);
// var_dump($vistas);
// var_dump($_SESSION['id']);
// var_dump($_SESSION['p_id']);

if ($vistas == "login" || $vistas == "404" || $vistas == "logout") {
    if ($vistas == "login") {
        // header('Location: '.SERVERURL.'view/content/login-view.php');

        include "./view/content/login-view.php";
    } elseif ($vistas == "404") {
        include "./view/content/404-view.php";
    } elseif ($vistas == "logout") {
        include "./view/content/logout-view.php";
    }
} elseif (isset($_SESSION['p_id'])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <!-- <link rel="shortcut icon" type="image/jpg" href="<?php echo SERVERURL ?>assets/imag/favicon.ico" /> -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/bulma.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/bulma-tootip.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/sweetalert2.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/dataTables.bulma.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/fixedColumns.dataTables.min.css">
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-list/css/bulma-list.css"> -->
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bulma.min.css"> -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.0.0/css/fixedColumns.dataTables.min.css"> -->
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bm/jq-3.6.0/b-2.0.1/b-colvis-2.0.1/r-2.2.9/datatables.min.css" /> -->
        <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
        <!-- <script src="<?php echo SERVERURL ?>src/js/jquery-3.5.1.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bm/jq-3.6.0/b-2.0.1/b-colvis-2.0.1/r-2.2.9/datatables.min.js"></script> -->
        <script src="<?php echo SERVERURL ?>src/js/jquery.min.js"></script>
        <script src="<?php echo SERVERURL ?>src/js/jquery.dataTables.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
        <script src="<?php echo SERVERURL ?>src/js/dataTables.bulma.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bulma.min.js"></script> -->
        <script src="<?php echo SERVERURL ?>src/js/dataTables.fixedColumns.min.js"></script>
        <!-- <script src="https://cdn.datatables.net/fixedcolumns/4.0.0/js/dataTables.fixedColumns.min.js"></script> -->
        <script src="<?php echo SERVERURL ?>src/js/sweetalert2.min.js"></script>
        <script src="<?php echo SERVERURL ?>src/js/nav.js"></script>
        <script src="<?php echo SERVERURL ?>src/js/ajax-asistencia.js"></script>

        <!-- <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/main.css"> -->
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/nav.css">
        <!-- <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/footer.css"> -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css"> -->
        <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

        <title>Asistencias</title>
    </head>
    <!-- <header>
    <div class="header-wrapper">
        <div class="logo">
            <a title="Home" href="#">
                <img style="height: 100px;" src="<?php echo SERVERURL ?>/view/assets/img/logotipo.png" alt="Logo">
            </a>
        </div>

    </div>
</header> -->

    <body>


        <!-- Navbar -->
        <?php
        include 'static/navbar.php';
        // var_dump($_SERVER['HTTP_REFERER']);
        ?>


        <!-- Sidebar -->
        <?php
        // include 'modulos/sidebar.php'; 
        ?>

        <?php require_once $vistas; ?>


        <!-- <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a> -->



        <!-- Scripts -->
        <?php
        include 'static/scripts.php';
        ?>


    </body>
    <!-- <script>
        function changeLayout(x) {
            if (x.matches) { // If media query matches
                document.body.style.backgroundColor = "yellow";
            } else {
                document.body.style.backgroundColor = "pink";
            }
        }

        var x = window.matchMedia("(max-width: 700px)")
        changeLayout(x) // Call listener function at run time
        x.addListener(myFunction) // Attach listener function on state changes
    </script> -->

    </html>

<?php
} else {
    require_once './controller/login.controlador.php';
    $logout = new LoginControlador();
    echo $logout->CtrCerrarSesion();
}
