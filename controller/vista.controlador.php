<?php
include "core/configGeneral.php";
require_once "model/vista.modelo.php";

/**
 *  Clase encargada de leer la url y determinar que vista se va a mostrar
 *  ( Administracion / Usuario corriente )
 */
class VistaControlador extends VistaModelo
{
  /**
   * @return string 
   */
  public function CtrMostrarInicio()
  {
    return require_once 'view/inicio.php';
  }

  /**
   * @return string respuesta
   */
  public function CtrMostrarVistas()
  {
    if (isset($_GET["views"])) {

      $ruta = explode("/", $_GET["views"]);

      // var_dump($ruta);
      if (isset($ruta[0])) {
        $respuesta = VistaModelo::MdlMostrarVistas($ruta[0]);
      } else {
        $respuesta = "login";
      }
    } else {
      $respuesta = "login";
      // require_once './view/inicio.php';

    }
    return $respuesta;
  }
}
