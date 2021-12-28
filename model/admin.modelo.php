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
        $idHorario = $datos['idHorario'];
        if ($isEditPass) {
            $clave = $datos['clave'];
            $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
            $query = "UPDATE usuario 
            SET usu_usuario = :usuario, 
            usu_clave = :clave, 
            usu_estado = :estado,
            per_id = :idPersonal,
            rol_id = :idRol,
            hor_id = :idHorario
            WHERE usu_id = :idUsuario";
        } else {
            $query = "UPDATE usuario 
            SET usu_usuario = :usuario,
            usu_estado = :estado,
            per_id = :idPersonal,
            rol_id = :idRol,
            hor_id = :idHorario
            WHERE usu_id = :idUsuario";
        }

        $sql = mainModel::conectar()->prepare($query);

        if ($isEditPass) {
            $sql->execute(array(
                ":usuario" => $usuario,
                ":clave" => $clave_hash,
                ":estado" => $estado,
                ":idPersonal" => $idPersonal,
                ":idRol" => $idRol,
                ":idUsuario" => $idUsuario,
                ":idHorario" => $idHorario
            ));
        } else {
            $sql->execute(array(
                ":usuario" => $usuario,
                ":estado" => $estado,
                ":idPersonal" => $idPersonal,
                ":idRol" => $idRol,
                ":idUsuario" => $idUsuario,
                ":idHorario" => $idHorario
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
        $direccion = $datos['direccion'];
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
        per_direccion = :direccion,
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
            ":direccion" => $direccion,
            ":fechaNacimiento" => $fechaNacimiento,
            ":estado" => $estado,
            ":idPersonal" => $idPersonal
        ));
        return $sql;
    }

    // Para editar un horario
    protected function MdlEditarHorario($datos)
    {
        $idHorario = $datos['id_horario'];
        $h_inicio = $datos['hora_inicio'];
        $h_inicio_almuerzo = $datos['hora_inicio_almuerzo'];
        $h_fin_almuerzo = $datos['hora_fin_almuerzo'];
        $h_fin = $datos['hora_fin'];

        $query = "UPDATE horario
        SET hor_entrada = :h_inicio,
        hor_salida_a = :h_inicio_almuerzo,
        hor_regreso_a = :h_fin_almuerzo,
        hor_salida = :h_fin
        WHERE hor_id = :idHorario";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute(array(
            ":h_inicio" => $h_inicio,
            ":h_inicio_almuerzo" => $h_inicio_almuerzo,
            ":h_fin_almuerzo" => $h_fin_almuerzo,
            ":h_fin" => $h_fin,
            ":idHorario" => $idHorario
        ));
        return $sql;
    }

    //Para crear un Usuario
    protected function MdlCrearUsuario($datos){
        $usuario = $datos['usuario'];
        $clave = $datos['clave'];

        $hash_pass = password_hash($clave, PASSWORD_DEFAULT);

        $idPersonal = $datos['idPersonal'];
        $idRol = $datos['idRol'];
        $estado = $datos['estado'];
        $idHorario = isset($datos['idHorario']) ? $datos['idHorario'] : '1';
        $query = "INSERT INTO usuario (usu_usuario, usu_clave, usu_estado, per_id, rol_id, hor_id)
        VALUES (:usuario, :clave, :estado, :idPersonal, :idRol, :idHorario)";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute(array(
            ":usuario" => $usuario,
            ":clave" => $hash_pass,
            ":estado" => $estado,
            ":idPersonal" => $idPersonal,
            ":idRol" => $idRol,
            ":idHorario" => $idHorario,

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
        $direccion = $datos['direccion'];
        // $fechaNacimiento = date('Y-m-d', $datos['fechaNacimiento']);
        $fechaNacimiento = $datos['fechaNacimiento'];
        $estado = $datos['estado'];
        $query = "INSERT INTO personal (per_pri_nombre, per_seg_nombre, per_pri_apellido, per_seg_apellido, per_dni, per_telefono, per_correo,per_direccion, per_fecha_nacimiento, per_estado)
        VALUES (:nombre, :nombre2, :apellido, :apellido2, :dni, :telefono, :correo, :direccion,:fechaNacimiento, :estado)";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute(array(
            ":nombre" => $nombre,
            ":nombre2" => $nombre2,
            ":apellido" => $apellido,
            ":apellido2" => $apellido2,
            ":dni" => $dni,
            ":telefono" => $telefono,
            ":correo" => $correo,
            ":direccion" => $direccion,
            ":fechaNacimiento" => $fechaNacimiento,
            ":estado" => $estado
        ));
        return $sql;

    }

    //Para crear un Horario
    protected function MdlCrearHorario($datos){
        $h_inicio = $datos['hora_inicio'];
        $h_inicio_almuerzo = $datos['hora_inicio_almuerzo'];
        $h_fin_almuerzo = $datos['hora_fin_almuerzo'];
        $h_fin = $datos['hora_fin'];
        $query = "INSERT INTO horario (hor_entrada, hor_salida_a, hor_regreso_a, hor_salida)
        VALUES (:h_inicio, :h_inicio_almuerzo, :h_fin_almuerzo, :h_fin)";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute(array(
            ":h_inicio" => $h_inicio,
            ":h_inicio_almuerzo" => $h_inicio_almuerzo,
            ":h_fin_almuerzo" => $h_fin_almuerzo,
            ":h_fin" => $h_fin
        ));

        return $sql;
    }

    protected function MdlNuevoRegistroPasante($datos){
        $id_personal = $datos['id_personal'];
        $fecha = $datos['fecha'];
        $h_entrada = $datos['h_inicio'];
        $h_almuerzo_inicio = $datos['h_almuerzo_start_u'];
        $h_almuerzo_fin = $datos['h_almuerzo_end_u'];
        $h_salida = $datos['h_salida'];

        $query = "INSERT INTO asistencia (asi_dia, asi_hora_ingreso, asi_hora_salida_a, asi_hora_regreso_a, asi_hora_salida, per_id)
        VALUES (:fecha, :h_entrada, :h_almuerzo_inicio, :h_almuerzo_fin, :h_salida, :id_personal)";
        $sql = mainModel::conectar()->prepare($query);
        $sql->execute(array(
            ":fecha" => $fecha,
            ":h_entrada" => $h_entrada,
            ":h_almuerzo_inicio" => $h_almuerzo_inicio,
            ":h_almuerzo_fin" => $h_almuerzo_fin,
            ":h_salida" => $h_salida,
            ":id_personal" => $id_personal
        ));
        return $sql;
        
    }

}
