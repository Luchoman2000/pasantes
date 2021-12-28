<?php
/**
 * Clase encargada de tomar la vista ingresada por URL (GET) y
 * procesarla al publico
 */
class VistaModelo
{

    /**
     * Funcion toma la entrada GET y la prosesa para luego enviarla a mostrar.
     * @param string $vistas Toma GET de la url
     * @return string Retirna el contenido que se va a mostrar al publico
     */
    protected function MdlMostrarVistas($vistas)
    {

        // URLs permitidas
        $listaBlanca = [
            "home",
            "registro",
            "perfil",
            "admin",
            "about"
        ];


        if (in_array($vistas, $listaBlanca)) {
            if (is_file("./view/content/" . $vistas . "-view.php")) {
                $contenido = "./view/content/" . $vistas . "-view.php";
            } else {
                $contenido = "login";
            }
        } elseif ($vistas == "login") {
            $contenido = "login";
        
        } elseif ($vistas == "logout") {
            $contenido = "logout";
        } elseif ($vistas == "") {
            $contenido = "login";
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}
