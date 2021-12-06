<?php
if ($peticionAjax) {
    require_once "./../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class AdminModelo extends mainModel
{
    //Para editar un Usuario
    protected function MdlEditarUsuario($datos, $isEditPass)
    {
        $idUsuario = $datos['idUsuario'];
        $idPersonal = $datos['idPersonal'];
        $usuario = $datos['usuario'];
        $idRol = $datos['idRol'];
        $estado = $datos['estado'];
        if ($isEditPass) {
            $clave = $datos['clave'];
            $query = "UPDATE usuario 
            SET usu_usuario = :usuario, 
            usu_clave = :clave, 
            usu_estado = :estado,
            per_id = :idPersonal,
            rol_id = :idRol
            WHERE usu_id = :idUsuario";
        } else {
            $query = "UPDATE usuario 
            SET usu_usuario = :usuario,
            usu_estado = :estado,
            per_id = :idPersonal,
            rol_id = :idRol
            WHERE usu_id = :idUsuario";
        }

        $sql = mainModel::conectar()->prepare($query);

        // $sql->bindParam(":usuario", $usuario, PDO::PARAM_STR);
        // $sql->bindParam(":estado", $estado, PDO::PARAM_INT);
        // $sql->bindParam(":idPersonal", $idPersonal, PDO::PARAM_INT);
        // $sql->bindParam(":idRol", $idRol, PDO::PARAM_INT);
        // $sql->bindParam(":idusuario", $idUsuario, PDO::PARAM_INT);
        // if ($isEditPass) {
        //     $sql->bindParam(":clave", $clave, PDO::PARAM_STR);
        // }
        if ($isEditPass) {
            $sql->execute(array(
                ":usuario" => $usuario,
                ":clave" => $clave,
                ":estado" => $estado,
                ":idPersonal" => $idPersonal,
                ":idRol" => $idRol,
                ":idUsuario" => $idUsuario
            ));
        } else {
            $sql->execute(array(
                ":usuario" => $usuario,
                ":estado" => $estado,
                ":idPersonal" => $idPersonal,
                ":idRol" => $idRol,
                ":idUsuario" => $idUsuario
            ));
        }

        return $sql;
    }

    //Para editar un Personal
    protected function MdlEditarPersonal($datos)
    {
        $idPersonal = $datos['idPersonal'];
        $nombre = $datos['nombre'];
        $nombre2 = $datos['nombre2'];
        $apellido = $datos['apellido'];
        $apellido2 = $datos['apellido2'];
        $dni = $datos['dni'];
        $telefono = $datos['telefono'];
        $email = $datos['email'];
        // $direccion = $datos['direccion'];
        $fechaNacimiento = $datos['fechaNacimiento'];
        $estado = $datos['estado'];

        $query = "UPDATE personal 
        SET per_pri_nombre = :nombre, 
        per_seg_nombre = :nombre2, 
        per_pri_apellido = :apellido, 
        per_seg_apellido = :apellido2, 
        per_dni = :dni, 
        per_telefono = :telefono, 
        per_correo = :email, 
        per_fecha_nacimiento = :fechaNacimiento, 
        per_estado = :estado
        WHERE per_id = :idPersonal";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute(array(
            ":nombre" => $nombre,
            ":nombre2" => $nombre2,
            ":apellido" => $apellido,
            ":apellido2" => $apellido2,
            ":dni" => $dni,
            ":telefono" => $telefono,
            ":email" => $email,
            // ":direccion" => $direccion,
            ":fechaNacimiento" => $fechaNacimiento,
            ":estado" => $estado,
            ":idPersonal" => $idPersonal
        ));
        return $sql;
    }

    //Para crear un Usuario
    protected function MdlCrearUsuario($datos){
        $usuario = $datos['usuario'];
        $clave = $datos['clave'];
        $idPersonal = $datos['idPersonal'];
        $idRol = $datos['idRol'];
        $estado = $datos['estado'];
        $query = "INSERT INTO usuario (usu_usuario, usu_clave, usu_estado, per_id, rol_id)
        VALUES (:usuario, :clave, :estado, :idPersonal, :idRol)";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute(array(
            ":usuario" => $usuario,
            ":clave" => $clave,
            ":estado" => $estado,
            ":idPersonal" => $idPersonal,
            ":idRol" => $idRol
        ));
        return $sql;
    }

    //Para crear personal
    protected function MdlCrearPersonal($datos){
        $nombre = $datos['nombre'];
        $nombre2 = $datos['nombre2'];
        $apellido = $datos['apellido'];
        $apellido2 = $datos['apellido2'];
        $dni = $datos['dni'];
        $telefono = $datos['telefono'];
        $correo = $datos['email'];
        // $fechaNacimiento = date('Y-m-d', $datos['fechaNacimiento']);
        $fechaNacimiento = $datos['fechaNacimiento'];
        $estado = $datos['estado'];
        $query = "INSERT INTO personal (per_pri_nombre, per_seg_nombre, per_pri_apellido, per_seg_apellido, per_dni, per_telefono, per_correo, per_fecha_nacimiento, per_estado)
        VALUES (:nombre, :nombre2, :apellido, :apellido2, :dni, :telefono, :correo, :fechaNacimiento, :estado)";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute(array(
            ":nombre" => $nombre,
            ":nombre2" => $nombre2,
            ":apellido" => $apellido,
            ":apellido2" => $apellido2,
            ":dni" => $dni,
            ":telefono" => $telefono,
            ":correo" => $correo,
            ":fechaNacimiento" => $fechaNacimiento,
            ":estado" => $estado
        ));
        return $sql;

    }

}
