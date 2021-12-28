<?php
// if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
    
    // if (!defined('SERVERURL')) define('SERVERURL', 'https://'.$_SERVER['HTTP_HOST'].'/pasantes/');
// }else{

    if (!defined('SERVERURL')) define('SERVERURL', 'http://'.$_SERVER['HTTP_HOST'].'/pasantes/');
// }
// if (!defined('SERVERURL')) define('SERVERURL', 'http://'.192.168.1.109.'/pasantes/');
// if (!defined('COMPANY')) define('COMPANY', 'Repositorio');
// if (!defined('USER')) define('USER', 'k');
//const SERVERURL = 'http://localhost/Turismo/';
//const COMPANY   = 'Mejia360';
date_default_timezone_set('America/Guayaquil');
