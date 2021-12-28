<?php
if ($peticionAjax) {
    require_once "./../model/admin.modelo.php";
} else {
    require_once "./model/admin.modelo.php";
}
class AdminControlador extends AdminModelo
{

    //Para mostrar los usuarios
    public function CtrMostrarUsuarios()
    {
        $sql = mainModel::ejecutar_consulta_simple("SELECT h.*, u.*,r.rol_nombre as rol, r.rol_id as rol_id,
        CONCAT(p.per_pri_nombre, ' ', p.per_seg_nombre, ' ', p.per_pri_apellido, ' ', p.per_seg_apellido) AS nombre 
        FROM usuario u
        INNER JOIN personal p ON u.per_id = p.per_id
        INNER JOIN rol r ON u.rol_id = r.rol_id
        LEFT JOIN horario h ON u.hor_id = h.hor_id
        ");

        $tabla = '
            <table id="listaUsuarios" class="table stripe row-border order-column nowrap" style="width:100%; box-sizing: inherit;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Horario</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
            <tbody>
        ';

        if ($sql->rowCount() > 0) {

            $datos = $sql->fetchAll();
            foreach ($datos as $row) {
                $nombre = mb_strtolower($row['nombre']);
                $nombre = ucwords($nombre);
                $tabla .= '
                    <tr>
                        <td style="vertical-align: middle;">' . $nombre . '</td>
                        <td style="vertical-align: middle;">' . $row['usu_usuario'] . '</td>';




                $tabla .= '<td style="vertical-align: middle;">' . $row['rol'] . '</td>';
                if (is_null($row['hor_id']) || $row['hor_id'] == 1) {
                    $tabla .= '<td style="vertical-align: middle;">Sin horario</td>';
                } else {
                    $tabla .= '<td style="vertical-align: middle;">' . date('H:i a', strtotime($row['hor_entrada'])) . ' ' . date('H:i a', strtotime($row['hor_salida'])) . '</td>';
                }
                if ($row['usu_estado'] == 1) {
                    $tabla .= '
                        <td style="vertical-align: middle;">Activo</td>';
                } else {
                    $tabla .= '
                        <td style="vertical-align: middle;">Inactivo</td>';
                }
                $tabla .= '<td style="vertical-align: middle; text-align: center;">';
                if ($row['rol'] != "ADMINISTRADOR" && $row['usu_estado'] != 0) {
                    $tabla .= '
                                <button style="height: fit-content;" class="button is-info is-outlined" onclick="window.location.href=\'' . SERVERURL . 'registro/' . mainModel::encryption($row['per_id']) . '\'">
                                    <span class="icon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </button>
                                ';
                }
                $tabla .= '<button estado="' . $row['usu_estado'] . '"  rol="' . mainModel::encryption($row['rol_id']) . '" id="' . mainModel::encryption($row['usu_id']) . '" style="height: fit-content;" class="button is-success is-outlined editarUsuario modal-button"  data-target="usuarioForm" data-toggle="modal">
                                <span class="icon">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </span>
                            </button>
                            <button id="' . mainModel::encryption($row['usu_id']) . '" style="height: fit-content;" class="button is-danger is-outlined eliminarUsuario">
                                <span class="icon">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </span>
                            </button>
                        </td>
                    </tr>';
            }
        } else {
            $tabla .= '
                <tr>
                    <td colspan="5" style="text-align:center;">No hay usuarios 😥</td>
                </tr>
            ';
        }
        $tabla .= '
                </tbody>
            </table>';
        echo $tabla;
    }

    //Para mostrar el personal
    public function CtrMostrarPersonal()
    {
        $sql = mainModel::ejecutar_consulta_simple("SELECT p.*,
        CONCAT(per_pri_nombre, ' ', per_seg_nombre, ' ', per_pri_apellido, ' ', per_seg_apellido) AS nombre 
        FROM personal p");

        $tabla = '
            <table id="listaPersonal" class="table stripe row-border order-column nowrap" style="width:100%; box-sizing: inherit;">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Cédula</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Fecha de nacimiento</th>
                        <th>Estado</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
            <tbody>
        ';
        if ($sql->rowCount() > 0) {

            $datos = $sql->fetchAll();
            foreach ($datos as $row) {
                $nombre = mb_strtolower($row['nombre']);
                $nombre = ucwords($nombre);
                $tabla .= '
                        <tr>
                            <td style="vertical-align: middle;">' . $nombre . '</td>
                            <td style="vertical-align: middle;">' . $row['per_dni'] . '</td>
                            <td style="vertical-align: middle;">' . $row['per_telefono'] . '</td>
                            <td style="vertical-align: middle;">' . $row['per_correo'] . '</td>
                            <td style="vertical-align: middle;">' . $row['per_fecha_nacimiento'] . '</td>';
                if ($row['per_estado'] == 1) {
                    $tabla .= '
                            <td style="vertical-align: middle;">Activo</td>';
                } else {
                    $tabla .= '
                            <td style="vertical-align: middle;">Inactivo</td>';
                }

                $tabla .= '<td style="vertical-align: middle; text-align: center;">
                                <button estado="' . $row['per_estado'] . '"  id="' . mainModel::encryption($row['per_id']) . '" style="height: fit-content;" class="button is-success is-outlined editarPersonal modal-button"  data-target="personalForm" data-toggle="modal">
                                    <span class="icon">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </span>
                                </button>
                                <button id="' . mainModel::encryption($row['per_id']) . '" style="height: fit-content;" class="button is-danger is-outlined eliminarPersonal">
                                    <span class="icon">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>';
            }
        } else {
            $tabla .= '
                <tr>
                    <td colspan="6" style="text-align:center;">No hay personal 😥</td>
                </tr>
            ';
        }
        $tabla .= '
                </tbody>
            </table>';
        echo $tabla;
    }

    // Para mostrar os horarios
    public function CtrMostrarHorarios()
    {
        $sql = mainModel::ejecutar_consulta_simple('SELECT * FROM horario WHERE hor_id > 1');
        $tabla = '
           
            <table id="listaHorarios" class="table is-fullwidth is-striped is-hoverable">
                <thead>
                    <tr>
                        <th>Hora de entrada</th>
                        <th>Hora de salida almuerzo</th>
                        <th>Hora de regreso almuerzo</th>
                        <th>Hora de salida</th>
                        <th style="text-align: center;">Acciones</th>
                    </tr>
                </thead>
            <tbody>
        ';
        if ($sql->rowCount() > 0) {
            $datos = $sql->fetchAll();
            foreach ($datos as $row) {
                $tabla .= '
                        <tr>
                            <td style="vertical-align: middle;">' . date('H:i a', strtotime($row['hor_entrada'])) . '</td>
                            <td style="vertical-align: middle;">' . date('H:i a', strtotime($row['hor_salida_a'])) . '</td>
                            <td style="vertical-align: middle;">' . date('H:i a', strtotime($row['hor_regreso_a'])) . '</td>
                            <td style="vertical-align: middle;">' . date('H:i a', strtotime($row['hor_salida'])) . '</td>';
                $tabla .= '<td style="vertical-align: middle; text-align: center;">
                                <button id="' . mainModel::encryption($row['hor_id']) . '" style="height: fit-content;" class="button is-success is-outlined editarHorario modal-button"  data-target="horarioForm" data-toggle="modal">
                                    <span class="icon">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </span>
                                </button>
                                <button id="' . mainModel::encryption($row['hor_id']) . '" style="height: fit-content;" class="button is-danger is-outlined eliminarHorario">
                                    <span class="icon">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </span>
                                </button>
                            </td>
                        </tr>';
            }
        } else {
            $tabla .= '
                <tr>
                    <td colspan="5" style="text-align:center;">No hay horarios 😥</td>
                </tr>
            ';
        }
        $tabla .= '
                </tbody>
            </table>';
        echo $tabla;
    }


    //Para eliminar usuarios
    public function CtrEliminarUsuario()
    {
        if (!($_SESSION['id'] == mainModel::decryption($_POST['id']))) {
            if (isset($_POST['id'])) {
                $idUsuario = mainModel::decryption($_POST['id']);
                $sql = mainModel::ejecutar_consulta_simple("DELETE FROM usuario WHERE usu_id = $idUsuario");
                if ($sql->rowCount() > 0) {
                    $res = "ok";
                    //Auditoria
                    $datos_a = [
                        "responsable" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
                        "accion" => "Eliminar",
                        "descripcion" => "Eliminó un usuario",
                        "valorantes" => $idUsuario,
                        "valordespues" => "",
                    ];
                    mainModel::insertar_auditoria($datos_a);
                } else {
                    $res = "error";
                }
            } else {
                $res = "error";
            }
            echo $res;
        } else {
            echo "error_s";
        }
    }

    //Para eliminar personal
    public function CtrEliminarPersonal()
    {
        if ($_SESSION['p_id'] == mainModel::decryption($_POST['id_personal'])) {
            $res = "error_s";
            echo $res;
            exit();
        }
        if (isset($_POST['id_personal'])) {
            $idPersonal = mainModel::decryption($_POST['id_personal']);
            $sql = mainModel::ejecutar_consulta_simple("DELETE FROM personal WHERE per_id = $idPersonal");
            if ($sql->rowCount() > 0) {
                $res = "ok";
                //Auditoria
                $datos_a = [
                    "responsable" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
                    "accion" => "Eliminar",
                    "descripcion" => "Eliminó un personal",
                    "valorantes" => $idPersonal,
                    "valordespues" => "",
                ];
                mainModel::insertar_auditoria($datos_a);
            } else {
                $res = "error";
            }
        } else {
            $res = "error";
        }
        echo $res;
    }

    //Para eliminar horarios
    public function CtrEliminarHorario()
    {
        if (isset($_POST['id_horario'])) {
            $idHorario = mainModel::decryption($_POST['id_horario']);
            $sql = mainModel::ejecutar_consulta_simple("DELETE FROM horario WHERE hor_id = $idHorario");
            if ($sql->rowCount() > 0) {
                $res = "ok";
                //Auditoria
                $datos_a = [
                    "responsable" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
                    "accion" => "Eliminar",
                    "descripcion" => "Eliminó un horario",
                    "valorantes" => $idHorario,
                    "valordespues" => "",
                ];
                mainModel::insertar_auditoria($datos_a);
            } else {
                $res = "error";
            }
        } else {
            $res = "error";
        }
        echo $res;
    }

    //Para editar usuarios
    public function CtrEditarUsuario()
    {
        // if (!($_SESSION['id'] == mainModel::decryption($_POST['id_usuario']))) {
        $idUsuario = mainModel::decryption($_POST['id_usuario']);
        $idPersonal = mainModel::decryption($_POST['uPersonal']);
        $usuario = mainModel::limpiar_cadena($_POST['uUsuario']);
        $idRol = mainModel::decryption($_POST['uRol']);
        $estado = mainModel::limpiar_cadena($_POST['uEstado']);

        if (isset($_POST['uHorario'])) {
            $idHorario = $_POST['uHorario'];
        }else{
            $idHorario = null;
        }

        $isEditPass = false;

        // var_dump($_POST);
        $datos = [
            "idUsuario" => $idUsuario,
            "idPersonal" => $idPersonal,
            "usuario" => $usuario,
            "idRol" => $idRol,
            "estado" => $estado,
            "idHorario" => $idHorario
        ];
        // echo json_encode($datos);

        $chekUser = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usu_usuario = '$usuario' AND usu_id != $idUsuario");
        if ($chekUser->rowCount() > 0) {
            $res = 2;
        } else {



            if ((isset($_POST['uNClave']) && isset($_POST['uSNClave'])) && ($_POST['uNClave'] != "" && $_POST['uSNClave'] != "")) {
                $clave = mainModel::limpiar_cadena($_POST['uNClave']);
                $clave2 = mainModel::limpiar_cadena($_POST['uSNClave']);
                $datos['clave'] = $clave;
                $datos['clave2'] = $clave2;
                $isEditPass = true;
            }
            // var_dump($datos);


            $sql = AdminModelo::MdlEditarUsuario($datos, $isEditPass);
            // var_dump($sql);
            // var_dump($sql->errorCode());
            if ($sql->errorCode() == "00000") {
                $res = 1;
                //Auditoria
                $datos_a = [
                    "responsable" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
                    "accion" => "Editar",
                    "descripcion" => "Editó un usuario",
                    "valorantes" => $idUsuario,
                    "valordespues" => "",
                ];
                mainModel::insertar_auditoria($datos_a);
            } else {
                $res = 0;
            }
            // if ($sql->rowCount() > 0) {
            //     $res = 1;
            // } else {
            //     $res = 0;
            // }
        }
        echo $res;
        // } 
        // else {
        //     echo "error_s";
        // }
    }

    //Para editar personal
    public function CtrEditarPersonal()
    {
        // if ($_SESSION['p_id'] == mainModel::decryption($_POST['id_personal'])) {
        //     $res = "error_s";
        //     echo $res;
        //     exit();
        // }
        $idPersonal = mainModel::decryption($_POST['id_personal']);
        $nombre = mb_strtolower(mainModel::limpiar_cadena($_POST['pNombre']));
        $nombre2 = isset($_POST['pNombre2']) ? mb_strtolower(mainModel::limpiar_cadena($_POST['pNombre2'])) : "";
        $apellido = mb_strtolower(mainModel::limpiar_cadena($_POST['pApellido']));
        $apellido2 = isset($_POST['pApellido2']) ? mb_strtolower(mainModel::limpiar_cadena($_POST['pApellido2'])) : "";
        $dni = mainModel::limpiar_cadena($_POST['pCedula']);
        $telefono = isset($_POST['pTelefono']) ? mainModel::limpiar_cadena($_POST['pTelefono']) : "";
        $email = isset($_POST['pEmail']) ? mainModel::limpiar_cadena($_POST['pEmail']) : "";
        $direccion = isset($_POST['pDireccion']) ? mainModel::limpiar_cadena($_POST['pDireccion']) : "";
        $fechaNacimiento = isset($_POST['pFechaNacimiento']) ? mainModel::limpiar_cadena($_POST['pFechaNacimiento']) : "1000-01-01";
        $estado = mainModel::limpiar_cadena($_POST['pEstado']);

        $datos = [
            "idPersonal" => $idPersonal,
            "nombre" => ucwords($nombre),
            "nombre2" => ucwords($nombre2),
            "apellido" => ucwords($apellido),
            "apellido2" => ucwords($apellido2),
            "dni" => $dni,
            "telefono" => $telefono,
            "email" => $email,
            "direccion" => $direccion,
            "fechaNacimiento" => $fechaNacimiento,
            "estado" => $estado,
        ];

        $chekUser = mainModel::ejecutar_consulta_simple("SELECT * FROM personal WHERE per_dni = '$dni' AND per_id != $idPersonal");
        if ($chekUser->rowCount() > 0) {
            $res = 2;
        } else {
            $sql = AdminModelo::MdlEditarPersonal($datos);
            if ($sql->errorCode() == "00000") {
                $res = 1;
                //Auditoria
                $datos_a = [
                    "responsable" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
                    "accion" => "Editar",
                    "descripcion" => "Editó un personal",
                    "valorantes" => $idPersonal,
                    "valordespues" => "N/A",
                ];
                mainModel::insertar_auditoria($datos_a);
            } else {
                $res = 0;
            }
        }
        echo $res;
    }

    //Para editar horario
    public function CtrEditarHorario()
    {
        // if ($_SESSION['p_id'] == mainModel::decryption($_POST['id_personal'])) {
        //     $res = "error_s";
        //     echo $res;
        //     exit();
        // }
        $idHorario = mainModel::decryption($_POST['id_horario']);
        $hora_inicio = mainModel::limpiar_cadena($_POST['hInicio']);
        $hora_inicio_almuerzo = mainModel::limpiar_cadena($_POST['hAlmuerzoInicio']);
        $hora_fin_almuerzo = mainModel::limpiar_cadena($_POST['hAlmuerzoFin']);
        $hora_fin = mainModel::limpiar_cadena($_POST['hFin']);
        $datos = [
            "id_horario" => $idHorario,
            "hora_inicio" => $hora_inicio,
            "hora_inicio_almuerzo" => $hora_inicio_almuerzo,
            "hora_fin_almuerzo" => $hora_fin_almuerzo,
            "hora_fin" => $hora_fin,
        ];

        $sql = AdminModelo::MdlEditarHorario($datos);
        if ($sql->errorCode() == "00000") {
            $res = 1;
            //Auditoria
            $datos_a = [
                "responsable" => $_SESSION['nombre'] . " " . $_SESSION['apellido'],
                "accion" => "Editar",
                "descripcion" => "Editó un horario",
                "valorantes" => $idHorario,
                "valordespues" => "N/A",
            ];
            mainModel::insertar_auditoria($datos_a);
        } else {
            $res = 0;
        }
        echo $res;
    }

    //Para crear usuarios
    public function CtrCrearUsuario()
    {
        $idPersonal = mainModel::decryption($_POST['uPersonal']);
        $usuario = mainModel::limpiar_cadena($_POST['uUsuario']);
        $idRol = mainModel::decryption($_POST['uRol']);
        $estado = mainModel::limpiar_cadena($_POST['uEstado']);
        $clave = mainModel::limpiar_cadena($_POST['uNClave']);
        $clave2 = mainModel::limpiar_cadena($_POST['uSNClave']);
        $idHorario =  isset($_POST['uHorario']) ? $_POST['uHorario'] : 1;


        $datos = [
            "idPersonal" => $idPersonal,
            "usuario" => $usuario,
            "idRol" => $idRol,
            "estado" => $estado,
            "clave" => $clave,
            "clave2" => $clave2,
            "idHorario" => $idHorario,
        ];
        // var_dump($datos);
        $chekUser = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usu_usuario = '$usuario'");
        if ($chekUser->rowCount() > 0) {
            $res = 2;
        } else {
            $sql = AdminModelo::MdlCrearUsuario($datos);
            if ($sql->rowCount() > 0) {
                $res = 1;
            } else {
                $res = 0;
            }
        }
        echo $res;
    }

    //Para crear personal
    public function CtrCrearPersonal()
    {
        $nombre = mb_strtolower(mainModel::limpiar_cadena($_POST['pNombre']));
        $nombre2 = isset($_POST['pNombre2']) ? mb_strtolower(mainModel::limpiar_cadena($_POST['pNombre2'])) : "";
        $apellido = mb_strtolower(mainModel::limpiar_cadena($_POST['pApellido']));
        $apellido2 = isset($_POST['pApellido2']) ? mb_strtolower(mainModel::limpiar_cadena($_POST['pApellido2'])) : "";
        $dni = mainModel::limpiar_cadena($_POST['pCedula']);
        $telefono = isset($_POST['pTelefono']) ? mainModel::limpiar_cadena($_POST['pTelefono']) : "";
        $email = isset($_POST['pEmail']) ? mainModel::limpiar_cadena($_POST['pEmail']) : "";
        $direccion = isset($_POST['pDireccion']) ? mainModel::limpiar_cadena($_POST['pDireccion']) : "";
        $fechaNacimiento = isset($_POST['pFechaNacimiento']) ? mainModel::limpiar_cadena($_POST['pFechaNacimiento']) : "1000-01-01";
        $estado = mainModel::limpiar_cadena($_POST['pEstado']);

        // 

        $datos = [
            "nombre" => ucwords($nombre),
            "nombre2" => ucwords($nombre2),
            "apellido" => ucwords($apellido),
            "apellido2" => ucwords($apellido2),
            "dni" => $dni,
            "telefono" => $telefono,
            "direccion" => $direccion,
            "email" => $email,
            "fechaNacimiento" => $fechaNacimiento,
            "estado" => $estado,
        ];

        $chekUser = mainModel::ejecutar_consulta_simple("SELECT * FROM personal WHERE per_dni = '$dni'");
        if ($chekUser->rowCount() > 0) {
            $res = 2;
        } else {
            $sql = AdminModelo::MdlCrearPersonal($datos);
            if ($sql->rowCount() > 0) {
                $res = 1;
            } else {
                $res = 0;
            }
        }
        echo $res;
    }

    //Para crear horario
    public function CtrCrearHorario()
    {
        $hora_inicio = mainModel::limpiar_cadena($_POST['hInicio']);
        $hora_inicio_almuerzo = mainModel::limpiar_cadena($_POST['hAlmuerzoInicio']);
        $hora_fin_almuerzo = mainModel::limpiar_cadena($_POST['hAlmuerzoFin']);
        $hora_fin = mainModel::limpiar_cadena($_POST['hFin']);
        $datos = [
            "hora_inicio" => $hora_inicio,
            "hora_inicio_almuerzo" => $hora_inicio_almuerzo,
            "hora_fin_almuerzo" => $hora_fin_almuerzo,
            "hora_fin" => $hora_fin,
        ];
        $sql = AdminModelo::MdlCrearHorario($datos);
        if ($sql->rowCount() > 0) {
            $res = 1;
        } else {
            $res = 0;
        }
        echo $res;
    }

    //Para crear nuevo registro pasante
    public function CtrNuevoRegistroPasante()
    {

        $fecha = mainModel::limpiar_cadena($_POST['fecha']);
        $h_inicio = mainModel::limpiar_cadena($_POST['h_entrada_u']);
        $h_almuerzo_start_u = isset($_POST['h_almuerzo_start_u']) ?  mainModel::limpiar_cadena($_POST['h_almuerzo_start_u']) : "00:00:00";
        $h_almuerzo_end_u = isset($_POST['h_almuerzo_end_u']) ?  mainModel::limpiar_cadena($_POST['h_almuerzo_end_u']) : "00:00:00";
        $h_salida = isset($_POST['h_salida_u']) ?  mainModel::limpiar_cadena($_POST['h_salida_u']) : "00:00:00";

        $id_personal = mainModel::decryption($_POST['id_personal']);


        $datetime1 = new DateTime($h_almuerzo_start_u);
        $datetime2 = new DateTime($h_almuerzo_end_u);

        $interval = $datetime1->diff($datetime2);
        $v_hora =  $interval->format('%R%H:%i:%s') . ' ';

        // validar que las horas ingresadas sean secuenciales
        if (
            // ((strtotime($h_ingreso) > strtotime($h_almuerzo_start)) 
            // || (((strtotime($h_almuerzo_end) > strtotime($h_salida))) && ($h_almuerzo_start != '00:00:00' || $h_almuerzo_end != '00:00:00')))
            // || ((strtotime($h_ingreso) > strtotime($h_salida)) && $h_salida != '00:00:00')
            ((strtotime($h_inicio) > strtotime($h_almuerzo_start_u)) && $h_almuerzo_start_u != '00:00:00')
            || ((strtotime($h_almuerzo_end_u) > strtotime($h_salida)) && $h_salida != '00:00:00')
            || ((strtotime($h_inicio) > strtotime($h_salida)) && $h_salida != '00:00:00')
            || ((strtotime($h_almuerzo_start_u) > strtotime($h_almuerzo_end_u)) && $h_almuerzo_end_u != '00:00:00')
            || ((strtotime($h_almuerzo_start_u) > strtotime($h_salida)) && $h_salida != '00:00:00')


        ) {
            $res =  'error_s';
        } else {

            if (strpos($v_hora, '-') && ($h_almuerzo_start_u != '00:00:00' && $h_almuerzo_end_u != '00:00:00')) {
                $res = 'error_h';
            } elseif ($h_almuerzo_start_u == '00:00:00' && $h_almuerzo_end_u != '00:00:00') {
                $res = 'error_a';
            } else {

                if (($h_almuerzo_start_u == '00:00:00' || $h_almuerzo_end_u == '00:00:00') && $h_salida != '00:00:00') {
                    $h_almuerzo_start_u = '00:00:00';
                    $h_almuerzo_end_u = '00:00:00';
                }

                $datos = [
                    "fecha" => $fecha,
                    "h_inicio" => $h_inicio,
                    "h_almuerzo_start_u" => $h_almuerzo_start_u,
                    "h_almuerzo_end_u" => $h_almuerzo_end_u,
                    "h_salida" => $h_salida,
                    "id_personal" => $id_personal,
                ];
                //validar si ya se ingreso el registro ese dia
                $chekDate = mainModel::ejecutar_consulta_simple("SELECT * FROM asistencia WHERE asi_dia = '$fecha' AND per_id = '$id_personal'");
                if ($chekDate->rowCount() > 0) {
                    $res = 2;
                } else {
                    $sql = AdminModelo::MdlNuevoRegistroPasante($datos);
                    if ($sql->rowCount() > 0) {
                        $res = 1;
                    } else {
                        $res = 0;
                    }
                }
            }
        }

        echo $res;
    }

    //Para mostrar personal para <select>
    public function CtrMostrarPersonalSelect()
    {
        $select = '';
        $sql = mainModel::ejecutar_consulta_simple("SELECT u.*, p.* FROM usuario u RIGHT JOIN personal p ON u.per_id = p.per_id ORDER BY usu_id DESC");
        if (isset($_POST['Uid'])) {  // Para editar usuario
            $id = mainModel::decryption($_POST['Uid']);
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    if ($row['usu_id'] == $id) {
                        $select .= '<option value="' . mainModel::encryption($row['per_id']) . '"';
                        if (isset($_POST['editar_usuario_select_personal'])) {
                            if ($row['usu_id'] == $id) {
                                $select .= 'selected';
                            }
                        }
                        $name = mb_strtolower($row['per_pri_nombre'] . ' ' . $row['per_seg_nombre'] . ' ' . $row['per_pri_apellido'] . ' ' . $row['per_seg_apellido']);
                        $select .= '>' . ucwords($name) . '</option>';
                    }
                    if (is_null($row['usu_id'])) {
                    }
                }

                // foreach ($datos as $row) {
                //     $select .= '
                //         <option value="' . mainModel::encryption($row['per_id']) . '">' . $row['per_pri_nombre'] . ' ' . $row['per_seg_nombre'] . ' ' . $row['per_pri_apellido'] . ' ' . $row['per_seg_apellido'] . '</option>
                //     ';
                // }
            }
        } else { // Para crear usuario
            if ($sql->rowCount() > 0) {
                $select = '
                <option value="">Seleccione un personal</option>
                ';
                $a = 0;
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    if (is_null($row['usu_id'])) {
                        $a++;
                        $name = mb_strtolower($row['per_pri_nombre'] . ' ' . $row['per_seg_nombre'] . ' ' . $row['per_pri_apellido'] . ' ' . $row['per_seg_apellido']);
                        $select .= '
                        <option value="' . mainModel::encryption($row['per_id']) . '">' . ucwords($name) . '</option>
                    ';
                    }
                    // if ($a > 0) {
                    //     $select .= '
                    //         <option value="">Seleccione un personal</option>
                    //     ';
                    // }
                }
            } else {
                $select = '
                    <option value="">No hay personal disponible</option>
                ';
            }
        }


