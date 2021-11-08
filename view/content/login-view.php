<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/login.css">
    <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/bulma.min.css">
    <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/sweetalert2.min.css">
    <script src="<?php echo SERVERURL ?>src/js/sweetalert2.min.js"></script>

    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <h1 class="title has-text-white">Bienvenido</h1>

            <form class="form" action="" method="POST">
                <input name="usuario" type="text" placeholder="Usuario">
                <input name="clave" type="password" placeholder="Clave">
                <button type="submit" id="login-button">Login</button>
            </form>
        </div>

        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</body>

</html>
<script>
    let SERVERURL = document.location.origin;
    var newStyle = document.createElement('style');
    newStyle.appendChild(document.createTextNode("\
        @font-face {\
            font-family: Source Sans Pro;\
            font-style: normal;\
            font-weight: 200;\
            src: url('" + SERVERURL + "/pasantes/src/fonts/SourceSansPro-Light.ttf') format('trueType');\
        }\
    "));

    document.head.appendChild(newStyle);
</script>
<?php
if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    require_once './controller/login.controlador.php';

    $ins_login = new loginControlador();
    echo $ins_login->CtrIniciarSesion();
} ?>