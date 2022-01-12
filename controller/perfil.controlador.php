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

    // Para editar la contraseña
    public function CtrEditarClave()
    {
        // check config
        if ($this->CtrGetCoreConfig('permite_cambio_clave')) {
            $id_personal = $_SESSION['id'];
            $anteriorClave = mainModel::limpiar_cadena($_POST['anteriorClave']);
            $nuevaClave1 = mainModel::limpiar_cadena($_POST['nuevaClave1']);
            $nuevaClave2 = mainModel::limpiar_cadena($_POST['nuevaClave2']);

            $data = [
                "id_personal" => $id_personal,
                "anteriorClave" => $anteriorClave,
                "nuevaClave1" => $nuevaClave1,
                "nuevaClave2" => $nuevaClave2
            ];
            // check password 
            $checkPassword = mainModel::ejecutar_consulta_simple("SELECT usu_clave FROM usuario WHERE usu_id='$id_personal'")->fetch();
            if (password_verify($anteriorClave, $checkPassword['usu_clave'])) {
                if ($nuevaClave1 == $nuevaClave2) {
                    $claveHash = password_hash($nuevaClave1, PASSWORD_DEFAULT);
                    $data = [
                        "id_personal" => $id_personal,
                        "claveHash" => $claveHash
                    ];
                    $respuesta = PerfilModelo::mdlEditarClave($data);
                    if ($respuesta->errorCode() == "00000") {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                } else {
                    $res = 2;
                }
            } else {
                $res = 3;
            }
        } else {
            $res = '';
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

    public function CtrGetHorarioAdm()
    {
        $id_personal = $_GET['getHorario'];
        $id_usuario = $this->CtrGetIdUsuario($id_personal);

        // var_dump($id_personal);
        // var_dump($id_usuario);
        $sql = mainModel::ejecutar_consulta_simple("SELECT h.*, u.per_id FROM usuario u INNER JOIN horario h ON u.hor_id = h.hor_id WHERE u.usu_id = '$id_usuario'");
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

    // Otener id del pasante
    public function CtrGetIdUsuario($id)
    {
        $id_n = $id;
        if (is_numeric($id_n)) {
            $sql = mainModel::conectar()->prepare("SELECT per_id, usu_id FROM usuario WHERE per_id = ?");
            $sql->execute(array($id_n));
            $row = $sql->fetch();
            @$id_na = $row['usu_id'];

            return $id_na;
        } else {
            return "NO NAME";
        }
    }

    // Get core config
    public function CtrGetCoreConfig($val = null)
    {
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM core");
        $datos = $sql->fetch();
        $res = false;
        if ($val == 'permite_cambio_clave') {
            $res = $datos['cor_estado'] == '1' ? true : false;
        }
        // var_dump($datos);
        return $res;
    }
}
