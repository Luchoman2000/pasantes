<?php
session_name('SSP');
session_start();
unset($_SESSION["id"]);
unset($_SESSION["p_id"]);
unset($_SESSION["nombre"]);
unset($_SESSION["apellido"]);
header("Location:login");
?>