        echo $select;
    }

    //Para mostrar rol para <select>
    public function CtrMostrarRolSelect()
    {
        $select = '';
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM rol");
        if (isset($_POST['Uid'])) {
            $id = mainModel::decryption($_POST['Uid']);
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    $select .= '<option value="' . mainModel::encryption($row['rol_id']) . '"';
                    if (isset($_POST['editar_usuario_select_rol'])) {
                        if ($row['rol_id'] == $id) {
                            $select .= 'selected';
                        }
                    }
                    $select .= '>' . $row['rol_nombre'] . '</option>';
                }
            }
        } else {
            $select = '
                <option value="">Seleccione un rol</option>
            ';
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    $select .= '
                        <option value="' . mainModel::encryption($row['rol_id']) . '">' . $row['rol_nombre'] . '</option>
                    ';
                }
            }
        }

        echo $select;
    }

    //Para mostrar estado para <select>
    public function CtrMostrarEstadoSelect()
    {
        $select = '';
        $id_u = mainModel::decryption($_POST['Uid']);
        $sql = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usu_id='$id_u'");
        if (isset($_POST['Uid'])) {
            $id = mainModel::decryption($_POST['Uid']);
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    $select .= '<option value="' . mainModel::encryption($row['usu_estado']) . '"';
                    if (isset($_POST['editar_usuario_select_estado'])) {
                        if ($row['usu_id'] == $id) {
                            $select .= 'selected';
                        }
                    }
                    $select .= '>' . $row['usu_estado'] . '</option>';
                }
            }
        } else {
            $select = '
                <option value="">Seleccione un estado</option>
            ';
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    $select .= '
                        <option value="' . mainModel::encryption($row['usu_estado']) . '">' . $row['usu_estado'] . '</option>
                    ';
                }
            }
        }

        echo $select;
    }

    //Para mostrar horario para <select>
    public function CtrMostrarHorarioSelect()
    {
        $select = '';
        $sql = mainModel::ejecutar_consulta_simple("SELECT u.*, h.* FROM horario h LEFT JOIN usuario u
        ON h.hor_id = u.hor_id
        WHERE h.hor_id > 1
        GROUP BY h.hor_id
        ORDER BY h.hor_id
        ");

        if (isset($_POST['Uid'])) {

            $id = mainModel::decryption($_POST['Uid']);
            $fila_usuario = mainModel::ejecutar_consulta_simple("SELECT * FROM usuario WHERE usu_id='" . $id . "'");
            $fila_u = $fila_usuario->fetch();
            // var_dump($fila_u);
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                $a = 0;
                if ($fila_u['hor_id'] != 1) {
                    foreach ($datos as $row) {
                        // if (!is_null($row['hor_id'])) {

                        $select .= '<option value="' . $row['hor_id'] . '"';
                        if (isset($_POST['editar_usuario_select_horario'])) {
                            if ($row['hor_id'] == $fila_u['hor_id']) {
                                $select .= 'selected';
                                $a++;
                            }
                        }
                        $select .= '>' . date('H:i a', strtotime($row['hor_entrada'])) . ' - ' . date('H:i a', strtotime($row['hor_salida'])) . '</option>';

                        // }    
                    }
                    $select .= '
                    <option value="1">Sin Horario</option>
                    ';
                } else {
                    $select = '
                        <option value="1">Sin Horario</option>
                    ';
                    foreach ($datos as $row) {

                        $select .= '<option value="' . $row['hor_id'] . '"';
                        $select .= '>' . date('H:i a', strtotime($row['hor_entrada'])) . ' - ' . date('H:i a', strtotime($row['hor_salida'])) . '</option>';
                        // }    
                    }
                }
            }
        } else {
            $select = '
            <option value="1">Sin Horario</option>
            ';
            if ($sql->rowCount() > 0) {
                $datos = $sql->fetchAll();
                foreach ($datos as $row) {
                    // if (!is_null($row['hor_id'])) {
                    $select .= '
                        <option value="' . $row['hor_id'] . '">' .  date('H:i a', strtotime($row['hor_entrada'])) . ' - ' . date('H:i a', strtotime($row['hor_salida'])) . '</option>
                    ';
                    // }
                }
            }
        }

        echo $select;
    }
}
