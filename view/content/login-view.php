<?php
if (isset($_SESSION['p_id']) && isset($_SESSION['id'])) {
?>
    <script>
        window.location.href = "home";
    </script>
<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="en" style="overflow-y: overlay;">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/jpg" href="<?php echo SERVERURL ?>src/assets/icon/favicon.ico" />
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/login.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/bulma.min.css">
        <link rel="stylesheet" href="<?php echo SERVERURL ?>src/css/sweetalert2.min.css">
        <script src="<?php echo SERVERURL ?>src/js/sw.all.min.js"></script>
        <script src="<?php echo SERVERURL ?>src/js/jquery.min.js"></script>
        <title>Login</title>
    </head>

    <body>
        <div class="wrapper">
            <div class="on-time"></div>
            <div class="container">
                <h1 class="title has-text-white">Bienvenido</h1>

                <form id="loguear" class="form" action="" method="POST">
                    <input id="user" autocomplete="username" name="usuario" type="text" placeholder="Usuario">
                    <input id="pass" autocomplete="current-password" name="clave" type="password" placeholder="Clave">
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

    <script src="<?php echo SERVERURL ?>src/js/login.js"></script>

    </html>
<?php
}
?>