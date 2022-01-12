<?php
if ($peticionAjax) {
    require_once "./../core/mainModel.php";
} else {
    require_once "./core/mainModel.php";
}

class AsistenciaModelo extends mainModel
{

    // Para marcar la asistencia 
    protected function MdlMarcarAsistencia($datos)
    {
        $id = $datos['per_id'];
        $dia = $datos['dia'];
        $h_ingreso = $datos['h_ingreso'];
        $estado = $datos['estado'];

        $sql0 = mainModel::conectar()->prepare("SELECT * FROM asistencia WHERE per_id = :id and asi_dia = :dia");
        $sql0->bindParam(":id", $id);
        $sql0->bindParam(":dia", $dia);
        $sql0->execute();
        $a = $sql0;
        $sql0 = null;
        // var_dump($a);

        $dato = $a->fetch();
        if ($a->rowCount() >= 1) {

            $sql = mainModel::conectar()->prepare("UPDATE asistencia SET asi_hora_ingreso = :h_ingreso, asi_estado = :estado WHERE asi_dia = :dia AND per_id = :per_id");
            $sql->execute(array(
                ':h_ingreso' => $h_ingreso,
                ':dia' => $dia,
                ':per_id' => $id,
                ':estado' => $estado
            ));
            return $sql;
            $sql = null;
            exit();
        } else {

            $sql = mainModel::conectar()->prepare("INSERT INTO asistencia(asi_dia, asi_hora_ingreso, per_id, asi_estado) 
            VALUES(:dia, :h_ingreso, :per_id, :estado)
            ");

            $sql->execute(array(
                ':dia' => $dia,
                ':h_ingreso' => $h_ingreso,
                ':per_id' => $id,
                ':estado' => $estado,

            ));
            return $sql;
            $sql = null;
            exit();
        }
    }

    // Para agregar observacion
    protected function MdlAgregarObservacion($datos)
    {
        $id = $datos['per_id'];
        $dia = $datos['dia'];
        $observacion = $datos['observacion'];

        $sql = mainModel::conectar()->prepare("UPDATE asistencia SET asi_observacion = :observacion WHERE asi_dia = :dia AND per_id = :per_id");
        $sql->execute(array(
            ':observacion' => $observacion,
            ':dia' => $dia,
            ':per_id' => $id,
        ));
        return $sql;
        $sql = null;
        exit();
    }

    // Para actualizar observacion
    protected function MdlActualizarObservacion($datos)
    {
        $id = $datos['per_id'];
        $dia = $datos['dia'];
        $observacion = $datos['observacion'];

        $sql = mainModel::conectar()->prepare("UPDATE asistencia SET asi_observacion = :observacion WHERE asi_dia = :dia AND per_id = :per_id");
        $sql->execute(array(
            ':observacion' => $observacion,
            ':dia' => $dia,
            ':per_id' => $id,
        ));
        return $sql;
        $sql = null;
        exit();
    }

    // Para marcar inicio del almuerzo
    protected function MdlMarcarAlmuerzoInicio($datos)
    {
        $id = $datos['per_id'];
        $dia = $datos['dia'];
        $h_ingreso = $datos['h_almuerzo_inicio'];

        $sql = mainModel::conectar()->prepare("UPDATE asistencia SET asi_hora_salida_a = :h_ingreso WHERE asi_dia = :dia AND per_id = :per_id");

        $sql->execute(array(
            ':h_ingreso' => $h_ingreso,
            ':dia' => $dia,
            ':per_id' => $id,

        ));
        return $sql;
        $sql = null;
    }

    // Para marcar fin del almuerzo
    protected function MdlMarcarAlmuerzoFin($datos)
    {
        $id = $datos['per_id'];
        $dia = $datos['dia'];
        $h_ingreso = $datos['h_almuerzo_fin'];

        $sql = mainModel::conectar()->prepare("UPDATE asistencia SET asi_hora_regreso_a = :h_ingreso WHERE asi_dia = :dia AND per_id = :per_id");

        $sql->execute(array(
            ':h_ingreso' => $h_ingreso,
            ':dia' => $dia,
            ':per_id' => $id,

        ));
        return $sql;
        $sql = null;
    }

    // Para marcar la salida
    protected function MdlMarcarSalida($datos)
    {
        $id = $datos['per_id'];
        $dia = $datos['dia'];
        $h_ingreso = $datos['h_salida'];

        $sql = mainModel::conectar()->prepare("UPDATE asistencia SET asi_hora_salida = :h_ingreso WHERE asi_dia = :dia AND per_id = :per_id");

        $sql->execute(array(
            ':h_ingreso' => $h_ingreso,
            ':dia' => $dia,
            ':per_id' => $id,

        ));
        return $sql;
        $sql = null;
    }

    // Para validar si el empleado ya marco
    protected function MdlValidarAsistencia($datos, $t_marcado)
    {
        $id = $datos['per_id'];
        $dia = $datos['dia'];
        $res = false;

        $sql0 = mainModel::conectar()->prepare("SELECT * FROM asistencia WHERE per_id = :id and asi_dia = :dia");
        $sql0->bindParam(":id", $id);
        $sql0->bindParam(":dia", $dia);
        $sql0->execute();
        $a = $sql0;
        $sql0 = null;

        // var_dump($a);

        //Validar si hay registros


        if ($a->rowCount() >= 1) {
            $a = $a->fetch();
            if ($t_marcado == 'ingreso') {
                if ($a['asi_hora_ingreso'] == '00:00:00') {
                    $res = true;
                    return $res;

                    exit();
                }
            }
            if ($t_marcado == 'almuerzo_inicio') {
                if ($a['asi_hora_salida_a'] == '00:00:00') {
                    $res = true;
                    return $res;

                    exit();
                }
            }
            if ($t_marcado == 'almuerzo_fin') {
                if ($a['asi_hora_regreso_a'] == '00:00:00') {
                    $res = true;
                    return $res;

                    exit();
                }
            }
            if ($t_marcado == 'salida') {
                if ($a['asi_hora_salida'] == '00:00:00') {
                    $res = true;
                    return $res;

                    exit();
                }
            }

            if ($t_marcado == 'validar_almuerzo') {
                if ($a['asi_hora_salida_a'] != '00:00:00' && $a['asi_hora_regreso_a'] != '00:00:00') {
                    $res = true;
                    return $res;

                    exit();
                }
            }
            if ($t_marcado == 'validar_almuerzo_fin') {
                if ($a['asi_hora_salida_a'] != '00:00:00' && $a['asi_hora_regreso_a'] == '00:00:00') {
                    $res = true;
                    return $res;

                    exit();
                }
            }

        } else {
            $res = true;
            return $res;
            exit();
        }
        // var_dump($a);

    }
    // Para insertar fecha pasante
    protected function MdlInsertarFechaPasante($id)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO asistencia(asi_dia, per_id) 
        VALUES(:fpa_fecha, :per_id)
        ");

        $sql->execute(array(
            ':fpa_fecha' => date('Y-m-d'),
            ':per_id' => $id,

        ));
        return $sql;
        $sql = null;
    }


