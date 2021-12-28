<?php
if ($peticionAjax) {
    require_once "./../model/perfil.modelo.php";
} else {
    require_once "./model/perfil.modelo.php";
}
class PerfilControlador extends PerfilModelo
{
    public function CtrEditarPerfil()
    {
        $id_personal = $_SESSION['p_id'];

        // Datos
        list($Nombre1, $Nombre2) = explode(" ", $_POST['uNombres']);
        list($Apellido1, $Apellido2) = explode(" ", $_POST['uApellidos']);

        $cedula = mainModel::limpiar_cadena($_POST['uCedula']);

        $Telefono = isset($_POST['uTelefono']) ?  mainModel::limpiar_cadena($_POST['uTelefono']) : "";
        $correo = isset($_POST['uCorreo']) ?  mainModel::limpiar_cadena($_POST['uCorreo']) : "";
        $fecha_nacimiento = isset($_POST['uFechaNacimiento']) ?  mainModel::limpiar_cadena($_POST['uFechaNacimiento']) : "";
        $direccion = isset($_POST['uDireccion']) ?  mainModel::limpiar_cadena($_POST['uDireccion']) : "";

        $Nombre1 = mb_strtolower(mainModel::limpiar_cadena($Nombre1));
        $Nombre2 = isset($Nombre2) ? mb_strtolower(mainModel::limpiar_cadena($Nombre2)) : "";
        $Apellido1 = mb_strtolower(mainModel::limpiar_cadena($Apellido1));
        $Apellido2 = isset($Apellido2) ? mb_strtolower(mainModel::limpiar_cadena($Apellido2)) : "";

        $data = [
            "Nombre1" => ucwords($Nombre1),
            "Nombre2" => ucwords($Nombre2),
            "Apellido1" => ucwords($Apellido1),
            "Apellido2" => ucwords($Apellido2),
            "Cedula" => $cedula,
            "Telefono" => $Telefono,
            "Correo" => $correo,
            "FechaNacimiento" => $fecha_nacimiento,
            "Direccion" => $direccion,
            "id_personal" => $id_personal
        ];
        // var_dump($data);

        $respuesta = PerfilModelo::mdlEditarPerfil($data);
        if ($respuesta->errorCode() == "00000") {
            $res = 1;
        } else {
            $res = 0;
        }
        echo $res;
    }

    public function CtrGetHorario($id = null)
    {
        $id_personal = isset($id) ? mainModel::decryption($id) : $_SESSION['id'];
        $sql = mainModel::ejecutar_consulta_simple("SELECT h.*, u.per_id FROM usuario u INNER JOIN horario h ON u.hor_id = h.hor_id WHERE u.usu_id = '$id_personal'");
        $datos = $sql->fetch();
        if ($sql->rowCount() > 0) {
            $res = $datos;
        } else {
            $res = 1;
        }
        return $res;
    }

    public function CtrGetDatosPersonales()
    {
        $id_personal = $_SESSION['id'];
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario u INNER JOIN personal p ON u.per_id = p.per_id WHERE u.usu_id = '$id_personal'");
        $datos = $sql->fetch();
        return $datos;
    }
}
