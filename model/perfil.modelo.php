<?php
if ($peticionAjax) {
    require_once "./../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class PerfilModelo extends mainModel
{
    protected function MdlEditarPerfil($datos)
    {
        $Nombre1 = $datos['Nombre1'];
        $Nombre2 = $datos['Nombre2'];
        $Apellido1 = $datos['Apellido1'];
        $Apellido2 = $datos['Apellido2'];
        $FechaNacimiento = $datos['FechaNacimiento'];
        $cedula = $datos['Cedula'];
        $telefono = $datos['Telefono'];
        $direccion = $datos['Direccion'];
        $correo = $datos['Correo'];
        $id = $datos['id_personal'];

        $sql = mainModel::conectar()->prepare("UPDATE personal SET 
        per_pri_nombre = :Nombre1,
        per_seg_nombre = :Nombre2,
        per_pri_apellido = :Apellido1,
        per_seg_apellido = :Apellido2,
        per_dni = :cedula,
        per_telefono = :telefono,
        per_correo = :correo,
        per_direccion = :direccion,
        per_fecha_nacimiento = :FechaNacimiento
        WHERE per_id = :id");
        $sql->execute(array(
            "Nombre1" => $Nombre1,
            "Nombre2" => $Nombre2,
            "Apellido1" => $Apellido1,
            "Apellido2" => $Apellido2,
            "cedula" => $cedula,
            "telefono" => $telefono,
            "correo" => $correo,
            "direccion" => $direccion,
            "FechaNacimiento" => $FechaNacimiento,
            "id" => $id
        ));
        return $sql;
        $sql = null;
    }

    // Para editar la contraseña
    public function MdlEditarClave($datos)
    {
        $id_personal = $datos['id_personal'];
        $anteriorClave = $datos['anteriorClave'];
        // Clave hash
        $nuevaClave1 = $datos['nuevaClave1'];
        $clave_hash = password_hash($nuevaClave1, PASSWORD_DEFAULT);
        $nuevaClave2 = $datos['nuevaClave2'];

        $sql = mainModel::conectar()->prepare("UPDATE usuario SET 
        usu_clave = :nuevaClave1
        WHERE usu_id = :id_personal");
        $sql->execute(array(
            "nuevaClave1" => $clave_hash,
            "id_personal" => $id_personal
        ));
        return $sql;
        $sql = null;
    }
}