    // Para reset almuerzo
    protected function MdlResetAlmuerzo($datos)
    {
        $id = $datos['per_id'];
        $dia = $datos['dia'];

        $sql = mainModel::conectar()->prepare("UPDATE asistencia SET asi_hora_salida_a = '00:00:00', asi_hora_regreso_a = '00:00:00' WHERE asi_dia = :dia AND per_id = :per_id");

        $sql->execute(array(
            ':dia' => $dia,
            ':per_id' => $id,

        ));
        return $sql;
        $sql = null;
    }

    protected function MdlMarcarAsistenciaAtrasado(){
        $sql = mainModel::conectar()->prepare("UPDATE asistencia SET asi_estado = '' WHERE asi_dia = :dia AND per_id = :per_id");

        $sql->execute(array(
            ':dia' => date('Y-m-d'),
            ':per_id' => $_SESSION['per_id'],

        ));
        return $sql;
        $sql = null;
    }

    // =ADMIN=
    // Para editar registro de pasante
    protected function MdlEditarRegistro($datos)
    {
        $id = $datos['asi_id'];
        $dia = $datos['asi_dia'];
        $h_ingreso = $datos['asi_hora_ingreso'];
        $h_almuerzo_inicio = $datos['asi_hora_salida_a'];
        $h_almuerzo_fin = $datos['asi_hora_regreso_a'];
        $h_salida = $datos['asi_hora_salida'];
        $observacion = $datos['asi_observacion'];
        $estado = $datos['asi_estado'];

        $sql = mainModel::conectar()->prepare("UPDATE asistencia SET 
        asi_hora_ingreso = ?,
        asi_hora_salida_a = ?,
        asi_hora_regreso_a = ?,
        asi_hora_salida = ?,
        asi_observacion = ?,
        asi_estado = ?
        WHERE asi_id = ?");
        $sql->execute(array(
            $h_ingreso,
            $h_almuerzo_inicio,
            $h_almuerzo_fin,
            $h_salida,
            $observacion,
            $estado,
            $id,
        ));

        return $sql;
        $sql = null;
    }
}
