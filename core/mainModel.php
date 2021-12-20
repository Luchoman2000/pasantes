<?php
if ($peticionAjax) {
    require_once './../core/configAPP.php';
} else {
    require_once './core/configAPP.php';
}

class mainModel

{
    // Metodo conectar
    protected static function conectar()
    {
        $enlace = new PDO(SGBD, USER, PASS);
        return $enlace;
    }

    // Consultas simples
    protected function ejecutar_consulta_simple($consulta)
    {
        $respuesta = self::conectar()->prepare($consulta);
        $respuesta->execute();
        return $respuesta;
        $respuesta = null;
    }


    protected function insertar_auditoria($datos)
    {
        $date = date('Y-m-d H:i:s');
        $sql = self::conectar()->prepare('INSERT INTO `auditoria`(
        `aud_responsable`, `aud_accion`, `aud_descripcion`, `aud_valor_antes`, `aud_valor_ahora`,`aud_fecha_hora`) 
        VALUES (:responsable,:accion,:descripcion,:valorantes,:valordespues,:fecha)');
        $sql->execute(array(
            ':responsable' => $datos['responsable'],
            ':accion' => $datos['accion'],
            ':descripcion' => $datos['descripcion'],
            ':valorantes' => $datos['valorantes'],
            ':valordespues' => $datos['valordespues'],
            ':fecha' => $date,
        ));
        $sql = null;
    }

    public static function encryption($string)
    {
        $output = false;
        $key    = hash('sha256', SECRET_KEY);
        $iv     = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    public static function decryption($string)
    {
        $key    = hash('sha256', SECRET_KEY);
        $iv     = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }
    protected function limpiar_cadena($cadena)
    {
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src", "", $cadena);
        $cadena = str_ireplace("<script type=", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES;", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES;", "", $cadena);
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::", "", $cadena);
        $cadena = stripslashes($cadena);
        return $cadena;
    }

    protected function makeSlug(String $url)
    {
        $url = strtolower($url);
        // $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $url);
        // Reemplazamos caracteres latinos (tildes y eñes)
        $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
        $replace = array('a', 'e', 'i', 'o', 'u', 'n');
        $url = str_replace($find, $replace, $url);

        // Añadimos guiones
        $find = array(' ', '&', '\r\n', '\n', '+');
        $url = str_replace($find, '-', $url);

        // Reemplazamos resto de caracteres distintos de letras y números
        $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
        $replace = array('', '-', '');
        $url = preg_replace($find, $replace, $url);
        return $url;
    }

    /*---------- Funcion verificar datos (expresion regular) - Check data function (regular expression) ----------*/
    protected static function verificar_datos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    } /*--  Fin Funcion - End Function --*/

}
