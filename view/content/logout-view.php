<?php
// session_name('SSP');
// session_start();
unset($_SESSION["id"]);
unset($_SESSION["rol"]);
unset($_SESSION["p_id"]);
unset($_SESSION["nombre"]);
unset($_SESSION["apellido"]);
unset($_SESSION["hor_id"]);
session_unset();
session_destroy();
header("Location:login");

?>